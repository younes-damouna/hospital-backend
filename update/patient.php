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

if(isset($_POST['room_id'])){
    $room_id = $_POST['room_id'];
    $patient_id = $_POST['patient_id'];

    $query = $mysqli->prepare('UPDATE  patients SET
    `room_id`=?
  WHERE patient_id=?');
$query->bind_param('ii',$room_id,$patient_id );
$query->execute();


$response = [];
$response["status"] = "Success";
}else{
$patient_id = $_POST['patient_id'];
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$email = $_POST['email'];
$phone_number = $_POST['phone_number'];


$query = $mysqli->prepare('UPDATE  patients SET
    `first_name`=?,`last_name`=?,`email`=?,`phone_number`=?
  WHERE patient_id=?');
$query->bind_param('sssii',$first_name,$last_name,$email,$phone_number, $patient_id );
$query->execute();


$response = [];
$response["status"] = "Success";
}
}else{
    $response["error"]="Not Authorized";

}
echo json_encode($response);

?>