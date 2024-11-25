<?php
include('config/dbcon.php');

// Fetch all users with role 'surveyor'
$query = "
    SELECT u.fname, u.lname, u.photo, r.nameregion, t.nametown
    FROM user u
    JOIN region r ON u.idregion = r.idregion
    JOIN town t ON u.idtown = t.idtown
    WHERE u.role_as = 'surveyor'";

$result = mysqli_query($con, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surveyor List</title>
    <!-- Bootstrap CSS for styling -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <h2 class="mb-4">List of Surveyors</h2>
    <div class="row">
        <?php
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $photo = $row['photo'];
                $fname = $row['fname'];
                $lname = $row['lname'];
                $region = $row['nameregion'];
                $town = $row['nametown'];
        ?>
        <div class="col-md-4 mb-4">
            <div class="card" style="width: 18rem;">
                <img class="card-img-top" src="uploads/<?php echo $photo; ?>" alt="Surveyor Photo" style="height: 200px; object-fit: cover;">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $fname . " " . $lname; ?></h5>
                    <p class="card-text"><strong>Region:</strong> <?php echo $region; ?></p>
                    <p class="card-text"><strong>Town:</strong> <?php echo $town; ?></p>
                </div>
            </div>
        </div>
        <?php
            }
        } else {
            echo "<p>No surveyors found.</p>";
        }
        ?>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>
