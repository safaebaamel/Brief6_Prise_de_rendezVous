<?php

    require_once '../config/database.php';

    class client {

        // Connection
        private $conn;

        // Table
        private $db_table = "reservation";

        // Columns
        public $user_id;
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
       
        // CREATE
        public function createReservation(){

            $sqlQuery = "INSERT INTO
                        ". $this->db_table ."
                    SET
                        date = :date, 
                        subject = :subject"

            $stmt = $this->conn->prepare($sqlQuery);
        
            // sanitize
            $this->date=htmlspecialchars(strip_tags($this->date));
            $this->subject=htmlspecialchars(strip_tags($this->subject));
           
        
            // bind data
            $stmt->bindParam(":date", $this->date);
            $stmt->bindParam(":subject", $this->subject);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // Get User From ID
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
            
            $this->Fname = $dataRow['Fname'];
            $this->Lname = $dataRow['Lname'];
            $this->Email = $dataRow['Email'];
            $this->Reservation = $dataRow['Reservation'];
        }        

        // UPDATE
        public function updateClient(){
            $sqlQuery = "UPDATE
                        ". $this->db_table ."
                    SET
                        Fname = :Fname, 
                        Lname = :Lname, 
                        Email = :Email 
                    WHERE 
                        user_id = :user_id";
                        
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->user_id=htmlspecialchars(strip_tags($this->user_id));
            $this->Fname=htmlspecialchars(strip_tags($this->Fname));
            $this->Lname=htmlspecialchars(strip_tags($this->Lname));
            $this->Email=htmlspecialchars(strip_tags($this->Email));
        
            // bind data
            $stmt->bindParam(":user_id", $this->user_id);
            $stmt->bindParam(":Fname", $this->Fname);
            $stmt->bindParam(":Lname", $this->Lname);
            $stmt->bindParam(":Email", $this->Email);
           
            if($stmt->execute()){
               return true;
            }
            return false;
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