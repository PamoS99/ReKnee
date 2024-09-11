<?php
session_start();
error_reporting(0);
include('dbconnection.php');
if (!isset($_SESSION['selectedDay'])) {
    $_SESSION['selectedDay'] = 1;
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
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
                        <a href="widget.html" class="nav-item nav-link active"><i class="fa fa-th me-2"></i>Summery</a>
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
                        <div class="col-sm-12 col-xl-6">
                            <div class="bg-light rounded h-100 p-4">
                                <!--<h6 class="mb-4">Pills Navs & Tabs</h6>-->
                                <ul class="nav nav-pills justify-content-center mb-3" id="pills-tab" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link active " id="pills-home-tab" data-bs-toggle="pill"
                                                data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home"
                                                aria-selected="true"  >Daily </button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill"
                                                data-bs-target="#pills-profile" type="button" role="tab"
                                                aria-controls="pills-profile" aria-selected="false">Weekly</button>
                                    </li>
                                </ul>
                                <div class="tab-content" id="pills-tabContent">
                                    <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                                        <div style="display: flex;justify-content: center">
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
                                                        <?php
                                                    }
                                                    $i = $i + 1;
                                                }
                                                ?>
                                            </select>
                                        </div>

                                        <div class="row g-4 justify-content-between p-2">
                                            <h6 class="mb-0">Active-assisted Extension</h6>
                                            <div class="column float-left w-50">
                                                <?php
                                                $countdayyss = $_SESSION['selectedDay'];
                                                $excerid = 1;
                                                $repcountEx1 = 0;
                                                $angEx1 = 0;
                                                $duratEx1 = 0;
                                                $iii = 1;
                                                $angleecalin = 0;
                                                $sqlmss = mysqli_query($con, "SELECT * FROM repcountset WHERE excersie_id='$excerid' and daynumber='$countdayyss'");
                                                while ($rowmss = mysqli_fetch_array($sqlmss)) {

                                                    $rid = $rowmss['id'];
                                                    $sqlmsst = mysqli_query($con, "SELECT * FROM calibrationangle WHERE repcountset_id='$rid' order by id desc limit ");
                                                    $rowmsst = mysqli_fetch_array($sqlmsst);
                                                    if ($rowmsst > 0) {
                                                        $angleecalin = $rowmsst['angle1'];
                                                    }
                                                    $endtimee = $rowmss['endtime'];
                                                    $starttimee = $rowmss['starttime'];
                                                    $sqlmsstm = mysqli_query($con, "SELECT max(abs(angle1- '$angleecalin')) as maxid FROM currentangle WHERE datetime>='$starttimee' and datetime<='$endtimee'");
                                                    $rowmsstm = mysqli_fetch_array($sqlmsstm);
                                                    if ($rowmsstm > 0) {
                                                        $angEx1 = $angEx1 + round($rowmsstm['maxid'],2);
                                                    }
                                                    if ($rowmss['endtime'] != null) {
                                                        $duratEx1 = $duratEx1 + ((strtotime($rowmss['endtime']) - strtotime($rowmss['starttime'])));
                                                    }
                                                    $sqlmssd = mysqli_query($con, "SELECT * FROM repcheckcount WHERE repcountset_id='$rid'");
                                                    while ($rowmssd = mysqli_fetch_array($sqlmssd)) {
                                                        $repcountEx1 = $repcountEx1 + $rowmssd['count'];
                                                    }
                                                    $iii = $iii + 1;
                                                }
                                                if ($iii > 1) {
                                                    $repcountEx1 = abs(($repcountEx1 * 100) / (($iii - 1) * 10));
                                                    $angEx1 = $angEx1 / ($iii - 1);
                                                } else {
                                                    $repcountEx1 = abs(($repcountEx1 * 100) / (10));
                                                    $angEx1 = $angEx1;
                                                }
                                                if($angEx1>180){
                                                    $angEx1=round(($angEx1-($angEx1*0.70)),2);
                                                }else if($angEx1>90){
                                                    $angEx1=round(($angEx1-($angEx1*0.50)),2);
                                                }
                                                $duratEx1=abs($duratEx1);
                                                ?>
                                                <div class="bg-light rounded h-100 p-2 ">
                                                    <p class="p-2 mb-2 bg-primary text-white">Duration</p>
                                                    <p class="p-2 mb-2 bg-primary text-white">Reps</p>
                                                    <p class="p-2 mb-2 bg-primary text-white">Avg Angle</p>
                                                </div>
                                            </div>
                                            <div class="column w-50 ">
                                                <div class="bg-light rounded h-100 p-2 ">
                                                    <p class="p-2 mb-2 bg-primary text-white text-center"><?php echo intdiv($duratEx1, 60) . ":" . ($duratEx1 % 60); ?></p>
                                                    <div class="pg-bar mb-3 p-2">
                                                        <div class="progress">
                                                            <div class="progress-bar progress-bar-striped" role="progressbar" aria-valuenow="<?php echo $repcountEx1; ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                    </div>
                                                    <p class="p-2 mb-2 bg-primary text-white text-center"><?php echo $angEx1; ?> deg</p>
                                                </div>
                                            </div>    
                                        </div>
                                        <div class="row g-4 justify-content-between p-2">
                                            <h6 class="mb-0">Passive Flexion</h6>
                                            <div class="column float-left w-50">
                                                <?php
                                                $countdayyss = $_SESSION['selectedDay'];
                                                $excerid = 2;
                                                $repcountEx2 = 0;
                                                $angEx2 = 0;
                                                $duratEx2 = 0;
                                                $iii = 1;
                                                $angleecalin2 = 0;
                                                $sqlmss = mysqli_query($con, "SELECT * FROM repcountset WHERE excersie_id='$excerid' and daynumber='$countdayyss'");
                                                while ($rowmss = mysqli_fetch_array($sqlmss)) {
                                                    $rid = $rowmss['id'];
                                                    $sqlmsst = mysqli_query($con, "SELECT * FROM calibrationangle WHERE repcountset_id='$rid' order by id desc limit ");
                                                    $rowmsst = mysqli_fetch_array($sqlmsst);
                                                    if ($rowmsst > 0) {
                                                        $angleecalin2 = $rowmsst['angle1'];
                                                    }
                                                    $endtimee = $rowmss['endtime'];
                                                    $starttimee = $rowmss['starttime'];
                                                    $sqlmsstm = mysqli_query($con, "SELECT max(abs(angle1- '$angleecalin2')) as maxid FROM currentangle WHERE datetime>='$starttimee' and datetime<='$endtimee'");
                                                    $rowmsstm = mysqli_fetch_array($sqlmsstm);
                                                    if ($rowmsstm > 0) {
                                                        $angEx2 = $angEx2 + round($rowmsstm['maxid'],2);
                                                    }
                                                    if ($rowmss['endtime'] != null) {
                                                        $duratEx2 = $duratEx2 + ((strtotime($rowmss['endtime']) - strtotime($rowmss['starttime'])));
                                                    }
                                                    $sqlmssd = mysqli_query($con, "SELECT * FROM repcheckcount WHERE repcountset_id='$rid'");
                                                    while ($rowmssd = mysqli_fetch_array($sqlmssd)) {
                                                        $repcountEx2 = $repcountEx2 + $rowmssd['count'];
                                                    }
                                                    $iii = $iii + 1;
                                                }
                                                if ($iii > 1) {
                                                    $repcountEx2 = abs(($repcountEx2 * 100) / (($iii - 1) * 10));
                                                    $angEx2 = $angEx2 / ($iii - 1);
                                                } else {
                                                    $repcountEx2 = abs(($repcountEx2 * 100) / (10));
                                                    $angEx2 = $angEx2;
                                                }
                                                if($angEx2>180){
                                                    $angEx2=round(($angEx2-($angEx2*0.70)),2);
                                                }else if($angEx2>90){
                                                    $angEx2=round(($angEx2-($angEx2*0.50)),2);
                                                }
                                                $duratEx2=abs($duratEx2);
                                                ?>
                                                <div class="bg-light rounded h-100 p-2 ">
                                                    <p class="p-2 mb-2 bg-primary text-white">Duration</p>
                                                    <p class="p-2 mb-2 bg-primary text-white">Reps</p>
                                                    <p class="p-2 mb-2 bg-primary text-white">Avg Angle</p>
                                                </div>
                                            </div>
                                            <div class="column w-50 ">
                                                <div class="bg-light rounded h-100 p-2 ">
                                                    <p class="p-2 mb-2 bg-primary text-white text-center"><?php echo intdiv($duratEx2, 60) . ":" . ($duratEx2 % 60); ?></p>
                                                    <div class="pg-bar mb-3 p-2">
                                                        <div class="progress">
                                                            <div class="progress-bar progress-bar-striped" role="progressbar" aria-valuenow="<?php echo $repcountEx2; ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                    </div>
                                                    <p class="p-2 mb-2 bg-primary text-white text-center"><?php echo $angEx2; ?> deg</p>
                                                </div>
                                            </div>    
                                        </div>
                                        <div class="row g-4 justify-content-between p-2">
                                            <h6 class="mb-0">SLR</h6>
                                            <div class="column float-left w-50">
                                                <div class="bg-light rounded h-100 p-2 ">
                                                    <p class="p-2 mb-2 bg-primary text-white">Duration</p>
                                                    <p class="p-2 mb-2 bg-primary text-white">Reps</p>
                                                    <p class="p-2 mb-2 bg-primary text-white">Avg Angle</p>
                                                </div>
                                            </div>
                                            <div class="column w-50 ">
                                                <?php
                                                $countdayyss = $_SESSION['selectedDay'];
                                                $excerid = 3;
                                                $repcountEx3 = 0;
                                                $angEx3 = 0;
                                                $duratEx3 = 0;
                                                $iii = 1;
                                                $angleecalin3 = 0;
                                                $sqlmss = mysqli_query($con, "SELECT * FROM repcountset WHERE excersie_id='$excerid' and daynumber='$countdayyss'");
                                                while ($rowmss = mysqli_fetch_array($sqlmss)) {
                                                    $rid = $rowmss['id'];
                                                    $sqlmsst = mysqli_query($con, "SELECT * FROM calibrationangle WHERE repcountset_id='$rid' order by id desc limit ");
                                                    $rowmsst = mysqli_fetch_array($sqlmsst);
                                                    if ($rowmsst > 0) {
                                                        $angleecalin3 = $rowmsst['angle2'];
                                                    }
                                                    $endtimee = $rowmss['endtime'];
                                                    $starttimee = $rowmss['starttime'];
                                                    $sqlmsstm = mysqli_query($con, "SELECT max(abs(angle2- '$angleecalin3')) as maxid FROM currentangle WHERE datetime>='$starttimee' and datetime<='$endtimee'");
                                                    $rowmsstm = mysqli_fetch_array($sqlmsstm);
                                                    if ($rowmsstm > 0) {
                                                        $angEx3 = $angEx3 + round($rowmsstm['maxid'],2);
                                                    }
                                                    if ($rowmss['endtime'] != null) {
                                                        $duratEx3 = $duratEx3 + ((strtotime($rowmss['endtime']) - strtotime($rowmss['starttime'])));
                                                    }
                                                    $sqlmssd = mysqli_query($con, "SELECT * FROM repcheckcount WHERE repcountset_id='$rid'");
                                                    while ($rowmssd = mysqli_fetch_array($sqlmssd)) {
                                                        $repcountEx3 = $repcountEx3 + $rowmssd['count'];
                                                    }
                                                    $iii = $iii + 1;
                                                }
                                                if ($iii > 1) {
                                                    $repcountEx3 = abs(($repcountEx3 * 100) / (($iii - 1) * 10));
                                                    $angEx3 = $angEx3 / ($iii - 1);
                                                } else {
                                                    $repcountEx3 = abs(($repcountEx3 * 100) / (10));
                                                    $angEx3 = $angEx3;
                                                }
                                                if($angEx3>180){
                                                    $angEx3=round(($angEx3-($angEx3*0.70)),2);
                                                }else if($angEx3>90){
                                                    $angEx3=round(($angEx3-($angEx3*0.50)),2);
                                                }
                                                $duratEx3=abs($duratEx3);
                                                ?>
                                                <div class="bg-light rounded h-100 p-2 ">
                                                    <p class="p-2 mb-2 bg-primary text-white text-center"><?php echo intdiv($duratEx3, 60) . ":" . ($duratEx3 % 60); ?></p>
                                                    <div class="pg-bar mb-3 p-2">
                                                        <div class="progress">
                                                            <div class="progress-bar progress-bar-striped" role="progressbar" aria-valuenow="<?php echo $repcountEx3; ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                    </div>
                                                    <p class="p-2 mb-2 bg-primary text-white text-center"><?php echo $angEx3; ?> deg</p>
                                                </div>
                                            </div>    
                                        </div>
                                        <div class="row g-4 justify-content-between p-2">
                                            <h6 class="mb-0">Heel slides</h6>
                                            <div class="column float-left w-50">
                                                <div class="bg-light rounded h-100 p-2 ">
                                                    <p class="p-2 mb-2 bg-primary text-white">Duration</p>
                                                    <p class="p-2 mb-2 bg-primary text-white">Reps</p>
                                                    <p class="p-2 mb-2 bg-primary text-white">Avg Angle</p>
                                                </div>
                                            </div>
                                            <div class="column w-50 ">
                                                <?php
                                                $countdayyss = $_SESSION['selectedDay'];
                                                $excerid = 4;
                                                $repcountEx4 = 0;
                                                $angEx4 = 0;
                                                $duratEx4 = 0;
                                                $iii = 1;
                                                $angleecalin4 = 0;
                                                $sqlmss = mysqli_query($con, "SELECT * FROM repcountset WHERE excersie_id='$excerid' and daynumber='$countdayyss'");
                                                while ($rowmss = mysqli_fetch_array($sqlmss)) {
                                                    $rid = $rowmss['id'];
                                                    $sqlmsst = mysqli_query($con, "SELECT * FROM calibrationangle WHERE repcountset_id='$rid' order by id desc limit ");
                                                    $rowmsst = mysqli_fetch_array($sqlmsst);
                                                    if ($rowmsst > 0) {
                                                        $angleecalin4 = $rowmsst['angle1'];
                                                    }
                                                    $endtimee = $rowmss['endtime'];
                                                    $starttimee = $rowmss['starttime'];
                                                    $sqlmsstm = mysqli_query($con, "SELECT max(abs(angle1- '$angleecalin4')) as maxid FROM currentangle WHERE datetime>='$starttimee' and datetime<='$endtimee'");
                                                    $rowmsstm = mysqli_fetch_array($sqlmsstm);
                                                    if ($rowmsstm > 0) {
                                                        $angEx4 = $angEx4 + round($rowmsstm['maxid'],2);
                                                    }
                                                    if ($rowmss['endtime'] != null) {
                                                        $duratEx4 = $duratEx4 + ((strtotime($rowmss['endtime']) - strtotime($rowmss['starttime'])));
                                                    }
                                                    $sqlmssd = mysqli_query($con, "SELECT * FROM repcheckcount WHERE repcountset_id='$rid'");
                                                    while ($rowmssd = mysqli_fetch_array($sqlmssd)) {
                                                        $repcountEx4 = $repcountEx4 + $rowmssd['count'];
                                                    }
                                                    $iii = $iii + 1;
                                                }
                                                if ($iii > 1) {
                                                    $repcountEx4 = abs(($repcountEx4 * 100) / (($iii - 1) * 10));
                                                    $angEx4 = $angEx4 / ($iii - 1);
                                                } else {
                                                    $repcountEx4 = abs(($repcountEx4 * 100) / (10));
                                                    $angEx4 = $angEx4;
                                                }
                                                if($angEx4>180){
                                                    $angEx4=round(($angEx4-($angEx4*0.70)),2);
                                                }else if($angEx4>90){
                                                    $angEx4=round(($angEx1-($angEx4*0.50)),2);
                                                }
                                                $duratEx4=abs($duratEx4);
                                                ?>
                                                <div class="bg-light rounded h-100 p-2 ">
                                                    <p class="p-2 mb-2 bg-primary text-white text-center"><?php echo intdiv($duratEx4, 60) . ":" . ($duratEx4 % 60); ?></p>
                                                    <div class="pg-bar mb-3 p-2">
                                                        <div class="progress">
                                                            <div class="progress-bar progress-bar-striped" role="progressbar" aria-valuenow="<?php echo $repcountEx4; ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                    </div>
                                                    <p class="p-2 mb-2 bg-primary text-white text-center"><?php echo $angEx4; ?> deg</p>
                                                </div>
                                            </div>    
                                        </div>                                    
                                    </div>
                                    <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                                        <div class="col-sm-12 col-xl-6">
                                            <h6 class="mb-2">Active-assisted Extension</h6>
                                            <canvas id="myChart1" width="800" height="400"></canvas>
                                        </div>
                                        <div class="col-sm-12 col-xl-6">
                                            <h6 class="mb-2">Passive Flexion</h6>
                                            <canvas id="myChart2" width="800" height="400"></canvas>
                                        </div>
                                        <div class="col-sm-12 col-xl-6">
                                            <h6 class="mb-2">SLR</h6>
                                            <canvas id="myChart3" width="800" height="400"></canvas>
                                        </div>
                                        <div class="col-sm-12 col-xl-6">
                                            <h6 class="mb-2">Heel slides</h6>
                                            <canvas id="myChart4" width="800" height="400"></canvas>
                                        </div>
                                    </div>
                                </div>
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

            <script>
                // Fetch data from the PHP backend
                fetch('get_chart_data1.php')
                        .then(response => response.json())
                        .then(data => {
                            // Create the multiline chart with the fetched data
                            const ctx = document.getElementById('myChart1').getContext('2d');
                            const myChart = new Chart(ctx, {
                                type: 'line',
                                data: {
                                    labels: data.labels,
                                    datasets: data.datasets
                                },
                                options: {
                                    responsive: true,
                                    plugins: {
                                        legend: {
                                            display: true,
                                            position: 'top'
                                        },
                                        tooltip: {
                                            mode: 'index',
                                            intersect: false,
                                        }
                                    },
                                    scales: {
                                        x: {
                                            display: true,
                                            title: {
                                                display: true,
                                                text: 'Day'
                                            }
                                        },
                                        y: {
                                            display: true,
                                            title: {
                                                display: true,
                                                text: 'Values'
                                            },
                                            beginAtZero: true, // This makes the y-axis start at 0
                                            min: 0
                                        }
                                    }
                                }
                            });
                        });
                fetch('get_chart_data2.php')
                        .then(response => response.json())
                        .then(data => {
                            // Create the multiline chart with the fetched data
                            const ctx = document.getElementById('myChart2').getContext('2d');
                            const myChart = new Chart(ctx, {
                                type: 'line',
                                data: {
                                    labels: data.labels,
                                    datasets: data.datasets
                                },
                                options: {
                                    responsive: true,
                                    plugins: {
                                        legend: {
                                            display: true,
                                            position: 'top'
                                        },
                                        tooltip: {
                                            mode: 'index',
                                            intersect: false,
                                        }
                                    },
                                    scales: {
                                        x: {
                                            display: true,
                                            title: {
                                                display: true,
                                                text: 'Day'
                                            }
                                        },
                                        y: {
                                            display: true,
                                            title: {
                                                display: true,
                                                text: 'Values'
                                            },
                                            beginAtZero: true, // This makes the y-axis start at 0
                                            min: 0
                                        }
                                    }
                                }
                            });
                        });
                fetch('get_chart_data3.php')
                        .then(response => response.json())
                        .then(data => {
                            // Create the multiline chart with the fetched data
                            const ctx = document.getElementById('myChart3').getContext('2d');
                            const myChart = new Chart(ctx, {
                                type: 'line',
                                data: {
                                    labels: data.labels,
                                    datasets: data.datasets
                                },
                                options: {
                                    responsive: true,
                                    plugins: {
                                        legend: {
                                            display: true,
                                            position: 'top'
                                        },
                                        tooltip: {
                                            mode: 'index',
                                            intersect: false,
                                        }
                                    },
                                    scales: {
                                        x: {
                                            display: true,
                                            title: {
                                                display: true,
                                                text: 'Day'
                                            }
                                        },
                                        y: {
                                            display: true,
                                            title: {
                                                display: true,
                                                text: 'Values'
                                            },
                                            beginAtZero: true, // This makes the y-axis start at 0
                                            min: 0
                                        }
                                    }
                                }
                            });
                        });
                fetch('get_chart_data4.php')
                        .then(response => response.json())
                        .then(data => {
                            // Create the multiline chart with the fetched data
                            const ctx = document.getElementById('myChart4').getContext('2d');
                            const myChart = new Chart(ctx, {
                                type: 'line',
                                data: {
                                    labels: data.labels,
                                    datasets: data.datasets
                                },
                                options: {
                                    responsive: true,
                                    plugins: {
                                        legend: {
                                            display: true,
                                            position: 'top'
                                        },
                                        tooltip: {
                                            mode: 'index',
                                            intersect: false,
                                        }
                                    },
                                    scales: {
                                        x: {
                                            display: true,
                                            title: {
                                                display: true,
                                                text: 'Day'
                                            }
                                        },
                                        y: {
                                            display: true,
                                            title: {
                                                display: true,
                                                text: 'Values'
                                            },
                                            beginAtZero: true, // This makes the y-axis start at 0
                                            min: 0
                                        }
                                    }
                                }
                            });
                        });
            </script>

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
                        '1': 'sessionSummry.php?dy=1',
                        '2': 'sessionSummry.php?dy=2',
                        '3': 'sessionSummry.php?dy=3',
                        '4': 'sessionSummry.php?dy=4',
                        '5': 'sessionSummry.php?dy=5',
                        '6': 'sessionSummry.php?dy=6',
                        '7': 'sessionSummry.php?dy=7'
                    };
                    // Redirect to the URL bas
                    if (urls[selectedValue]) {
                        window.location.href = urls[selectedValue];
                    }
                });

            </script>
    </body>

</html>