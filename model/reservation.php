<?php

    class reservation {

        // Connection
        private $conn;

        // Table
        private $db_table = "reservaation";

        // Columns
        public $user_id;
        public $Reservation_id;
        public $creneau_id;
        public $date;
        public $subject;

        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }

        // GET ALL
        public function getAllReservation(){
            $sqlQuery = "SELECT Reservation_id ,user_id, creneau_id, date, subject  FROM " . $this->db_table . "";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }
       
        // New Reservation
        public function createReservation(){

            $sqlQuery = "INSERT reservaation SET  user_id=:user_id, creneau_id=:creneau_id, date=:date, subject=:subject"; 

            $stmt = $this->conn->prepare($sqlQuery);
        
            // // sanitize

            $this->user_id=htmlspecialchars(strip_tags($this->user_id));
            $this->creneau_id=htmlspecialchars(strip_tags($this->creneau_id));
            $this->date=htmlspecialchars(strip_tags($this->date));
            $this->subject=htmlspecialchars(strip_tags($this->subject));
           
        
            // bind data
            $stmt->bindParam(":creneau_id", $this->creneau_id);
            $stmt->bindParam(":user_id", $this->user_id);
            $stmt->bindParam(":date", $this->date);
            $stmt->bindParam(":subject", $this->subject);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }


        public function reservationToken(){

            $sqlQuery = "INSERT reservaation SET  user_id=:user_id, creneau_id=:creneau_id, date=:date, subject=:subject"; 

            $stmt = $this->conn->prepare($sqlQuery);
        
            // // sanitize

            $this->user_id=htmlspecialchars(strip_tags($this->user_id));
            $this->creneau_id=htmlspecialchars(strip_tags($this->creneau_id));
            $this->date=htmlspecialchars(strip_tags($this->date));
            $this->subject=htmlspecialchars(strip_tags($this->subject));
           
        
            // bind data
            $stmt->bindParam(":creneau_id", $this->creneau_id);
            $stmt->bindParam(":user_id", $this->user_id);
            $stmt->bindParam(":date", $this->date);
            $stmt->bindParam(":subject", $this->subject);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // Get Reservation From ID
        public function getReservationFromID(){
            $sqlQuery = "SELECT
                        Reservation_id,
                        creneau_id,
                        date,
                        subject 
                      FROM
                        ". $this->db_table ."
                    WHERE 
                       user_id = ?
                    LIMIT 0,1";

            $stmt = $this->conn->prepare($sqlQuery);

            $stmt->bindParam(1, $this->user_id);

            $stmt->execute();

            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            
            $this->Reservation_id = $dataRow['Reservation_id'];
            $this->creneau_id = $dataRow['creneau_id'];
            $this->date = $dataRow['date'];
            $this->subject = $dataRow['subject'];
        } 

        // DELETE USER

        function deleteReservation(){
            $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE user_id = ?";
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->user_id=htmlspecialchars(strip_tags($this->user_id));
        
            $stmt->bindParam(1, $this->user_id);
        
            if($stmt->execute()){
                return true;
            }
            return false;
        }

    }
?>