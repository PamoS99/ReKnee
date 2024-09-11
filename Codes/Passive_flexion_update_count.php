<?php

session_start();
error_reporting(0);
include('dbconnection.php');
$countt=0;
$sqlmssl = mysqli_query($con, "SELECT * FROM repcheckcount WHERE user_id='1' and excersie_id='2' and status='1'  order by id desc limit 1");
$rowmssl = mysqli_fetch_array($sqlmssl);
if ($rowmssl > 0) {
    $checkcountid = $rowmssl['id'];
    $countt = $rowmssl['count'];
    
}

//    header('location:Active_assisted_extension_dashboard.php');
// update.php
// Example to generate a random number for demonstration purposes
echo $countt;
?>