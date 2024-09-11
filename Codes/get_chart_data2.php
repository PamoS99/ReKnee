<?php

session_start();
error_reporting(0);
include('dbconnection.php');
$countdayyss = 1;
$maxagle = [];
$reparr = [];
while ($countdayyss < 8) {
    $excerid = 2;
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
            $angEx4 = $angEx4 + round($rowmsstm['maxid'], 2);
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
        $repcountEx4 = ($repcountEx4 * 100) / (($iii - 1) * 10);
        $angEx4 = $angEx4 / ($iii - 1);
    } else {
        $repcountEx4 = ($repcountEx4 * 100) / ((1) * 10);
        $angEx4 = $angEx4 / (1);
    }
    if ($angEx4 > 180) {
        $angEx4 = round(($angEx4 - ($angEx4 * 0.70)), 2);
    } else if ($angEx4 > 90) {
        $angEx4 = round(($angEx1 - ($angEx4 * 0.50)), 2);
    }

    array_push($maxagle, $angEx4);
    array_push($reparr, $repcountEx4);
    $countdayyss = $countdayyss + 1;
}
$data = [
    "labels" => ["1", "2", "3", "4", "5", "6", "7"],
    "datasets" => [
            [
            "label" => "Max Angle",
            "data" => $maxagle,
            "borderColor" => "rgba(255, 99, 132, 1)",
            "backgroundColor" => "rgba(255, 99, 132, 0.2)",
            "fill" => false,
            "tension" => 0.1
        ],
            [
            "label" => "Rep %",
            "data" => $reparr,
            "borderColor" => "rgba(54, 162, 235, 1)",
            "backgroundColor" => "rgba(54, 162, 235, 0.2)",
            "fill" => false,
            "tension" => 0.1
        ]
    ]
];

// Set the content type to JSON
header('Content-Type: application/json');

// Encode and output the data as JSON
echo json_encode($data);
?>
