<?php
include "../inc/connection.php";
include  '../vendor/autoload.php';

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

$header = apache_request_headers();
if (isset($header['Authorization'])) {
    $header = $header['Authorization'];
    $key = '20fh34ifwepf0';

    $decoded = JWT::decode($header, new Key($key, 'HS256'));

    $doctor_id = $decoded->doctor_id;
$query = $mysqli->prepare(
    "SELECT CONCAT(p.first_name,' ',p.last_name) AS patient_name, details,date_issued,pe.is_approved,p.email,p.phone_number
    FROM perscription AS pe
     JOIN doctors AS d ON pe.doctor_id=d.doctor_id
     JOIN patients AS p ON pe.patient_id=p.patient_id
    
     
     WHERE d.doctor_id=?
     "
);


// $query = $mysqli->prepare(
//     "SELECT CONCAT(p.first_name,' ',p.last_name) AS patient_name, details,date_issued,pe.is_approved,room_number
//     FROM perscription AS pe
//      JOIN doctors AS d ON pe.doctor_id=d.doctor_id
//      JOIN patients AS p ON pe.patient_id=p.patient_id
//      JOIN rooms AS r ON p.room_id=r.room_id
     
//      WHERE d.doctor_id=?
//      "
// );
$query->bind_param('i', $doctor_id);


$query->execute();
// $query->store_result();
// $query->bind_result($doctor_id);
// $query->fetch();

$array = $query->get_result();
$response = [];
while ($medications = $array->fetch_assoc()) {
    $response[] = $medications;
}
}
else{
    $response["error"]="Not Authorized";

}

echo json_encode(($response));
