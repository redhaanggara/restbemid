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

$tmpFilePathP = $_FILES['file']['tmp_name'];
$nameFilePathP = $_FILES['file']['name'];
$filePathP = "image_timeline/" .$nameFilePathP;
$codex = "";
 

if(move_uploaded_file($tmpFilePathP, $filePathP)) {

     $codex = "true";
     echo json_encode($codex);
    
}

 else{
     
     $codex = "false";
     echo json_encode($codex);
     
}


?>
