<?php
    class User{
        private $db;
        
        public function __construct(){
            $this->db = new Database;
        }

        // Register User
        public function register($data){
            // Prepare the SQL query
            $this->db->query('INSERT INTO users (name, email, password) values(:name, :email, :password)');
            // Bind values
            $this->db->bind(':name', $data['name']);
            $this->db->bind(':email', $data['email']);
            $this->db->bind(':password', $data['password']);
            // Execute the query
            if($this->db->execute()){
                return true;
            } else {
                return false;
            }
        }

        // Find user by email
        public function findUserByEmail($email){
            $this->db->query('Select * from users WHERE email = :email');
            $this->db->bind(':email', $email);

            $row = $this->db->single();

            // Check row
            if($this->db->rowCount() > 0){
                return true;
            } else {
                return false;
            }
        }
    }
