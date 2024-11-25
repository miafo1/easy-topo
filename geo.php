<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Land Geolocation</title>
    <style>
        #map {
            height: 400px;
            width: 100%;
        }
        #location-info {
            margin-top: 10px;
            padding: 10px;
            border: 1px solid #ccc;
        }
    </style>
</head>
<body>

    <h1>Enter Land Coordinates</h1>
    <form id="coordinate-form">
        <label for="latitude">Latitude:</label>
        <input type="text" id="latitude" name="latitude" required>
        <label for="longitude">Longitude:</label>
        <input type="text" id="longitude" name="longitude" required>
        <button type="submit">Locate</button>
    </form>

    <div id="map"></div>
    <div id="location-info"></div>

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCxQMb6gKq-FRJ7ncWEzuf6RQjLxVHekzg"></script>
    <script src="geo_script.js"></script>

</body>
</html>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Validate Land</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>

    <h1>Validate Pending Land Submissions</h1>

    <table>
        <thead>
            <tr>
                <th>Surveyor</th>
                <th>Latitude</th>
                <th>Longitude</th>
                <th>Description</th>
                <th>Image</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Fetch all pending land submissions
            $conn = new mysqli("localhost", "root", "", "easytopo");

            $sql = "SELECT p.idpending, u.fname, u.lname, p.latitude, p.longitude, p.description, p.imageland
                    FROM pending_land p
                    JOIN user u ON p.surveyor_id = u.id
                    WHERE p.status = 'pending'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['fname'] . " " . $row['lname'] . "</td>";
                    echo "<td>" . $row['latitude'] . "</td>";
                    echo "<td>" . $row['longitude'] . "</td>";
                    echo "<td>" . $row['description'] . "</td>";
                    echo "<td><img src='" . $row['imageland'] . "' alt='Land Image' width='100'></td>";
                    echo "<td>
                            <form action='code.php' method='POST'>
                                <input type='hidden' name='idpending' value='" . $row['idpending'] . "'>
                                <button type='submit'>Approve</button>
                            </form>
                          </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='6'>No pending land submissions</td></tr>";
            }

            $conn->close();
            ?>
        </tbody>
    </table>

</body>
</html>

