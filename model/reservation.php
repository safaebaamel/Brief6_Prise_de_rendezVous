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

            $sqlQuery = "INSERT reservaation SET  user_id=:user_id, creneau_id=:creneau_id, date=:date, Subject=:Subject"; 

            $stmt = $this->conn->prepare($sqlQuery);
        
            // // sanitize

            $this->user_id=htmlspecialchars(strip_tags($this->user_id));
            $this->creneau_id=htmlspecialchars(strip_tags($this->creneau_id));
            $this->date=htmlspecialchars(strip_tags($this->date));
            $this->Subject=htmlspecialchars(strip_tags($this->Subject));
           
        
            // bind data
            $stmt->bindParam(":creneau_id", $this->creneau_id);
            $stmt->bindParam(":user_id", $this->user_id);
            $stmt->bindParam(":date", $this->date);
            $stmt->bindParam(":Subject", $this->Subject);
        
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
            $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE Reservation_id = ?";
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->user_id=htmlspecialchars(strip_tags($this->user_id));
        
            $stmt->bindParam(1, $this->user_id);
        
            if($stmt->execute()){
                return true;
            }
            return false;
        }

        public function getTimeSlote() {

            $query = " SELECT *FROM creneau WHERE Creneau_id NOT IN(SELECT creneau_id FROM reservaation WHERE date= ?)";

            $req = $this->conn->prepare($query);
            $req->execute([$this->date]);

            return  $req;
        }

        public function UpdateRDV() {

            $query = 'UPDATE reservaation SET  Subject=:Subject, date=:date ,Creneau_id=:Creneau_id WHERE Reservation_id=:Reservation_id';
            $stmt = $this->conn->prepare($query);

            $this->Reservation_id = htmlspecialchars(strip_tags($this->Reservation_id));
            $this->Subject = htmlspecialchars(strip_tags($this->Subject));
            $this->date = htmlspecialchars(strip_tags($this->date));
            $this->Creneau_id = htmlspecialchars(strip_tags($this->Creneau_id));

            $stmt->bindParam(':Reservation_id', $this->Reservation_id);
            $stmt->bindParam(':Subject', $this->Subject);
            $stmt->bindParam(':date', $this->date);
            $stmt->bindParam(':Creneau_id', $this->Creneau_id);

            if ($stmt->execute()){
                return true;
                }

            return false;
        }

        public function getSingleRDV()
        {
            $query = "SELECT * FROM reservaation r INNER JOIN creneau c ON c.Creneau_id = r.creneau_id INNER JOIN user u ON u.user_id = r.user_id where u.user_id =:user_id";
            $stmt = $this->conn->prepare($query);
            $this->user_id=htmlspecialchars(strip_tags($this->user_id));
            $stmt->bindParam(":user_id", $this->user_id);
            $stmt -> execute();


            return $stmt;
        }

        public function getSpecificReservation()
        {
            $query = "SELECT * FROM reservaation r INNER JOIN creneau c ON c.Creneau_id = r.creneau_id INNER JOIN user u ON u.user_id = r.user_id where r.Reservation_id =:Reservation_id";
            $stmt = $this->conn->prepare($query);
            $this->Reservation_id=htmlspecialchars(strip_tags($this->Reservation_id));
            $stmt->bindParam(":Reservation_id", $this->Reservation_id);
            $stmt -> execute();

            return $stmt;
        }

    }
?>