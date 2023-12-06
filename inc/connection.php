<?php
header("Access-Control-Allow-Origin:*");
header("Access-Control-Allow-Headers:*");
// require_once('vendor/autoload.php');

// require __DIR__ . '/vendor/autoload.php';
// use \Firebase\JWT\JWT; 
// $key = '20fh34ifwepf0';

$host ="localhost";
$db_user_name="root";
$db_password="";
$db_name="hospital";
$mysqli= new mysqli($host,$db_user_name,$db_password,$db_name);
if($mysqli->connect_error){
    die("".$mysqli->connect_error);
}
else{
    // echo "connected";
}


?>