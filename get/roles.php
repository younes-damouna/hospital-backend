<?php
include "../inc/connection.php";

$query=$mysqli->prepare(
    "SELECT * FROM roles"
);

$query->execute();
$array=$query->get_result();
$response=[];
while($Roles=$array->fetch_assoc()){
$response[]=$Roles;
}

echo json_encode(($response));

?>