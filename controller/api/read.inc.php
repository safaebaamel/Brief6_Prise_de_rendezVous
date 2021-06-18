<?php

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, X-Requested-With");

include_once '../config/database.php';
include_once '../../Model/client.inc.php';

$database = new Database();
$db = $database->getConnection();

$client = new client($db);

$stm = $client->getAllUSers();
$countClients = $stm->rowCount();

if($countClients > 0){
    $clientArr = array();
    $clientArr["body"] = array();
    $clientArr["countClients"] = $countClients;

    while ($row = $stm->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $e = array(
            "user_id" => $user_id,
            "Fname" => $Fname,
            "Lname" => $Lname,
            "Email" => $Email,
            "Reference" => $Reference,
        );

        array_push($clientArr["body"], $e);
    }
    echo json_encode($clientArr);
} else {
    http_response_code(404);
    echo json_encode(
        array("message" => "No record found.")
    );
}

?>