<?php
include("./inc/connection.php");
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$email = $_POST['email'];
$password = $_POST['password'];
$specialty_id = $_POST['specialty_id'];
$role_id = $_POST['role_id'];




$checkEmail = $mysqli->prepare('SELECT email FROM doctors WHERE email=?');
$checkEmail->bind_param('s', $email);
$checkEmail->execute();
$checkEmail->store_result();
$num_rows = $checkEmail->num_rows;
$checkEmail->bind_result($email);
$checkEmail->fetch();


$response = [];
if ($num_rows == 0) {

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $query = $mysqli->prepare('INSERT INTO doctors(first_name,last_name,email,password,specialty_id,role_id) 
    values(?,?,?,?,?,?)');
    $query->bind_param('ssssii', $first_name, $last_name, $email, $hashed_password, $specialty_id, $role_id);
    $query->execute();

    $response = [];
    if (!$query) {
        $response["status"] = "false";
    } else {
        $response["status"] = "true";
        //  echo !$query;
        $response['error_message'] = '';


    }


    // $response['status'] = 'true';
    echo json_encode($response);
} else {

    $response['status'] = 'false';
    $response['error_message'] = 'Email Already Exists';

    echo json_encode($response);
};
