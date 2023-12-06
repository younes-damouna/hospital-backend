<?php
include "../inc/connection.php";

$query=$mysqli->prepare(
    "SELECT first_name,last_name,email,is_approved, specialty_name FROM doctors as d 
     JOIN roles AS r ON r.role_id=d.role_id
     JOIN specialties AS s ON s.specialty_id=d.specialty_id"
);

$query->execute();
$array=$query->get_result();
$response=[];
while($Doctors=$array->fetch_assoc()){
$response[]=$Doctors;
}

echo json_encode(($response));

?>