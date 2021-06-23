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

        // EXIST USER???

        public function getUserFromReference(){
            $sqlQuery = "SELECT user_id, Fname, Lname FROM `user` WHERE Reference = :Reference LIMIT 0,1";

            $stmt = $this->conn->prepare($sqlQuery);

            $stmt->bindParam(":Reference", $this->Reference);
            $stmt->execute();
            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            $count =  $stmt->rowCount();
            if($count==1)
            {
                $this->user_id = $dataRow['user_id'];
                return $dataRow['user_id'];
            } else {
                return false;
            }
    
            
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