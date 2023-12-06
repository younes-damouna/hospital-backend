<?php
include "../inc/connection.php";

$query=$mysqli->prepare(
    "SELECT CONCAT(d.first_name,' ',d.last_name) AS doctor_name,
     CONCAT(p.first_name,' ', p.last_name) AS patient_name ,
     appointment_id, a.doctor_id, a.patient_id, a.date_time, a.status_id, s.status_name
     FROM appointments AS a
     JOIN doctors AS d ON d.doctor_id=a.doctor_id
     JOIN patients AS p ON a.patient_id=p.patient_id
     JOIN status AS s ON s.status_id=a.status_id
    "
);

$query->execute();
$array=$query->get_result();
$response=[];
while($appointments=$array->fetch_assoc()){
$response[]=$appointments;
}

echo json_encode(($response));

?>