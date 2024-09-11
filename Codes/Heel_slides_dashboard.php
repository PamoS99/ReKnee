<?php
session_start();
error_reporting(0);
include('dbconnection.php');
if (isset($_POST['startbtn'])) {
    $sqlm = mysqli_query($con, "SELECT * FROM currentangle WHERE user_id='1' and excersie_id='4' order by id desc limit 1");
    $rowm = mysqli_fetch_array($sqlm);
    if ($rowm > 0) {
        $angle1 = $rowm['angle1'];
        $angle2 = $rowm['angle2'];
        $ccdatetime = date('Y-m-d H:i:s');
        $sqls = mysqli_query($con, "update calibrationangle set status='0' WHERE user_id='1'");
        $sqlmssl = mysqli_query($con, "SELECT * FROM repcheckcount WHERE user_id='1' and excersie_id='4' order by id desc limit 1");
        $rowmssl = mysqli_fetch_array($sqlmssl);
        if ($rowmssl > 0) {
            $checkcountid = $rowmssl['id'];
            $sqls = mysqli_query($con, "update repcheckcount set count='0' WHERE id='$checkcountid'");
        }
        $sqlmssf = mysqli_query($con, "SELECT * FROM repcountset WHERE user_id='1' and excersie_id='4' order by id desc limit 1");
        $rowmssf = mysqli_fetch_array($sqlmssf);
        if ($rowmssf > 0) {
            $startDatetime = date('Y-m-d H:i:s');
            $idddddd = $rowmssf['id'];
            $sqls = mysqli_query($con, "update repcountset set starttime='$startDatetime' WHERE id='$idddddd'");
            $sqls = mysqli_query($con, "insert into calibrationangle (angle1,angle2,status,user_id,excersie_id,datetime,repcountset_id) VALUES ($angle1,$angle2,1, 1, 4,'$ccdatetime','$idddddd')");
        }
        
    }
//    header('location:Active_assisted_extension_dashboard.php');
}
if (isset($_POST['nextbtn'])) {
    $sqlmssf = mysqli_query($con, "SELECT * FROM repcountset WHERE user_id='1' and excersie_id='4' order by id desc limit 1");
    $rowmssf = mysqli_fetch_array($sqlmssf);
    if ($rowmssf > 0) {
        $setnumberr = $rowmssf['setnumber'] + 1;
        $daynumber = $_SESSION['selectedDay'];
        $endDatetime = date('Y-m-d H:i:s');
        $idddddd = $rowmssf['id'];
        $currentDate = date('Y-m-d');
        $sqls = mysqli_query($con, "update repcountset set endtime='$endDatetime' WHERE id='$idddddd'");
        $sqls = mysqli_query($con, "update repcountset set status='0' WHERE user_id='1' and excersie_id='4'");
        $sqls = mysqli_query($con, "insert into repcountset (setnumber,daynumber,datetime,status,excersie_id,user_id,starttime) VALUES ('$setnumberr', '$daynumber','$currentDate',1,4,1,'$endDatetime')");
    }
    $sqlmssf = mysqli_query($con, "SELECT * FROM repcountset WHERE user_id='1' and excersie_id='4' order by id desc limit 1");
    $rowmssf = mysqli_fetch_array($sqlmssf);
    if ($rowmssf > 0) {
        $idddd = $rowmssf['id'];
        $sqls = mysqli_query($con, "update repcheckcount set count='0' WHERE user_id='1' and excersie_id='4'");
        $sqls = mysqli_query($con, "insert into repcheckcount (count,status,excersie_id,user_id,repcountset_id) VALUES (0, 1,4,1,'$idddd')");
    }
}
if (isset($_POST['conttbtn'])) {
    $sqlmssf = mysqli_query($con, "SELECT * FROM repcountset WHERE user_id='1' and excersie_id='4' order by id desc limit 1");
    $rowmssf = mysqli_fetch_array($sqlmssf);
    if ($rowmssf > 0) {
        $setnumberr = $rowmssf['setnumber'] + 1;
        $daynumber = $_SESSION['selectedDay'];
        $endDatetime = date('Y-m-d H:i:s');
        $idddddd = $rowmssf['id'];
        $currentDate = date('Y-m-d');
        $sqls = mysqli_query($con, "update repcountset set endtime='$endDatetime' WHERE id='$idddddd'");
        $sqls = mysqli_query($con, "update repcountset set status='0' WHERE user_id='1' and excersie_id='4'");
        header('location:Week01.php');
        
    }
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
        <script>
        function updateH1() {
            // Create a new XMLHttpRequest object
            var xhr = new XMLHttpRequest();

            // Configure it: GET-request for the URL /update.php
            xhr.open('GET', 'Heel_slides_update_angle.php', true);

            // Send the request over the network
            xhr.send();

            // This will be called after the response is received
            xhr.onload = function() {
                if (xhr.status != 200) { // analyze HTTP response status
                    alert(`Error ${xhr.status}: ${xhr.statusText}`); // e.g. 404: Not Found
                } else { // show the result
                    document.getElementById('dynamic-h1').innerHTML = xhr.responseText; // response is the server
                }
            };

            xhr.onerror = function() {
                alert("Request failed");
            };
        }
        function updateH2() {
            // Create a new XMLHttpRequest object
            var xhr = new XMLHttpRequest();

            // Configure it: GET-request for the URL /update.php
            xhr.open('GET', 'Heel_slides_update_count.php', true);

            // Send the request over the network
            xhr.send();

            // This will be called after the response is received
            xhr.onload = function() {
                if (xhr.status != 200) { // analyze HTTP response status
                    alert(`Error ${xhr.status}: ${xhr.statusText}`); // e.g. 404: Not Found
                } else { // show the result
                    document.getElementById('countiddynamic').innerHTML = xhr.responseText; // response is the server
                }
            };

            xhr.onerror = function() {
                alert("Request failed");
            };
        }
        

        // Update the h1 tag every 5 seconds (5000 milliseconds)
        setInterval(updateH1, 500);
        setInterval(updateH2, 2000);
    </script>
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
                        <a href="summery.php" class="nav-item nav-link"><i class="fa fa-th me-2"></i>Summery</a>
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
                                <h5 class=" col-12 col-sm-6 text-center ">Heel Slides</h5>           
                            </div>
                            <div class="row g-4 justify-content-between p-2">
                                <div class="column float-left w-50">
                                    <div class="bg-light rounded h-100 p-4 ">
                                        <p class="p-2 mb-2 bg-primary text-white">Reps</p>
                                        <p class="p-2 mb-2 bg-primary text-white">Sets</p>
                                        <p class="p-2 mb-2 bg-primary text-white">Start</p>
                                    </div>
                                </div>
                                <div class="column w-50 ">
                                    <div class="bg-light rounded h-100 p-4 ">
                                        <p class="p-2 mb-2 bg-primary text-white text-center"><span id="countiddynamic">0</span>/10</p>
                                        <?php
                                        $startdatettt=date('Y-m-d H:i:s');;
                                        $sqlmssfm = mysqli_query($con, "SELECT * FROM repcountset WHERE user_id='1' and excersie_id='4' order by id desc limit 1");
                                        $rowmssfm = mysqli_fetch_array($sqlmssfm);
                                        if ($rowmssfm > 0) {
                                            $settttnumber = $rowmssfm['setnumber'];
                                          $startdatettta= $rowmssfm['starttime'];
                                          if($startdatettta==null || $startdatettta==""){
                                              
                                          }else{
                                              $startdatettt=$startdatettta;
                                          }
                                        }
                                        ?>
                                        <p class="p-2 mb-2 bg-primary text-white text-center"><?php echo $settttnumber; ?>/3</p>
                                        <p class="p-2 mb-2 bg-primary text-white text-center"><?php echo $startdatettt; ?></p>
                                    </div>
                                </div>    
                            </div>
                            <form method="post">
                                <div class="bg-light rounded d-flex align-items-center justify-content-between p-2"> 
                                    <h7 class=" col-6 col-lg-6 text-center ">Angle</h7>

                                    <button type="submit" name="startbtn" id="startbtn" class="btn btn-primary rounded-pill w-50">START</button> 

                                </div>
                            </form>
                            <div class="p-4 mb-2 d-flex  align-items-center justify-content-center " >
                                <h4 class="p-4 mb-2 bg-secondary text-white text-center" style="border-radius: 10px;" id="dynamic-h1"> 0 deg</h4>
                            </div>
                            <form method="post">
                                <div class="bg-light rounded d-flex justify-content-center  p-2">  
                                    <button type="submit" name="nextbtn" id="nextbtn" class="btn btn-primary rounded-pill w-50 m-2">NEXT</button> 
                                </div> 
                            </form>
                            <form method="post">
                                <div class="bg-light rounded d-flex justify-content-center  p-2">  
                                    <button  type="submit" name="conttbtn" id="conttbtn"  class="btn btn-primary rounded-pill w-50 m-2">COMPLETED</button> 
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