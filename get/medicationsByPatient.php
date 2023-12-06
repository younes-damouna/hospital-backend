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

    $patient_id = $decoded->patient_id;

    $query = $mysqli->prepare(
        "SELECT CONCAT(d.first_name,' ',d.last_name) AS doctor_name, details,date_issued,pe.is_approved 
    FROM perscription AS pe
     JOIN doctors AS d ON pe.doctor_id=d.doctor_id
     JOIN patients AS p ON pe.patient_id=p.patient_id
     
     WHERE p.patient_id=?
     "
    );
    $query->bind_param('i', $patient_id);


    $query->execute();
    // $query->store_result();
    // $query->bind_result($patient_id);
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
