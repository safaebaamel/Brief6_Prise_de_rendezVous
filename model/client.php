<?php

    class client {

        // Connection
        private $conn;

        // Table
        private $db_table = "user";

        // Columns
        public $user_id;
        public $Fname;
        public $Lname;
        public $Email;
        public $Reference;

        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }

        // GET ALL
        public function getAllUSers(){
            $sqlQuery = "SELECT user_id, Fname,Lname, Email, Reference FROM " . $this->db_table . "";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

        // EXIST TOKEN ?

        // public function existToken() {
            
        //     $sqlQuery = "SELECT Reference FROM". $this->db_table . "WHERE Reference= ? LIMIT 0,1";

        //     $stmt = $this->conn->prepare($sqlQuery);
        //     $stmt->bindParam(1, $this->Reference);
        //     $stmt->execute();
        //     $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
        //     if ($dataRow == 1 {
        //         return true;
        //     } else {
        //         return false;
        //     }
        // }

        // CREATE
        public function createUser(){
            $token = bin2hex(random_bytes(16));

            $sqlQuery = "INSERT INTO
                        ". $this->db_table ."
                    SET
                        Fname = :Fname, 
                        Lname = :Lname, 
                        Email = :Email,
                        Reference = :Reference";        
            $stmt = $this->conn->prepare($sqlQuery);
        
            // sanitize
            $this->Fname=htmlspecialchars(strip_tags($this->Fname));
            $this->Lname=htmlspecialchars(strip_tags($this->Lname));
            $this->Email=htmlspecialchars(strip_tags($this->Email));
            $this->Reference = $token;
        
            // bind data
            $stmt->bindParam(":Fname", $this->Fname);
            $stmt->bindParam(":Lname", $this->Lname);
            $stmt->bindParam(":Email", $this->Email);
            $stmt->bindParam(":Reference", $this->Reference);
        
            if($stmt->execute()){
               return $token;
            } else {
                return false;
            }
        }

        // Get User From ID
        public function getUserFromID(){
            $sqlQuery = "SELECT
                        user_id, 
                        Fname, 
                        Lname,
                        Reference 
                      FROM
                        ". $this->db_table ."
                    WHERE 
                       user_id = ?
                    LIMIT 0,1";

            $stmt = $this->conn->prepare($sqlQuery);

            $stmt->bindParam(1, $this->Reference);

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

        function deleteUser(){
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