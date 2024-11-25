<?php
//include('authenticate.php'); becaus authentication is not giving
session_start();
include('config/dbcon.php');
?>
<html>
    <!DOCTYPE html>
    <html lang="en">

        <head>
            <meta charset="utf-8">
            <meta content="width=device-width, initial-scale=1.0" name="viewport">
            <meta charset="utf-8" />
            <meta http-equiv="X-UA-Compatible" content="IE=edge" />
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
            <meta name="description" content="" />
            <meta name="author" content="" />
            <title>Admin</title>
            <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
            <link href="css/styles.css" rel="stylesheet" />
            <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>

            <title>Admin Panel</title>


            <script>
                function showTowns() {
                    var region = document.getElementById("region").value;
                    var townOptions = document.getElementById("townOptions");
                    //clear previous options
                    townOptions.innerHTML = "";
                    // Add town base on regions
                    if (region === "Adamawa") {
                        addOption("Ngaoundere", "Ngaoundere");
                        addOption("yola", "yolo");
                        addOption("Meiganga", "Meiganga");
                    } else if (region === "Center") {
                        addOption("Yaounde", "Yaounde");
                        addOption("Bafia", "Bafia");
                        addOption("Obala", "Obala");
                        addOption("Mbalmayo", "Mbalmayo");
                    } else if (region === "East") {
                        addOption("Bertoua", "Bertoua");
                        addOption("Yokadouma", "Yokadouma");
                        addOption("Abong-Mbang", "Abong-Mbang");

                    } else if (region === "Far North") {
                        addOption("Mora", "Mora");
                        addOption("Kousseri", "Kousseri");
                        addOption("Maroua", "Maroua");

                    } else if (region === "Littoral") {
                        addOption("Douala", "Douala");
                        addOption("Edea", "Edea");
                        addOption("Nkongsamba", "Nkongsamba");

                    } else if (region === "North") {
                        addOption("Garoua", "Garoua");
                        addOption("Guider", "Guider");
                        addOption("Figuil", "Figuil");

                    } else if (region === "West") {
                        addOption("Bafoussam", "Bafoussam");
                        addOption("Foumban", "Foumban");
                        addOption("Dschang", "Dschang");

                    } else if (region === "South") {
                        addOption("Ebolowa", "Ebolowa");
                        addOption("Sangmelima", "Sangmelima");
                        addOption("Kribi", "Kribi");

                    } else if (region === "Southwest") {
                        addOption("Buea", "Buea");
                        addOption("Limbe", "Limbe");
                        addOption("Tiko", "Tiko");

                    }
                    townOptions.disabled = false;
                }
//                enable the town select dropdown

                function addOption(text, value) {
                    var option = document.createElement("option");
                    option.text = text;
                    option.value = value;
                    document.getElementById("townOptions").add(option);
                }
                function submitForm() {
                    var region = document.getElementById("region").value;
                    var town = document.getElementById("townOptions").value;
                    alert("selected Region: " + region + "\nselected town:" + town);
                }

            </script>
            <meta content="" name="description">
            <meta content="" name="keywords">

            <!-- Favicons -->
            <!--            <link href="assets/img/favicon.png" rel="icon">
                        <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">-->

            <!-- Google Fonts -->
            <link rel="preconnect" href="https://fonts.googleapis.com">
            <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
            <link
                href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,600;1,700&family=Roboto:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Work+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
                rel="stylesheet">

            <!-- Vendor CSS Files -->
            <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
            <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
            <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
            <link href="assets/vendor/aos/aos.css" rel="stylesheet">
            <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
            <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

            <!-- Template Main CSS File -->
            <link href="assets/css/main.css" rel="stylesheet">

            <!-- =======================================================
            * Template Name: UpConstruction - v1.3.0
            * Template URL: https://bootstrapmade.com/upconstruction-bootstrap-construction-website-template/
            * Author: BootstrapMade.com
            * License: https://bootstrapmade.com/license/
            ======================================================== -->
        </head>

        <body class="sb-nav-fixed">

            <!-- ======= Header ======= -->
            <header id="header" class="header d-flex align-items-center">
                <div class="container-fluid container-xl d-flex align-items-center justify-content-between">

                    <a href="index.html" class="logo d-flex align-items-center">
                        <!-- Uncomment the line below if you also wish to use an image logo -->
                        <!-- <img src="assets/img/logo.png" alt=""> -->
                        <h1>EASY-TOPO<span>.</span></h1>
                    </a>

                    <i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
                    <i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i>
                    <nav id="navbar" class="navbar">
                        <ul>
                            <li><a href="indexuser.php">Home</a></li>
                            <li><a href="projects.html" >Propose your land</a></li>
                            <li><a href="booksurveyor.php">Book for survey</a></li>
                            <li class="dropdown"><a href="#"><span>Book a land</span> <i
                                        class="bi bi-chevron-down dropdown-indicator"></i></a>
                                <ul>
                                    <li class="dropdown"><a href="#"><span>Adamawa</span> <i
                                                class="bi bi-chevron-down dropdown-indicator"></i></a>
                                        <ul>
                                            <li><a href="#">Ngaoundere </a></li>
                                            <li><a href="#"> Yola</a></li>
                                            <li><a href="#">Meiganga</a></li>
                                        </ul>
                                    </li>
                                    <li class="dropdown"><a href="#"><span>Center</span> <i
                                                class="bi bi-chevron-down dropdown-indicator"></i></a>
                                        <ul>
                                            <li><a href="#">Yaounde</a></li>
                                            <li><a href="#">Obala</a></li>
                                            <li><a href="#">Mbalmayo</a></li>
                                        </ul>
                                    </li>
                                    <li class="dropdown"><a href="#"><span>East</span> <i
                                                class="bi bi-chevron-down dropdown-indicator"></i></a>
                                        <ul>
                                            <li><a href="#">Bertoua</a></li>
                                            <li><a href="#">batouri</a></li>
                                            <li><a href="#">Abong-Mbang</a></li>
                                        </ul>
                                    </li>
                                    <li class="dropdown"><a href="#"><span>Far North</span> <i
                                                class="bi bi-chevron-down dropdown-indicator"></i></a>
                                        <ul>
                                            <li><a href="#">Mora</a></li>
                                            <li><a href="#">Kousseri</a></li>
                                            <li><a href="#">Maroua</a></li>
                                        </ul>
                                    </li>
                                    <li class="dropdown"><a href="#"><span>Littoral</span> <i
                                                class="bi bi-chevron-down dropdown-indicator"></i></a>
                                        <ul>
                                            <li><a href="#">Douala</a></li>
                                            <li><a href="#">Edea</a></li>
                                            <li><a href="#">Nkonsamba</a></li>
                                        </ul>

                                    </li>
                                    <li class="dropdown"><a href="#"><span>North</span> <i
                                                class="bi bi-chevron-down dropdown-indicator"></i></a>
                                        <ul>
                                            <li><a href="#">Garoua</a></li>
                                            <li><a href="#">Guider</a></li>
                                            <li><a href="#">figuil</a></li>
                                        </ul>
                                    </li>
                                    <li class="dropdown"><a href="#"><span>Northwest</span> <i
                                                class="bi bi-chevron-down dropdown-indicator"></i></a>
                                        <ul>
                                            <li><a href="#">Bamenda</a></li>
                                            <li><a href="#">Bafut</a></li>
                                            <li><a href="#">Kumbo</a></li>
                                        </ul>
                                    </li>
                                    <li class="dropdown"><a href="#"><span>West</span> <i
                                                class="bi bi-chevron-down dropdown-indicator"></i></a>
                                        <ul>
                                            <li><a href="#">Baffousam</a></li>
                                            <li><a href="#">Foumban</a></li>
                                            <li><a href="#">Dschang</a></li>
                                        </ul>
                                    </li>
                                    <li class="dropdown"><a href="#"><span>South</span> <i
                                                class="bi bi-chevron-down dropdown-indicator"></i></a>
                                        <ul>
                                            <li><a href="#">Ebolowa</a></a></li>
                                            <li><a href="#">Sangmelima</a></li>
                                            <li><a href="#">Kribi</a></li>
                                        </ul>
                                    </li>
                                    <li class="dropdown"><a href="#"><span>Southwest</span> <i
                                                class="bi bi-chevron-down dropdown-indicator"></i></a>
                                        <ul>
                                            <li><a href="#">Buea</a></li>
                                            <li><a href="#">Limbe</a></li>
                                            <li><a href="#">Tiko</a></li>
                                        </ul>
                                    </li>

                                </ul>
                            </li>
                            <li><a href="consultation.php">Consultation</a></li>
                            <li><a href="contact.html">Contact</a></li>
                        </ul>
                    </nav><!-- .navbar -->

                </div>
                <div id="layoutSidenav">
                    <?php include('includes/sidebar.php'); ?>
                </div>
            </header><!-- End Header -->

            <main id="main">

                <!-- ======= Breadcrumbs ======= -->
                <div class="breadcrumbs d-flex align-items-center" style="background-image: url('easytopoimage/landbuy.jpeg');">
                    <div class="container position-relative d-flex flex-column align-items-center" data-aos="fade">

                        <h2> ADMIN PANEL </h2>
                        <ol>
                            <li><a href="indexuser.php">Home</a></li>
                            <li>Welcome admin </li>
                        </ol>

                    </div>
                </div><!-- End Breadcrumbs -->



            </main><!-- End #main -->
            <!--            ==========================================ADMINISTRATIVE PANEL===============================================-->



          
<div class="container-fluid px-4">
    <div class="row mt-4">

        <div class="col-md-12">
            <?php include ('message.php')?>
            <div class="card">
                <div class="card-header">
                    <h4>Add Users/Admin
                        <a href="viewregister.php" class="btn btn-danger float-end">back</a>
                    </h4>
                </div>
                <div class="card-body">
                <form action="code.php" method="POST">
                                                    <!-- User Image -->

                                                    
                                   <div class="col-md-6 mb-3">
                                            <label for="">Profile Image</label>
                                            <input type="file" required name="image" required="" class="form-control">
                                        </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label for="">First Name</label>
                                    <input type="text" required name="fname" class="form-control">
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="">Last Name</label>
                                    <input type="text" required name="lname" class="form-control">
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="">Email</label>
                                    <input type="email" required name="email" class="form-control">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="">Telephone</label>
                                    <input type="text" required name="telephone" class="form-control">
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="">Password</label>
                                    <input type="password" required name="password" class="form-control">
                                </div>
                                <!-- Region Selection -->
                                <div class="col-md-6 mb-3">
                                    <label for="">Select Region</label>
                                    <select name="idregion" required class="form-control">
                                        <option value="">------ Click to select a region----</option>
                                        <?php
                                        $regionl = "SELECT * FROM region WHERE statusregion='0'";
                                        $regionl_run = mysqli_query($con, $regionl);
                                        foreach ($regionl_run as $regionl_item) {
                                            echo "<option value='{$regionl_item['idregion']}'>{$regionl_item['nameregion']}</option>";
                                        }
                                        ?>
                                    </select>
                                </div>

                                                                <!-- City Selection -->
                                                                <div class="col-md-6 mb-3">
                                    <label for="">Select Town</label>
                                    <select name="idtown" required class="form-control">
                                        <option value="">------ Click to select a Town ----</option>
                                        <?php
                                        $town_query = "SELECT * FROM town WHERE statustown='0'";
                                        $city_run = mysqli_query($con, $town_query);
                                        foreach ($city_run as $town_item) {
                                            echo "<option value='{$town_item['idtown']}'>{$town_item['nametown']}</option>";
                                        }
                                        ?>
                                    </select>
                                </div> 
                                <div class="col-md-6 mb-3">
                                    <label for="">Select District</label>
                                    <select name="iddistrict" required class="form-control">
                                        <option value="">------ Click to select a District ----</option>
                                        <?php
                                        $town_query = "SELECT * FROM district WHERE statusdistrict='0'";
                                        $city_run = mysqli_query($con, $town_query);
                                        foreach ($city_run as $town_item) {
                                            echo "<option value='{$town_item['iddistrict']}'>{$town_item['namedistrict']}</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label for="">Role</label>
                                    <select name="role_as" required class="form-control">
                                        <option value="">--Select Role</option>
                                        <option value="admin">Admin</option>
                                        <option value="client">Client</option>
                                        <option value="surveyor">Surveyor</option>
                                        <option value="notary">Notary</option>
                                       
                                    </select>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="">Status</label>
                                    <input type="checkbox" width="70px" height="70px" name="status" value="1"/>
                                </div>

                                <div class="col-md-12 mb-3">
                                    <button type="submit" class="btn btn-primary" name="add_btn">Add User/Admin</button>
                                </div>
                            </form>                         
                </div>
            </div>
        </div>

    </div>
</div>


            <a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i
                    class="bi bi-arrow-up-short"></i></a>

            <div id="preloader"></div>

            <!-- Vendor JS Files -->
            <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
            <script src="assets/vendor/aos/aos.js"></script>
            <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
            <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
            <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
            <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
            <script src="assets/vendor/php-email-form/validate.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
            <script src="js/scripts.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
            <script src="js/datatables-simple-demo.js"></script>

            <!-- Template Main JS File -->
            <script src="assets/js/main.js"></script>


        </body>

    </html>
