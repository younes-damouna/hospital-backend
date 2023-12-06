<?php
include "../inc/connection.php";

$query=$mysqli->prepare(
    "SELECT * FROM rooms"
);

$query->execute();
$array=$query->get_result();
$response=[];
while($Rooms=$array->fetch_assoc()){
$response[]=$Rooms;
}

echo json_encode(($response));

?>