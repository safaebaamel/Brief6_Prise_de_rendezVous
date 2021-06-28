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
        
        public function deleteReservation() {
            
            $database = new Database();
            $db = $database->getConnection();
            
            $client = new reservation($db);
            
            $data = json_decode(file_get_contents("php://input"));

            $client->user_id = $data->user_id;
            if($client->deleteReservation()){
                echo json_encode("Reservation deleted.");
            } else{
                echo json_encode("Data could not be deleted");
            }
        }

        public function CheckCreneau() {

            $database = new Database();
            $db = $database->getConnection();
            
            $res = new reservation($db);

            $data = json_decode(file_get_contents("php://input"));

            $res->date = $data->date;

            $result = $res->getTimeSlote();

            $num = $result->rowCount();

            if($num > 0) {

                $creneau_slot = array();
    
                while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                    extract($row);
                    
                    $cren = array (
                        'time_slot' => $time_slot,
                        'Creneau_id' => $Creneau_id
                    );

                    array_push($creneau_slot, $cren);
                }
                echo json_encode($creneau_slot);
            } else {
                echo json_decode(array('message' => 'Nothing!'));
            }
        }

        public function updateReservation() {
            $database = new Database();
            $db = $database->getConnection();
        
            $rdv = new reservation($db);
        
        
            $data = json_decode(file_get_contents("php://input"));
            
            $rdv->Reservation_id = $data->Reservation_id;
        
            $rdv->Subject = $data->Subject;
            $rdv->date = $data->date;
            $rdv->Creneau_id = $data->Creneau_id;
        
            if($rdv->UpdateRDV()){
                echo 'RDV update successfully.';
            } else{
                echo 'RDV could not be updated.';
            }
        }

        public function GetFromId() {
            $database = new Database();
            $db = $database->getConnection();


            $rdv = new reservation($db);

            $data = json_decode(file_get_contents("php://input"));
            $rdv->user_id = $data->user_id;

            $result = $rdv->getSingleRDV();
            $num = $result->rowCount();
            if ($num > 0) {
                $rdv_arr = array();
                while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                    extract($row);

                    $rdv_item = array(
                        'Reservation_id' => $Reservation_id,
                        'date' => $date,
                        'creneau_id' => $creneau_id,
                        'Subject' => $Subject
                    );

                    array_push($rdv_arr, $rdv_item);
                }
                echo json_encode($rdv_arr);
            } else {
                echo json_encode(
                    array("no")
                );
            }
            }

}


?>