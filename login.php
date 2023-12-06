<?php
include "inc/connection.php";
require_once('vendor/autoload.php');
use \Firebase\JWT\JWT; 
require __DIR__ . '/vendor/autoload.php';




$email = $_POST['email'];
$password = $_POST['password'];
$user_role = $_POST['role_id'];


if ($user_role == 2) {

    $query = $mysqli->prepare('SELECT   `doctor_id`,
    `first_name`,
    `last_name`,
    `email`,
    `password`,
   
    `role_id`
    
     FROM doctors WHERE email=?');
    $query->bind_param('s', $email);
    $query->execute();
    $query->store_result();
    $num_rows = $query->num_rows;
    $query->bind_result($doctor_id, $first_name, $last_name, $email, $hashed_password, $role_id);
    $query->fetch();


    $response = [];
    if ($num_rows == 0) {
        $response['status'] = 'user not found';
        echo json_encode($response);
    } else {
        if (password_verify($password, $hashed_password)) {
            $response['status'] = 'logged in';
            // $response['doctor_id'] = $doctor_id;
            $response['first_name'] = $first_name;
            $response['first_name'] = $last_name;
            $response['role_id'] = $role_id;
            
            $key = '20fh34ifwepf0';
            $payload = [
                'iss' => 'localhost',
                'aud' => 'localhost',
                'doctor_id' => $doctor_id,
                // 'role_id' => $role_id
            ];
            $encode = JWT::encode($payload, $key, 'HS256');
            $response['token'] =$encode;



            echo json_encode($response);
        } else {
            $response['status'] = 'wrong credentials';
            echo json_encode($response);
        }
    };



} else if ($user_role == 3) {





    $query = $mysqli->prepare('SELECT   `patient_id`,
    `first_name`,
    `last_name`,
    `email`,
    `password`,
   
    `role_id`
    
     FROM patients WHERE email=?');
    $query->bind_param('s', $email);
    $query->execute();
    $query->store_result();
    $num_rows = $query->num_rows;
    $query->bind_result($patient_id, $first_name, $last_name, $email, $hashed_password, $role_id);
    $query->fetch();


    $response = [];
    if ($num_rows == 0) {
        $response['status'] = 'user not found';
        echo json_encode($response);
    } else {
        if (password_verify($password, $hashed_password)) {
            $response['status'] = 'logged in';
            // $response['patient_id'] = $patient_id;
            $response['first_name'] = $first_name;
            $response['last_name'] = $last_name;
            $response['role_id'] = $role_id;

            $key = '20fh34ifwepf0';
            $payload = [
                'iss' => 'localhost',
                'aud' => 'localhost',
                'patient_id' => $patient_id,
                // 'role_id' => $role_id
            ];
            $encode = JWT::encode($payload, $key, 'HS256');
            $response['token'] =$encode;


            echo json_encode($response);
        } else {
            $response['status'] = 'wrong credentials';
            echo json_encode($response);
        }
    };
}
