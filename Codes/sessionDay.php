<?php
session_start();
$day=$_GET['dy'];
if (isset($day)) {
    $_SESSION['selectedDay'] = $day;
}
header('location:Week01.php');
?>

