<?php

        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Allow-Methods: POST");
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    class ApiReservationController {

        public function readReservation() {
            header("Access-Control-Allow-Origin: *");
            header("Content-Type: application/json; charset=UTF-8");
            header("Access-Control-Allow-Methods: POST");
            header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
        
            $database = new Database();
            $db = $database->getConnection();
            
            $reservation = new reservation($db);
            
            $data = json_decode(file_get_contents("php://input"));

            
                    
            $stm = $reservation->getAllReservation();
            $countReservation = $stm->rowCount();

            if($countReservation > 0) {
                $reservArr = array();
                $reservArr["body"] = array();
                $reservArr["countClients"] = $countReservation;

                while ($row = $stm->fetch(PDO::FETCH_ASSOC)){
                    extract($row);
                    $e = array(
                        "Reservation_id" => $Reservation_id,
                        "user_id" => $user_id,
                        "creneau_id" => $creneau_id,
                        "date" => $date,
                        "subject" => $subject,
                    );
                        array_push($reservArr["body"], $e);
                    }
                    echo json_encode($reservArr);
                    } else {
                        http_response_code(404);
                        echo json_encode(
                            array("message" => "No record found.")
                        );
            }
        }

        public function createReservation() {  
            
            $database = new Database();
            $db = $database->getConnection();
            
            $reservation = new reservation($db);
            
            $data = json_decode(file_get_contents("php://input"));

            
            $reservation->user_id = $data->user_id;
            $reservation->creneau_id = $data->creneau_id;
            $reservation->date = $data->date;
            $reservation->Subject = $data->Subject;

            if($reservation->createReservation()){
                echo 'Reservation Was Created successfully.';
            } else{
                echo 'Reservation could not be created.';
            }
        }

        public function reservationToken() { 

            header("Access-Control-Allow-Origin: *");
            header("Content-Type: application/json; charset=UTF-8");
            header("Access-Control-Allow-Methods: POST");
            header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
        
            $database = new Database();
            $db = $database->getConnection();
            
            $reservation = new reservation($db);
            
            $data = json_decode(file_get_contents("php://input"));

            
            $reservation->Reference = $data->Reference;
            
            if ($reservation->Reference->existToken()) {
                if($reservation->reservationToken()){
                    echo 'Reservation Was Created successfully.';
                } else{
                    echo 'Reservation could not be created.';
                }
            }
        }
        
        public function deleteUser() {
            header("Access-Control-Allow-Origin: *");
            header("Content-Type: application/json; charset=UTF-8");
            header("Access-Control-Allow-Methods: POST");
            header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
        
            $database = new Database();
            $db = $database->getConnection();
            
            $client = new reservation($db);
            
            $data = json_decode(file_get_contents("php://input"));

            $client->user_id = $data->user_id;
            if($client->deleteUser()){
                echo json_encode("Reservation deleted.");
            } else{
                echo json_encode("Data could not be deleted");
            }
        }

}


?>