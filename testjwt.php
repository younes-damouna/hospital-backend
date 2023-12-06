<?php 
require __DIR__ . '/vendor/autoload.php';

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

$key = '20fh34ifwepf0';
$payload = [
    'iss' => 'localhost',
    'aud' => 'localhost',
    'user_id' => 1,
    'email' => "youda@gmail.com"
];


$encode = JWT::encode($payload, $key, 'HS256');
echo $encode;

$header=apache_request_headers();
if($header=$header['Authorization'])
$decoded = JWT::decode($encode, new Key($key, 'HS256'));
print('<br>'.$decoded->user_id);
