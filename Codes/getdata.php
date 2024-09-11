<?php

include('dbconnection.php');
$data1 = $_GET['angle1'];
$data2 = $_GET['angle2'];
$datetimess = date('Y-m-d H:i:s');
$exercisiddd=1;
$sqlm = mysqli_query($con, "SELECT * FROM currentexercise WHERE user_id='1' and status='1' limit 1");
$rowm = mysqli_fetch_array($sqlm);
if ($rowm > 0) {
    $exercisiddd=$rowm['excersie_id'];
}
$query = mysqli_query($con, "INSERT INTO currentangle(angle1,angle2,status,user_id,excersie_id,datetime) VALUES ('$data1','$data2',1,1,'$exercisiddd','$datetimess')");
