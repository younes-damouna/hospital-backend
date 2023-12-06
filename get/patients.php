<?php
include "../inc/connection.php";

$query=$mysqli->prepare(
    "SELECT * FROM patients"
);

$query->execute();
$array=$query->get_result();
$response=[];
while($patients=$array->fetch_assoc()){
$response[]=$patients;
}

echo json_encode(($response));

?>