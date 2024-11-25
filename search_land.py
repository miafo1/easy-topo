# search_land.py
import spacy
import pandas as pd
import sys
import json

# Load SpaCy model
nlp = spacy.load("en_core_web_sm")

# Load the land dataset
land_data = pd.read_csv("land_dataset.csv")

# Function to extract entities from the query
def extract_search_criteria(query):
    doc = nlp(query)
    location = None
    price = None
    size = None
    land_purpose = None
    land_type = None

    for ent in doc.ents:
        if ent.label_ == "GPE":  # Geo-political entity (location)
            location = ent.text
        elif ent.label_ == "MONEY":  # Price
            price = ent.text
        elif ent.label_ == "QUANTITY":  # Size
            size = ent.text
        elif ent.label_ == "FAC":  # Purpose
            land_purpose = ent.text
        elif ent.label_ == "ORG":  # Land type
            land_type = ent.text

    return location, price, size, land_purpose, land_type

# Parse the search query
query = sys.argv[1]
location, price, size, land_purpose, land_type = extract_search_criteria(query)

# Function to search the dataset based on extracted criteria
def search_land(location=None, price=None, size=None, land_purpose=None, land_type=None):
    filtered_data = land_data
    
    if location:
        filtered_data = filtered_data[filtered_data['locationland'].str.contains(location, case=False, na=False)]
    
    if price:
        price_value = float(price.replace('fr', '').replace(',', '').strip())
        filtered_data = filtered_data[filtered_data['totalprice'] <= price_value]
    
    if size:
        filtered_data = filtered_data[filtered_data['size'].str.contains(size, case=False, na=False)]
    
    if land_purpose:
        filtered_data = filtered_data[filtered_data['land_purpose'].str.contains(land_purpose, case=False, na=False)]
    
    if land_type:
        filtered_data = filtered_data[filtered_data['land_type'].str.contains(land_type, case=False, na=False)]

    return filtered_data

# Perform the search
results = search_land(location, price, size, land_purpose, land_type)

# Output the results in JSON format
print(json.dumps(results.to_dict(orient='records')))
