<?php
include "../inc/connection.php";

$query=$mysqli->prepare(
    "SELECT * FROM specialties"
);

$query->execute();
$array=$query->get_result();
$response=[];
while($specialties=$array->fetch_assoc()){
$response[]=$specialties;
}

echo json_encode(($response));

?>