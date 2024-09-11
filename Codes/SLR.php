<?php
session_start();
error_reporting(0);
include('dbconnection.php');
if (isset($_POST['continbtn'])) {
    $sqlm = mysqli_query($con, "SELECT * FROM currentexercise WHERE user_id='1' and excersie_id='3'");
    $rowm = mysqli_fetch_array($sqlm);
    if ($rowm > 0) {
        $id = $rowm['id'];
        $sqls = mysqli_query($con, "update currentexercise set status='0' WHERE user_id='1'");
        $sqls = mysqli_query($con, "update currentexercise set status='1' WHERE id='$id'");
    } else {
        $sqls = mysqli_query($con, "update currentexercise set status='0' WHERE user_id='1'");
        $sqls = mysqli_query($con, "insert into currentexercise (status,user_id,excersie_id) VALUES (1, 1, 3)");
    }
    $currentDate = date('Y-m-d');
        $countdayyss= $_SESSION['selectedDay'];
    $sqlmss = mysqli_query($con, "SELECT * FROM repcountset WHERE user_id='1' and excersie_id='3' and daynumber='$countdayyss'");
    $rowmss = mysqli_fetch_array($sqlmss);
    if ($rowmss > 0) {
        
    } else {
        $sqlmssa = mysqli_query($con, "SELECT * FROM repcountset WHERE user_id='1' and excersie_id='3' order by id desc limit 1");
        $rowmssa = mysqli_fetch_array($sqlmssa);
        if ($rowmssa > 0) {
            $sqls = mysqli_query($con, "update repcountset set status='0' WHERE user_id='1' and excersie_id='3'");
            $now = strtotime($currentDate); // or your date as well
            $datee=$rowmssa['datetime'];
            $your_date = strtotime($datee);
            $datediff = $now - $your_date;
            $countdayy= $_SESSION['selectedDay'];
            $sqls = mysqli_query($con, "insert into repcountset (setnumber,daynumber,datetime,status,excersie_id,user_id) VALUES (1, '$countdayy','$currentDate',1,3,1)");
        } else {
            $countdayy= $_SESSION['selectedDay'];
            $sqls = mysqli_query($con, "update repcountset set status='0' WHERE user_id='1' and excersie_id='3'");
            $sqls = mysqli_query($con, "insert into repcountset (setnumber,daynumber,datetime,status,excersie_id,user_id) VALUES (1, '$countdayy','$currentDate',1,3,1)");
        }
    }
    $sqlmssr = mysqli_query($con, "SELECT * FROM repcountset WHERE user_id='1' and excersie_id='3' order by id desc limit 1");
    $rowmssr = mysqli_fetch_array($sqlmssr);
    if ($rowmssr > 0) {
        $idddd=$rowmssr['id'];
        $sqlmssat = mysqli_query($con, "SELECT * FROM repcheckcount WHERE user_id='1' and excersie_id='3' and repcountset_id='$idddd' order by id desc limit 1");
        $rowmssat = mysqli_fetch_array($sqlmssat);
        if ($rowmssat > 0) {
            
        }else{
            $sqls = mysqli_query($con, "update repcheckcount set status='0' WHERE user_id='1' and excersie_id='3'");
            $sqls = mysqli_query($con, "insert into repcheckcount (count,status,excersie_id,user_id,repcountset_id) VALUES (0, 1,3,1,'$idddd')");
        }
    }
    header('location:SLR_dashboard.php');
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
                    <a href="index.php" class="nav-item nav-link active"><i class="fa fa-tachometer me-2"></i>Rehab Journey</a>
                    <a href="widget.html" class="nav-item nav-link"><i class="fa fa-th me-2"></i>Summery</a>
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


                    <div class="bg-light rounded d-flex align-items-center justify-content-center p-2"> 
                        <h5 class=" col-12 col-sm-6 text-center">SLR</h5>           
                    </div>
                    <div class="bg-light position-relative">
                        <img  class=" d-flex justify-content-center" src="img/SLR.png" alt="" style="width:75%; height: auto ;margin: auto ; border: black solid"></img>                       
                    </div>

                    <div class="col-sm-12 col-lg-12">
                        <div class="bg-light rounded h-100 p-4">
                            <h6 class="mb-4">Instructions</h6>
                            <div class="accordion" id="accordionExample">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingOne">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapseOne" aria-expanded="true"
                                            aria-controls="collapseOne">
                                            <b>Starting Position:</b>
                                        </button>
                                    </h2>
                                    <div id="collapseOne" class="accordion-collapse collapse show"
                                        aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            Begin straight leg raises with the knee immobilizer on. Start by doing these exercises while lying down.
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingTwo">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapseTwo"
                                            aria-expanded="false" aria-controls="collapseTwo">
                                            <b>Quadriceps Contraction:</b>
                                        </button>
                                    </h2>
                                    <div id="collapseTwo" class="accordion-collapse collapse"
                                        aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            Perform a quadriceps contraction with the leg in full extension. This "locks" the knee and prevents excessive stress on the healing ACL graft.
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingThree">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapseThree"
                                            aria-expanded="false" aria-controls="collapseThree">
                                            <b>Raising the Leg:</b>
                                        </button>
                                    </h2>
                                    <div id="collapseThree" class="accordion-collapse collapse"
                                        aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            Keep the leg straight and lift it to about 45-60 degrees. Hold for a count of six.
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingFour">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapseFour"
                                            aria-expanded="false" aria-controls="collapseFour">
                                            <b>Lowering the Leg:</b>
                                        </button>
                                    </h2>
                                    <div id="collapseFour" class="accordion-collapse collapse"
                                        aria-labelledby="headingFour" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            Slowly lower the leg back onto the bed. Relax the muscles each time the leg touches down.
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingSix">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapseSix"
                                            aria-expanded="false" aria-controls="collapseSix">
                                            <b>Repetitions:</b>
                                        </button>
                                    </h2>
                                    <div id="collapseSix" class="accordion-collapse collapse"
                                        aria-labelledby="headingSix" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            Repeat the exercise 10 times with 3 sets in a day.
                                        </div>
                                    </div>
                                </div>                                
                            </div>
                        </div>
                    </div>
                    <div class="bg-light rounded d-flex align-items-right justify-content p-4"> 
                        <h6 class=" col-12 col-sm-6 text-right"><u>Tips</u></h6> 
                        
                    </div>
                    <div class="bg-light rounded d-flex align-items-justify p-1 ">
                        <ol>
                            <li>Breathe normally throughout the exercise.</li>
                            <li> Remember to relax the muscles each time the leg touches down..</li>
                        </ol>
                        
                    </div>                    
                    <div class="bg-light rounded d-flex align-items-right justify-content p-4"> 
                        <h6 class=" col-12 col-sm-6 text-right">Watch video</h6>                        
                    </div>                    
                    <div class="bg-light rounded d-flex align-items-right justify-content p-4">                  
                        <iframe class=" d-flex justify-content-center " allowfullscreen=" "accesskey=""src="https://www.youtube.com/embed/mZ6ERQjCL6k" style="width:75%; height: 200px ; margin: auto"> 
                        </iframe> 
                    </div>
                    <form method="post">
                        <div class="bg-light rounded d-flex justify-content-center  p-2"> 

                            <button id="continbtn" name="continbtn"  type="submit" class="btn btn-primary rounded-pill w-50 m-2">Continue</button> 

                        </div>
                    </form>
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
</body>

</html>