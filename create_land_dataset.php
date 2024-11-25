<!-- create_land_dataset.php -->
<?php
include('config/dbcon.php');

// Fetch data from the land table
$query = "SELECT idland, districtname, unitprice, totalprice, titleland, descriptionland, locationland, size, land_type, land_purpose, available FROM land";
$result = mysqli_query($con, $query);

// Create a CSV file for the dataset
$dataset = fopen("land_dataset.csv", "w");

// Add the header
$header = ['idland', 'districtname', 'unitprice', 'totalprice', 'titleland', 'descriptionland', 'locationland', 'size', 'land_type', 'land_purpose', 'available'];
fputcsv($dataset, $header);

// Add the data rows
while ($row = mysqli_fetch_assoc($result)) {
    fputcsv($dataset, $row);
}

fclose($dataset);

echo "Dataset created successfully!";
?>
