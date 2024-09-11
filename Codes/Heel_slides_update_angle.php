<?php

session_start();
error_reporting(0);
include('dbconnection.php');
$calangle1 = 0;
$calangle2 = 0;
$sqlms = mysqli_query($con, "SELECT * FROM calibrationangle WHERE user_id='1' and excersie_id='4' order by id desc limit 1");
$rowms = mysqli_fetch_array($sqlms);
if ($rowms > 0) {
    $calangle1 = $rowms['angle1'];
    $calangle2 = $rowms['angle2'];
}
$sqlm = mysqli_query($con, "SELECT * FROM currentangle WHERE user_id='1' and excersie_id='4' order by id desc limit 1");
$rowm = mysqli_fetch_array($sqlm);
if ($rowm > 0) {
    $angle1 = round((abs($rowm['angle1'] - $calangle1)),2);
    $angle2 = round((abs($rowm['angle2'] - $calangle2)),2);
}
if ($angle1 > 15) {
    $sqlmss = mysqli_query($con, "SELECT * FROM repcheck WHERE user_id='1' and excersie_id='4'");
    $rowmss = mysqli_fetch_array($sqlmss);
    if ($rowmss > 0) {
        $checkid = $rowmss['id'];
        $checkstatus = $rowmss['checkstatus'];
        if ($checkstatus == '0') {
            $sqls = mysqli_query($con, "update repcheck set checkstatus='1' WHERE id='$checkid'");
        }
    } else {
        $sqls = mysqli_query($con, "insert into repcheck (checkstatus,user_id,excersie_id,status) VALUES (1,1,4,1)");
    }
}
if ($angle1 < 5) {
    $sqlmss = mysqli_query($con, "SELECT * FROM repcheck WHERE user_id='1' and excersie_id='4'");
    $rowmss = mysqli_fetch_array($sqlmss);
    if ($rowmss > 0) {
        $checkid = $rowmss['id'];
        $checkstatus = $rowmss['checkstatus'];
        if ($checkstatus == '1') {
            $sqls = mysqli_query($con, "update repcheck set checkstatus='0' WHERE id='$checkid'");
            $sqlmssl = mysqli_query($con, "SELECT * FROM repcheckcount WHERE user_id='1' and excersie_id='4' order by id desc limit 1");
            $rowmssl = mysqli_fetch_array($sqlmssl);
            if ($rowmssl > 0) {
                $checkcountid = $rowmssl['id'];
                $countt=$rowmssl['count']+1;
                $sqls = mysqli_query($con, "update repcheckcount set count='$countt' WHERE id='$checkcountid'");
            }
        }
    } else {
        $sqls = mysqli_query($con, "INSERT INTO repcheck('checkstatus', 'status', 'user_id', 'excersie_id') VALUES ('0','1','1','4')");
    }
}
//    header('location:Active_assisted_extension_dashboard.php');
// update.php
// Example to generate a random number for demonstration purposes
echo $angle1 . " deg";
?>