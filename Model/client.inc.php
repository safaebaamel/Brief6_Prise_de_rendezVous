<?php

    require_once '../config/database.php';

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
        public $created;

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

        // GENERATE TOKEN 

        public function createToken() {
            $token = bin2hex(random_bytes(16));
            return $token; 
        }

        // CREATE
        public function createUser(){
            $sqlQuery = "INSERT INTO
                        ". $this->db_table ."
                    SET
                        Fname = :Fname, 
                        Lname = :Lname, 
                        Email = :Email,
                        Refenrence = :token";        
            $stmt = $this->conn->prepare($sqlQuery);
        
            // sanitize
            $this->Fname=htmlspecialchars(strip_tags($this->Fname));
            $this->Lname=htmlspecialchars(strip_tags($this->Lname));
            $this->Email=htmlspecialchars(strip_tags($this->Email));
            $this->Reference= createToken();
        
            // bind data
            $stmt->bindParam(":Fname", $this->name);
            $stmt->bindParam(":Lname", $this->name);
            $stmt->bindParam(":Email", $this->email);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // Get User From Reference
        public function getUserFromReference(){
            $sqlQuery = "SELECT
                        user_id, 
                        Fname, 
                        Lname,
                        Reference 
                      FROM
                        ". $this->db_table ."
                    WHERE 
                       Reference = ?
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