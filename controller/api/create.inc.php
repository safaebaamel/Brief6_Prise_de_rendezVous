<?php

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, X-Requested-With");

include_once '../config/database.php';
include_once '../../Model/client.inc.php';

$database = new Database();
$db = $database->getConnection();

$client = new client($db);


$data = json_decode(file_get_contents("php://input"));

$client->Fname = $data->Fname;
$client->Lname = $data->Lname;
$client->Email = $data->Email;

if($client->createUser()){
    echo 'Client created successfully.';
} else{
    echo 'Client could not be created.';
}

?>