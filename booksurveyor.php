<!DOCTYPE html>
<?php 
// include('authenticate.php'); 
?>
<html>
    <!DOCTYPE html>
    <html lang="en">

        <head>
            <meta charset="utf-8">
            <meta content="width=device-width, initial-scale=1.0" name="viewport">

            <title>surveyor</title>
            
            
             <script>
                function showTowns(){
                    var region = document.getElementById("region").value;
                    var townOptions=document.getElementById("townOptions");
                    //clear previous options
                    townOptions.innerHTML="";
                     // Add town base on regions
                     if(region=== "Adamawa"){
                         addOption("Ngaoundere","Ngaoundere");
                          addOption("yola","yolo");
                           addOption("Meiganga","Meiganga");
                     }else if(region=== "Center"){
                         addOption("Yaounde","Yaounde");
                          addOption("Bafia","Bafia");
                           addOption("Obala","Obala");
                           addOption("Mbalmayo","Mbalmayo");
                     }else if(region=== "East"){
                         addOption("Bertoua","Bertoua");
                          addOption("Yokadouma","Yokadouma");
                           addOption("Abong-Mbang","Abong-Mbang");
                           
                     }else if(region=== "Far North"){
                         addOption("Mora","Mora");
                          addOption("Kousseri","Kousseri");
                           addOption("Maroua","Maroua");
                           
                     }else if(region=== "Littoral"){
                         addOption("Douala","Douala");
                          addOption("Edea","Edea");
                           addOption("Nkongsamba","Nkongsamba");
                           
                     }else if(region=== "North"){
                         addOption("Garoua","Garoua");
                          addOption("Guider","Guider");
                           addOption("Figuil","Figuil");
                          
                     }else if(region=== "West"){
                         addOption("Bafoussam","Bafoussam");
                          addOption("Foumban","Foumban");
                           addOption("Dschang","Dschang");
                           
                     }else if(region=== "South"){
                         addOption("Ebolowa","Ebolowa");
                          addOption("Sangmelima","Sangmelima");
                           addOption("Kribi","Kribi");
                        
                     }else if(region=== "Southwest"){
                         addOption("Buea","Buea");
                          addOption("Limbe","Limbe");
                           addOption("Tiko","Tiko");
                        
                     }
                         townOptions.disabled=false;
                }
//                enable the town select dropdown
            
                function addOption(text,value){
                    var option = document.createElement("option");
                    option.text = text;
                    option .value = value;
                    document.getElementById("townOptions").add(option);
                }
                function submitForm(){
                    var region=document.getElementById("region").value;
                    var town=document.getElementById("townOptions").value;
                    alert("selected Region: "+ region + "\nselected town:"+ town);
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
            <!-- Summernote CSS - CDN Link -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <!-- //Summernote CSS - CDN Link -->

            <!-- =======================================================
            * Template Name: UpConstruction - v1.3.0
            * Template URL: https://bootstrapmade.com/upconstruction-bootstrap-construction-website-template/
            * Author: BootstrapMade.com
            * License: https://bootstrapmade.com/license/
            ======================================================== -->
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
                  <li><a href="indexuser.php.?page= <?php echo base64_encode('indexuser'); ?>"><span class="bts">Home </span></a></li>
                  <li><a href="proposeland.php.?page= <?php echo base64_encode('proposeland'); ?>"><span class="bts">Propose your land</span></a></li>
                  <li><a href="booksurveyor.php.?page= <?php echo base64_encode('booksurveyor'); ?>"><span class="bts">Book for survey</span></a></li>
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
                            <li><a href="consultation.php.?page= <?php echo base64_encode('consultation'); ?>"><span class="bts">Consultation</span></a></li>
                            <li><a href="contact.html">Contact</a></li>
                        </ul>
                    </nav><!-- .navbar -->

                </div>
            </header><!-- End Header -->

            <main id="main">

                <!-- ======= Breadcrumbs ======= -->
                <div class="breadcrumbs d-flex align-items-center" style="background-image: url('easytopoimage/surv.png');">
                    <div class="container position-relative d-flex flex-column align-items-center" data-aos="fade">

                        <h2>BOOK FOR SURVEY SERVICES</h2>
                        <ol>
                            <li><a href="indexuser.php">Home</a></li>
                            <li>Book for survey services</li>
                        </ol>

                    </div>
                </div><!-- End Breadcrumbs -->

                <!-- ======= Our BOOKING FORM Section ======= -->
                <section id="projects" class="projects">
                    <div class="container" data-aos="fade-up">

                        <div class="portfolio-isotope" data-portfolio-filter="*" data-portfolio-layout="masonry"
                             data-portfolio-sort="original-order">
                            <div class="row gy-4 portfolio-container" data-aos="fade-up" data-aos-delay="200">
                                <div class="col-lg-10 col-md-12 portfolio-item filter-remodeling">
                                    <div class="portfolio-content h-100">

                                        <div class="panel-body">
                                            <form name="" method="POST" action="">
                                                  <label for="region">Select Region:</label>
                                                  <select id="region">
                                                    <option value="Adamawa">Adamawa</option>
                                                     <option value="Center">Center</option>
                                                      <option value="East">East</option>
                                                       <option value="Far North">Far North</option>
                                                        <option value="Littoral">Littoral</option>
                                                          <option value="North">North</option>
                                                           <option value="Northwest">Northwest</option>
                                                            <option value="West">West</option>
                                                             <option value="South">South</option>
                                                             <option value="Southwest">Southwest</option>
                                                </select><br><br>
                                                <button onclick="showTowns()"> Select Town</button>
                                               
                                                <label for="townOptions">Town:</label>
                                                <select id="townOptions" disabled></select>
                                                  <br><br>
                                                <label>Enter your name:</label>
                                                <input type="text"  required="" class="form-control" placeholder="Enter your name" name="nom" value=""><br>
                                                <label>Enter your email:</label>
                                                <input type="email"  required="" class="form-control" placeholder="Enter your email" name="nom" value=""><br>
                                                  <label>Enter your Tel:</label>
                                                  <input type="tel"  required="" class="form-control" placeholder="Enter your phone number" name="nom" value=""><br>
                                                   <label>Enter your Delivery date:</label>
                                                   <input type="date"  required="" class="form-control" placeholder="Enter Date" name="nom" value=""><br>
                                                 <label>Enter the number of surveyor deserved:</label>
                                                 <input type="number"  required="" class="form-control" placeholder="Enter Number" name="nom" value=""><br>
                                                
                                                <input type="submit" class="btn btn-primary" name="ok" value=" Submit" style="margin-left: 100px"><br>
                                            </form>
                                           
                                        </div>
                                        
                                    </div><!-- End Projects Item -->
                                    <div class="card-header">
                                <h4>
                                    <a href="surveyorview.php" class="btn btn-danger float-end">VIEW SUVEYORS PROFILE</a>
                                </h4>
                            </div>

                                    <!--        <div class="col-lg-10 col-md-12 portfolio-item filter-remodeling">
                                              <div class="portfolio-content h-100">
                                                <img src="assets/img/projects/remodeling-1.jpg" class="img-fluid" alt="">
                                                <div class="portfolio-info">
                                                  <h4>Remodeling 1</h4>
                                                  <p>Lorem ipsum, dolor sit amet consectetur</p>
                                                  <a href="assets/img/projects/remodeling-1.jpg" title="Remodeling 1"
                                                    data-gallery="portfolio-gallery-remodeling" class="glightbox preview-link"><i
                                                      class="bi bi-zoom-in"></i></a>
                                                  <a href="project-details.html" title="More Details" class="details-link"><i
                                                      class="bi bi-link-45deg"></i></a>
                                                </div>
                                              </div>
                                            </div> End Projects Item -->



                                </div><!-- End Projects Container -->

                            </div>

                        </div>
                </section><!-- End Our Projects Section -->

            </main><!-- End #main -->

            <!-- ======= Footer ======= -->
            <footer id="footer" class="footer">

                <div class="footer-content position-relative">
                    <div class="container">
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

                            </div><!-- End footer links column-->

                            <div class="col-lg-2 col-md-3 footer-links">

                            </div><!-- End footer links column-->

                            <div class="col-lg-2 col-md-3 footer-links">
                                <h4>Our Services</h4>
                                <ul>
                                    
                                    <li><a href="proposeland.php">Propose a land</a></li>
                                    <li><a href="booksurveyor.php">Book for Surveyor</a></li>
                                    <li><a href="#">Book for a land</a></li>
                                    <li><a href="consultation.php">Make consultation</a></li>
                                </ul>
                                
                            </div><!-- End footer links column-->

                        </div>
                    </div>
                </div>

                <div class="footer-legal text-center position-relative">
                    <div class="container">
                        <div class="copyright">
                            &copy; Copyright <strong><span>EASY-TOPO</span></strong>. All Rights Reserved
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
             <script src="https://code.jquery.com/jquery-3.6.0.min.js""></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
            <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
            <script src="assets/vendor/aos/aos.js"></script>
            <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
            <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
            <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
            <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
            <script src="assets/vendor/php-email-form/validate.js"></script>
 <!-- Summernote JS - CDN Link -->
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#your_summernote").summernote();
            $('.dropdown-toggle').dropdown();
        });
    </script>
    <!-- //Summernote JS - CDN Link -->
            <!-- Template Main JS File -->
            <script src="assets/js/main.js"></script>
            
           
        </body>

    </html>

</body>

</html>
