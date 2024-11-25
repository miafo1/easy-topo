<?php 
session_start();
include('config/dbcon.php'); 
?>
<html>
    <head>
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1.0" name="viewport">

        <title>EASY-TOPO</title>
      
        <meta content="" name="description">
        <meta content="" name="keywords">

        <!-- Favicons -->
        <!--            <link href="assets/img/favicon.png" rel="icon">
                    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">-->

        <!-- Google Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link
            href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,
            400;1,600;1,700&family=Roboto:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Work+Sans:ital,
            wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">

        <!-- Vendor CSS Files -->
        <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
        <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
        <link href="assets/vendor/aos/aos.css" rel="stylesheet">
        <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
        <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

        <!-- Template Main CSS File -->
        <link href="assets/css/main.css" rel="stylesheet">
    
        <title>Index user</title>
        <link rel="stylesheet" type="text/css" href="easytopocss/bootstrap.css"> 
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        
    </head>
    <body>
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
                        <li>
                            <form name="" method="POST" action="allcode.php">
                                <button type="submit" class="dropdown-item" name="logout_btn" style="color: yellowgreen; ">LOGOUT</button>
                            </form>
                        </li>

                        <li><a href="indexuser.php" class="active">Home</a></li>
                        <li><a href="proposeland.php" >Propose your land</a></li>
                        <li><a href="booksurveyor.php">Book for survey</a></li>
                        <li class="dropdown"><a href="#"><span>Book a land</span> <i
                                    class="bi bi-chevron-down dropdown-indicator"></i></a>
                            <ul>
                                <li class="dropdown"><a href="#"><span>Adamawa</span> <i
                                            class="bi bi-chevron-down dropdown-indicator"></i></a>
                                    <ul>
                                        <li><a href="products.php?town_id=4">Ngaoundere </a></li>
                                        <li><a href="products.php?town_id=2"> Yola</a></li>
                                        <li><a href="products.php?town_id=13">Meiganga</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown"><a href="#"><span>Center</span> <i
                                            class="bi bi-chevron-down dropdown-indicator"></i></a>
                                    <ul>
                                        <li><a href="products.php?town_id=1">Yaounde</a></li>
                                        <li><a href="products.php?town_id=5">Obala</a></li>
                                        <li><a href="products.php?town_id=6">Mbalmayo</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown"><a href="#"><span>East</span> <i
                                            class="bi bi-chevron-down dropdown-indicator"></i></a>
                                    <ul>
                                        <li><a href="products.php?town_id=7">Bertoua</a></li>
                                        <li><a href="products.php?town_id=8">batouri</a></li>
                                        <li><a href="products.php?town_id=9">Abong-Mbang</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown"><a href="#"><span>Far North</span> <i
                                            class="bi bi-chevron-down dropdown-indicator"></i></a>
                                    <ul>
                                        <li><a href="products.php?town_id=10">Mora</a></li>
                                        <li><a href="products.php?town_id=11">Kousseri</a></li>
                                        <li><a href="products.php?town_id=12">Maroua</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown"><a href="#"><span>Littoral</span> <i
                                            class="bi bi-chevron-down dropdown-indicator"></i></a>
                                    <ul>
                                        <li><a href="products.php?town_id=3">Douala</a></li>
                                        <li><a href="products.php?town_id=14">Edea</a></li>
                                        <li><a href="products.php?town_id=15">Nkonsamba</a></li>
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
                        <li><a href="client_chat.php">Consultation</a></li>
                        <li><a href="contact.html">Contact</a></li>
                    </ul>
                </nav><!-- .navbar -->

            </div>
        </header>
        <div class="container-fluid well" >
            <div class="jumbotron" style="background-image:  url(easytopoimage/ville.png);background-position: center center;
                 background-repeat: no-repeat;
                 background-size: cover;">
                <div class="container" style="background-image:  url(easytopoimage/nature.png);
                     background-repeat: no-repeat;
                     background-size: cover;">
                    <h1>Cameroon EASY-TOPO <img src="easytopoimage/flag.png" alt="cmeroon flag"></h1>

                </div>
            </div>
        </div>
        <main role="main" class="container-fluid">
           
<hr class="featurette-divider">

<div class="row featurette">
  <div class="col-md-7">
    <h2 class="featurette-heading">Briefing</h2>
    <p class="lead"> EASY-TOPO platform has been meticulously designed and developed as an intuitive web application. It empowers users by providing a seamless and user-friendly interface to engage in proposal submissions, bookings, consultations, and real-time land measurements. By incorporating cutting-edge technologies and robust features, EASY-TOPO enables individuals to navigate the intricate landscape of land transactions with confidence and ease. </p>
  </div>
  <div class="col-md-5" style="overflow-x: hidden;">
    <img alt="500x500" style="width: 700px; height: 500px;" src="easytopoimage\logo.jpg" data-holder-rendered="true">
  </div>
</div>

<hr class="featurette-divider">

<div class="row featurette">
  <div class="col-md-7 order-md-2">
    <h2 class="featurette-heading">Notary</h2>
    <p class="lead">The notary handles legal aspects related to land transactions, such as verifying ownership documents, overseeing contracts, and ensuring the legality of transfers or transactions between clients.</div>
    <h4>
                                    <a href="notaryview.php" class="btn btn-danger float-end">VIEW NOTARY PROFILE</a>
                                </h4>
    <div class="col-md-5 order-md-1" style="overflow-x: hidden;">
    <img  alt="500x500" src="easytopoimage/notary.webp" data-holder-rendered="true" style="width: 700px; height: 500px;">
  </div>
</div>

<hr class="featurette-divider">

<div class="row featurette">
  <div class="col-md-7">
    <h2 class="featurette-heading">Surveyor</h2>
    <p class="lead"> The surveyor provides technical data about land, such as coordinates, descriptions, and other attributes (e.g., size, land type). They also upload images and documentation that the admin reviews before making the land available in the system.</p>
    <h4>
                                    <a href="surveyorview.php" class="btn btn-danger float-end">VIEW SUVEYORS PROFILE</a>
                                </h4>  
</div>
  <div class="col-md-5" style="overflow-x: hidden;">
    <img  alt="500x500" src="easytopoimage\surv.png" data-holder-rendered="true" style="width: 700px; height: 500px;">
  </div>
</div>

 <hr class="featurette-divider">

<div class="row featurette">
  <div class="col-md-7 order-md-2">
    <h2 class="featurette-heading">clients/Visitors</h2>
    <p class="lead"> The client is the end-user searching for land to purchase. They submit their requirements (e.g., land size, location, and purpose) and can view available listings, make reservations, and communicate with the admin or other actors.</p>
    <h4>
    <a href="search_form.php" class="btn btn-danger float-end">Quick land seaching</a>
   </h4>  
</div>
  <div class="col-md-5" style="overflow-x: hidden;">
    <img  alt="500x500" src="easytopoimage\delegate.jpg" data-holder-rendered="true" style="width: 700px; height: 500px;">
  </div>
</div>

<hr class="featurette-divider">
                
            
       
            </main>
        <script src="easytopojs/jquery.js"></script>
        <script src="easytopojs/bootstrap.min.js"></script>
        <script src="easytopojs/holder.js"></script>
        <script src="easytopojs/script.js"></script>
        <!-- ======= Footer ======= -->
        <footer id="footer" class="footer">

            <div class="footer-content position-relative">
                <div class="container">
                    <?php include('message.php'); ?>
                    <div class="row">
                        

                        <div class="col-lg-4 col-md-6">
                            <div class="footer-info">
                                <h3>EASY-TOPO</h3>
                                <p>
                                    CAMEROON <br>
                                    <br><br>
                                    <strong>Phone:</strong> +237 671343867<br>
                                    <strong>Email:</strong> easytopo@gmail.com<br>
                                </p>
                                <div class="social-links d-flex mt-3">
                                    <a href="#" class="d-flex align-items-center justify-content-center"><i class="bi bi-twitter"></i></a>
                                    <a href="#" class="d-flex align-items-center justify-content-center"><i class="bi bi-facebook"></i></a>
                                    <a href="#" class="d-flex align-items-center justify-content-center"><i class="bi bi-instagram"></i></a>
                                    <a href="#" class="d-flex align-items-center justify-content-center"><i class="bi bi-linkedin"></i></a>
                                </div>
                            </div>
                        </div><!-- End footer info column-->

                        <div class="col-lg-2 col-md-3 footer-links">

                        </div><!-- End footer links column-->

                        <div class="col-lg-2 col-md-3 footer-links">
                             <li>
                                 <form name="" method="POST" action="allcode.php">
                                <button type="submit" class="dropdown-item" name="logout_btn" style="color: yellowgreen; ">LOGOUT</button>
                            </form>
                        </li>

                        </div><!-- End footer links column-->

                        <div class="col-lg-2 col-md-3 footer-links">
                            

                        </div><!-- End footer links column-->

                        <div class="col-lg-2 col-md-3 footer-links">
                            <h4>Our Services</h4>
                            <ul>

                                <li><a href="proposeland.php">Propose a land</a></li>
                                <li><a href="booksurveyor.php">Book for Surveyor</a></li>
                                <li><a href="search_form.php">Book for a land</a></li>
                                <li><a href="consultation.php">Make consultation</a></li>

                            </ul>

                        </div><!-- End footer links column-->

                    </div>
                </div>
            </div>

            <div class="footer-legal text-center position-relative">
                <div class="container">
                    <div class="copyright">
                        &copy; Copyright <strong><span>EASY-TOPO</span></strong>
                    </div>
                    <div class="credits">
                        <!-- All the links in the footer should remain intact. -->
                        <!-- You can delete the links only if you purchased the pro version. -->
                        <!-- Licensing information: https://bootstrapmade.com/license/ -->
                        <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/upconstruction-bootstrap-construction-website-template/ -->
                        <a href="https://bootstrapmade.com/"></a> <a
                            href="https://themewagon.com"></a>
                    </div>
                </div>
            </div>

        </footer>
        <!-- End Footer -->


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

        <!-- Template Main JS File -->
        <script src="assets/js/main.js"></script>


    </body>
</html>