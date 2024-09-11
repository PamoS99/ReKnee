<?php
session_start();
error_reporting(0);
if (isset($_SESSION['selectedDay'])){
    if(($_SESSION['selectedDay']==null) or ($_SESSION['selectedDay']=='') or ($_SESSION['selectedDay']==' ')){
            $_SESSION['selectedDay']=1;
    }
}else{
     $_SESSION['selectedDay']=1;
}
?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <title>ReKnee App</title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta content="" name="keywords">
        <meta content="" name="description">

        <!-- Favicon -->
        <link href="img/favicon.ico" rel="icon">

        <!-- Google Web Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet">

        <!-- Icon Font Stylesheet -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
        <!-- Libraries Stylesheet -->
        <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
        <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

        <!-- Customized Bootstrap Stylesheet -->
        <link href="css/bootstrap.min.css" rel="stylesheet">

        <!-- Template Stylesheet -->
        <link href="css/style.css" rel="stylesheet">
    </head>

    <body>
        <div class="container-xxl position-relative bg-white d-flex p-0">
            <!-- Spinner Start -->
            <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
                <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
            </div>
            <!-- Spinner End -->


            <!-- Sidebar Start -->
            <div class="sidebar pe-4 pb-3">
                <nav class="navbar bg-light navbar-light">
                    <!--                <a href="index.php" class="navbar-brand mx-4 mb-3">
                                        <h3 class="text-primary"><i class="fa fa-bars"></i> DASHMIN</h3>
                                    </a>-->
                    <div class="d-flex align-items-center ms-4 mb-4">
                        <div class="position-relative">
                            <img class="rounded-circle" src="img/userid.jpg" alt="" style="width: 40px; height: 40px;">
                            <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
                        </div>
                        <div class="ms-3">
                            <h6 class="mb-0">User name</h6>
                            <span>User email</span>
                        </div>
                    </div>
                    <div class="navbar-nav w-100">
                        <a href="index.php" class="nav-item nav-link "><i class="fa fa-tachometer me-2"></i>Rehab Journey</a>
                        <a href="summery.php" class="nav-item nav-link "><i class="fa fa-th me-2"></i>Summery</a>
                    </div>
                </nav>
            </div>
            <!-- Sidebar End -->


            <!-- Content Start -->
            <div class="content">
                <!-- Navbar Start -->
                <nav class="navbar navbar-expand bg-light navbar-light sticky-top px-4 py-0">
                    <div><!--<a href="index.php" class="navbar-brand d-flex d-lg-none me-4">-->
                        <h2 class="text-primary mb-0"><img class="rounded-circle me-lg-2" src="img/logo.jpeg" alt="" style="width: 40px; height: 40px;"></img>&nbsp &nbsp </h2>
                        <!--</a>-->
                    </div>
                    <a href="#" class="sidebar-toggler flex-shrink-0">
                        <i class="fa fa-bars" ></i>
                    </a>
                    <div class="navbar-nav align-items-center ms-auto">
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                                <img class="rounded-circle me-lg-2" src="img/user.jpg" alt="" style="width: 40px; height: 40px;">
                                <span class="d-none d-lg-inline-flex">John Doe</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                                <a href="profile.php" class="dropdown-item">My Profile</a>
                                <!--<a href="#" class="dropdown-item">Settings</a>-->
                                <a href="signin.php" class="dropdown-item">Log Out</a>
                            </div>
                        </div>
                    </div>
                </nav></nav>
                <!-- Navbar End -->


                <!-- Blank Start -->
                <div class="container-fluid pt-4 px-4">
                    <div class="row  align-items-center justify-content-center g-4">
                        <div class="col-sm-12 col-lg-6 pb-3"> 
                            <div class="ms-0">
                                <h6 class=" mb-2">Week 01</h6>                             
                            </div> 
                            <div class="navbar-nav align-items-right justify-content-between ms-auto">
                                <div class="nav-item dropdown">

                                    <select class="form-select" id="floatingSelect" aria-label="Select your Day" id="floatingSelect" style="width: 30%;min-width: 50px">
                                        <?php
                                        $i = 1;
                                        while ($i < 8) {
                                            if (isset($_SESSION['selectedDay'])) {
                                                if (($_SESSION['selectedDay']) == $i) {
                                                    ?>
                                                    <option value="<?php echo $i; ?>" selected>Day <?php echo $i; ?></option>
                                                    <?php
                                                } else {
                                                    ?>
                                                    <option value="<?php echo $i; ?>">Day <?php echo $i; ?></option>
                                                    <?php
                                                }
                                            } else {
                                                ?>

                                                <option value="<?php echo $i; ?>">Day <?php echo $i; ?></option>  
                                            <?php }
                                            $i=$i+1;
                                            } ?>
                                    </select>

                                </div>
                            </div>
                            <br>
                            <div class="bg-light rounded d-flex align-items-center justify-content-center p-2"> 
                                <h6 class=" col-12 col-sm-6 text-center">Exercises</h6>           
                            </div>
                            <div class="bg-light rounded d-flex align-items-center justify-content-between p-2">  
                                <a href="Active_assisted_extension.php"  class="btn btn-primary rounded-pill w-100 m-2">Active-assisted Extension</a> 
                            </div>
                            <div class="bg-light rounded d-flex align-items-center justify-content-between p-2">
                                <a href="Passive_flexion.php"  class="btn btn-primary rounded-pill w-100 m-2">Passive Flexion</a> 
                            </div>
                            <div class="bg-light rounded d-flex align-items-center justify-content-between p-2">    
                                <a href="SLR.php"  class="btn btn-primary rounded-pill w-100 m-2">SLR</a> 
                            </div>
                            <div class="bg-light rounded d-flex align-items-center justify-content-between p-2">    
                                <a href="Heel_slides.php"  class="btn btn-primary rounded-pill w-100 m-2">Heel Slides</a>                     
                            </div>
                        </div>               
                    </div>
                </div>
                <!-- Blank End -->


                <!--             Footer Start 
                            <div class="container-fluid pt-4 px-4">
                                <div class="bg-light rounded-top p-4">
                                    <div class="row">
                                        <div class="col-12 col-sm-6 text-center text-sm-start">
                                            &copy; <a href="#">Your Site Name</a>, All Right Reserved. 
                                        </div>
                                        <div class="col-12 col-sm-6 text-center text-sm-end">
                                            /*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/
                                            Designed By <a href="https://htmlcodex.com">HTML Codex</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                             Footer End 
                        </div>-->
                <!-- Content End -->


                <!-- Back to Top -->
                <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
            </div>

            <!-- JavaScript Libraries -->
            <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
            <script src="lib/chart/chart.min.js"></script>
            <script src="lib/easing/easing.min.js"></script>
            <script src="lib/waypoints/waypoints.min.js"></script>
            <script src="lib/owlcarousel/owl.carousel.min.js"></script>
            <script src="lib/tempusdominus/js/moment.min.js"></script>
            <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
            <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

            <!-- Template Javascript -->
            <script src="js/main.js"></script>

            <script>
                document.getElementById('floatingSelect').addEventListener('change', function
                        () {
                    var selectedValue = this.value;
                    // Define the URLs corresponding to each day
                    var urls = {
                        '1': 'sessionDay.php?dy=1',
                        '2': 'sessionDay.php?dy=2',
                        '3': 'sessionDay.php?dy=3',
                        '4': 'sessionDay.php?dy=4',
                        '5': 'sessionDay.php?dy=5',
                        '6': 'sessionDay.php?dy=6',
                        '7': 'sessionDay.php?dy=7'
                    };
                    // Redirect to the URL bas
                    if (urls[selectedValue]) {
                        window.location.href = urls[selectedValue];
                    }
                });

            </script>
    </body>

</html>