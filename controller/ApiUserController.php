<?php

    class ApiUserController {

        public function updateClient() {
            header("Access-Control-Allow-Origin: *");
            header("Content-Type: application/json; charset=UTF-8");
            header("Access-Control-Allow-Methods: POST");
            header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

            $database = new Database();
            $db = $database->getConnection();
            
            $client = new client($db);
            
            $data = json_decode(file_get_contents("php://input"));
            $client->user_id = $data->user_id;
            $client->Fname = $data->Fname;
            $client->Lname = $data->Lname;
            $client->Email = $data->Email;

            if($client->updateClient()){
                echo json_encode("Client data updated.");
            } else{
                echo json_encode("Data could not be updated");
            }
        }

        public function readUser() {
            header("Access-Control-Allow-Origin: *");
            header("Content-Type: application/json; charset=UTF-8");
            header("Access-Control-Allow-Methods: POST");
            header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
        
            $database = new Database();
            $db = $database->getConnection();
            
            $client = new client($db);
            
            $data = json_decode(file_get_contents("php://input"));

            echo "read user";
            
                    
            $stm = $client->getAllUSers();
            $countClients = $stm->rowCount();

            if($countClients > 0) {
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
        }

        public function createUser() {  
            header("Access-Control-Allow-Origin: *");
            header("Content-Type: application/json; charset=UTF-8");
            header("Access-Control-Allow-Methods: POST");
            header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
        
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
        }

        public function deleteUser() {
            header("Access-Control-Allow-Origin: *");
            header("Content-Type: application/json; charset=UTF-8");
            header("Access-Control-Allow-Methods: POST");
            header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
        
            $database = new Database();
            $db = $database->getConnection();
            
            $client = new client($db);
            
            $data = json_decode(file_get_contents("php://input"));

            $client->user_id = $data->user_id;
            if($client->deleteUser()){
                echo json_encode("Client deleted.");
            } else{
                echo json_encode("Data could not be deleted");
            }
        }

}


?>