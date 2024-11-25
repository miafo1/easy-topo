<?php
session_start();
include('config/dbcon.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css">
    <title>Surveyor - Submit Land Details</title>
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
        form {
            margin-top: 20px;
        }
        label {
            display: block;
            margin-top: 10px;
        }
        input[type="text"], textarea {
            width: 100%;
            padding: 10px;
        }
        button {
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }
    </style>
</head>
<body>

    <div class="container-fluid px-4">
                <div class="row mt-4">
                <h4>
    <a href="indexuser.php" class="btn btn-danger float-end">View Services</a>
   </h4> 
                    <div class="col-md-12">
                        <?php include ('message.php') ?>
                        <div class="card">
                            <div class="card-header">
                                <h4>Submit Land Details
                                    <a href="#" class="btn btn-danger float-end">back</a>
                                </h4>
                            </div>
                            <div class="card-body">
                            <form id="land-form" action="code.php" method="POST" enctype="multipart/form-data">
                                    <div class="row">
                                        
                                    <div class="col-md-6 mb-3">
                                            <label for="">Land Latitude</label>
                                            <input type="file" required id="latitude" name="latitude" required="" class="form-control">
                                        </div>
                                            
                                    <div class="col-md-6 mb-3">
                                            <label for="">Land Longitude</label>
                                            <input type="file" required id="longitude" name="longitude" required="" class="form-control">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="">Region List</label>
                                            <?php
                                            $regionl = "SELECT * FROM region WHERE statusregion='0' ";
                                            $regionl_run = mysqli_query($con, $regionl);
                                            if (mysqli_num_rows($regionl_run) > 0) {
                                                ?>
                                                <select name="idregion" required="" class="form-control">
                                                    <option value="">------ Click to select region----</option>
                                                    <?php
                                                    foreach ($regionl_run as $regionl_item) {
                                                        ?>
                                                        <option value="<?= $regionl_item['idregion'] ?>"><?= $regionl_item['nameregion'] ?></option>
                                                        <?php
                                                    }
                                                    ?>
                                                </select>
                                                <?php
                                            } else {
                                                ?>
                                                <h5>No region available!!</h5>
                                                <?php
                                            }
                                            ?>

                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="">Town List</label>
                                            <?php
                                            $townl = "SELECT * FROM town WHERE statustown='0' ";
                                            $townl_run = mysqli_query($con, $townl);
                                            if (mysqli_num_rows($townl_run) > 0) {
                                                ?>
                                                <select name="idtown" required="" class="form-control">
                                                    <option value="">------ Click To Select Town----</option>
                                                    <?php
                                                    foreach ($townl_run as $townl_item) {
                                                        ?>
                                                        <option value="<?= $townl_item['idtown'] ?>"><?= $townl_item['nametown'] ?></option>
                                                        <?php
                                                    }
                                                    ?>
                                                </select>
                                                <?php
                                            } else {
                                                ?>
                                                <h5>No town available!!</h5>
                                                <?php
                                            }
                                            ?>

                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="">District List</label>
                                            <?php
                                            $townl = "SELECT * FROM district WHERE statusdistrict='0' ";
                                            $townl_run = mysqli_query($con, $townl);
                                            if (mysqli_num_rows($townl_run) > 0) {
                                                ?>
                                                <select name="iddistrict" required="" class="form-control">
                                                    <option value="">------ Click To Select District----</option>
                                                    <?php
                                                    foreach ($townl_run as $townl_item) {
                                                        ?>
                                                        <option value="<?= $townl_item['iddistrict'] ?>"><?= $townl_item['namedistrict'] ?></option>
                                                        <?php
                                                    }
                                                    ?>
                                                </select>
                                                <?php
                                            } else {
                                                ?>
                                                <h5>No District available!!</h5>
                                                <?php
                                            }
                                            ?>

                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="">Land Name</label>
                                            <input type="text" required name="titleland" required="" class="form-control">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="">Land description</label>
                                            <textarea name="description"  required="" id="summernote" class="form-control "  rows="4"></textarea>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="">Land Location</label>
                                            <input type="text" required name="locationland" required="" class="form-control">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="">Land Image</label>
                                            <input type="file" required name="imageland" required="" class="form-control">
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="">Unite Price</label>
                                            <input type="text" required name="uniteprice" required="" class="form-control">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="">Total Price</label>
                                            <input type="text" required name="totalprice" required="" class="form-control">
                                        </div>
                                        
                                        <div class="col-md-6 mb-3">
                                            <label for="">Size</label>
                                            <input type="text" required name="size" required="" class="form-control">
                                        </div>
                                        
                                        <div class="col-md-6 mb-3">
                                            <label for="">land Purpose</label>
                                            <input type="text" required name="landpurpose" required="" class="form-control">
                                        </div>
                                        
                                        <div class="col-md-6 mb-3">
                                            <label for="">Land Type</label>
                                            <input type="text" required name="landtype" required="" class="form-control">
                                        </div>
                                        <button type="submit">Submit</button>
                                    </div>
                                </form>                         
                            </div>
                        </div>
                    </div>

                </div>
            </div>
    <div id="map"></div>
    <div id="location-info"></div>

    <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY"></script>
    <script src="geo_script.js"></script>

</body>
</html>
