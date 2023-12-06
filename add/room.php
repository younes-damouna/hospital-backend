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

//     $patient_id = $decoded->patient_id;

// $doctor_id = $_POST['doctor_id'];
// // $patient_id = $_POST['patient_id'];
// $id = $_POST['id'];
// $date_time=$_POST['date_time'];
$room_number = $_POST['room_number'];
$floor_number = $_POST['floor_number'];
$beds_number = $_POST['beds_number'];


$query = $mysqli->prepare('INSERT INTO rooms( room_number,floor_number,beds_number) 
values(?,?,?)');
$query->bind_param('iii', $room_number, $floor_number, $beds_number );
$query->execute();


$response = [];
$response["status"] = "Success";
}else{
    $response["error"]="Not Authorized";

}
echo json_encode($response);

?>