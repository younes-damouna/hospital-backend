<?php

include("../inc/connection.php");
include  '../vendor/autoload.php';

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

$header = apache_request_headers();
if (isset($header['Authorization'])) {
    $header = $header['Authorization'];
    $key = '20fh34ifwepf0';

    $decoded = JWT::decode($header, new Key($key, 'HS256'));

    $patient_id = $decoded->patient_id;

$doctor_id = $_POST['doctor_id'];
// $patient_id = $_POST['patient_id'];
$id = $_POST['id'];
$date_time=$_POST['date_time'];

$drop_time=$mysqli->prepare("DELETE FROM doctor_availability
WHERE id=?
");
$drop_time->bind_param('i', $id );
$drop_time->execute();


$query = $mysqli->prepare('INSERT INTO appointments( doctor_id,patient_id,date_time) 
values(?,?,?)');
$query->bind_param('iis', $doctor_id, $patient_id, $date_time );
$query->execute();


$response = [];
$response["status"] = "Success";
}else{
    $response["error"]="Not Authorized";

}
echo json_encode($response);

?>