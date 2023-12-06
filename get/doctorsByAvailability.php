<?php
include "../inc/connection.php";

// $doctor_id = $_POST['doctor_id'];
$query = $mysqli->prepare(
    "SELECT CONCAT(d.first_name,' ',d.last_name) AS doctor_name,
     date_time,da.id,d.doctor_id,id
     FROM doctor_availability AS da
     JOIN doctors AS d ON da.doctor_id=d.doctor_id
     

     "
);
//      WHERE d.doctor_id=?

// see if doctor is active
// $query->bind_param('i', $doctor_id);


$query->execute();
// $query->store_result();
// $query->bind_result($patient_id);
// $query->fetch();

$array = $query->get_result();
$response = [];
while ($AvaiableTimes = $array->fetch_assoc()) {
    $response[] = $AvaiableTimes;
}

echo json_encode(($response));
