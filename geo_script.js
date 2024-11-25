document.getElementById('coordinate-form').addEventListener('submit', function(event) {
    event.preventDefault();
    const latitude = parseFloat(document.getElementById('latitude').value);
    const longitude = parseFloat(document.getElementById('longitude').value);

    if (isNaN(latitude) || isNaN(longitude)) {
        alert('Please enter valid coordinates.');
        return;
    }

    // Initialize the map
    const map = new google.maps.Map(document.getElementById('map'), {
        center: {lat: latitude, lng: longitude},
        zoom: 15
    });

    // Place a marker on the map
    const marker = new google.maps.Marker({
        position: {lat: latitude, lng: longitude},
        map: map
    });

    // Reverse Geocoding to get more information about the location
    const geocoder = new google.maps.Geocoder();

    geocoder.geocode({'location': {lat: latitude, lng: longitude}}, function(results, status) {
        const locationInfo = document.getElementById('location-info');
        if (status === 'OK') {
            if (results[0]) {
                locationInfo.innerHTML = `<h3>Location Information:</h3><p>${results[0].formatted_address}</p>`;
            } else {
                locationInfo.innerHTML = '<p>No results found for this location.</p>';
            }
        } else {
            locationInfo.innerHTML = `<p>Geocode was not successful for the following reason: ${status}</p>`;
        }
    });
});
