<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    class ApiUserController {

        public function readUser() {

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

        public function getInfoFromReference() {
            $database = new Database();
            $db = $database->getConnection();
            
            $client = new client($db);
            
            $data = json_decode(file_get_contents("php://input"));

            
            $client->Reference = $data->Reference;
            
            $count = $client->getUserFromReference();

            $user_id = $client->getUserFromReference();
            // die(print_r($user_id));
            // if($user_id != null){
            //     echo $user_id;
            //     $ID = array(
            //         "user_id" => $user_id, 
            //     );
            //     echo json_encode($ID);
            // } else {
            //     echo 'Client could not be found.';
            //     }
            if($client->getUserFromReference()){
                $arr = array('id_user' => 
                    $user_id , 'existe' => true);
                echo json_encode($arr);
            }
            else{
echo "makwalo";
            }
        }
    


        public function createUser() {  
            
            $database = new Database();
            $db = $database->getConnection();
            
            $client = new client($db);
            
            $data = json_decode(file_get_contents("php://input"));

            $client->Fname = $data->Fname;
            $client->Lname = $data->Lname;
            $client->Email = $data->Email;
            $tk = $client->createUser();
           
            if($tk) {
                $Token = array(
                    "Reference" => $tk, 
                );
                echo json_encode($Token);
            } else {
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

        public function updateClient() {
            
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

}


?>