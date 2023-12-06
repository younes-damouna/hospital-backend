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

    $doctor_id = $decoded->doctor_id;

$date_time=$_POST['date_time'];



$query = $mysqli->prepare('INSERT INTO doctor_availability ( doctor_id,date_time) 
values(?,?)');
$query->bind_param('is', $doctor_id, $date_time );
$query->execute();


$response = [];
$response["status"] = "Success";
}else{
    $response["error"]="Not Authorized";

}
echo json_encode($response);

?>