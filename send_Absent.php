<?php

if (isset($_SERVER['HTTP_ORIGIN'])) {
    header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
    header('Access-Control-Allow-Credentials: true');
    header('Access-Control-Max-Age: 86400');    // cache for 1 day
}

// Access-Control headers are received during OPTIONS requests
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {

    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS");

    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
        header("Access-Control-Allow-Headers:        {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");

    exit(0);
}

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include 'koneksi.php';
include 'date.php';

$postData = file_get_contents('php://input');

$idt = $_POST['idt'];
$type = $_POST['type']; 
$nibin = $_POST['nibin'];

$result = mysqli_query($koneksi, "SELECT * FROM checkin WHERE idt = '$idt' AND nibin = '$nibin' ") or die (mysqli_error());
$num_rows = mysqli_num_rows($result);

if($num_rows <= 0){
    
    $result = mysqli_query($koneksi, "INSERT INTO checkin (idt,type,nibin,waktu) VALUES('$idt','$type','$nibin','$localDate') ") or die (mysqli_error());
    
    $codex = "true";
 	echo json_encode($codex);
    
}
else{
    
    $codex = "false";
 	echo json_encode($codex);

}


?>
