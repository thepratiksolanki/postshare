<?php
    class Post {
        private $db;

        public function __construct(){
            $this->db = new Database;
        }

        public function getPosts(){
            $this->db->query('SELECT *,
                              posts.id as postId,
                              users.id as userId,
                              posts.created_at as postCreated,
                              users.created_at as userCreated 
                              FROM posts
                              INNER JOIN users
                              ON posts.user_id = users.id
                              ORDER BY posts.created_at DESC');

            $results = $this->db->resultSet();

            return $results;
        }

        public function addPost($data){
            // Prepare the SQL query
            $this->db->query('INSERT INTO posts (title, body, user_id) values(:title, :body, :user_id)');
            // Bind values
            $this->db->bind(':title', $data['title']);
            $this->db->bind(':body', $data['body']);
            $this->db->bind(':user_id', $data['user_id']);
            // Execute the query
            if($this->db->execute()){
                return true;
            } else {
                return false;
            }
        }

        public function updatePost($data){
            // Prepare the SQL query
            $this->db->query('UPDATE posts set title = :title, body = :body WHERE id = :id');
            // Bind values
            $this->db->bind(':title', $data['title']);
            $this->db->bind(':body', $data['body']);
            $this->db->bind(':id', $data['id']);
            // Execute the query
            if($this->db->execute()){
                return true;
            } else {
                return false;
            }
        }

        public function deletePost($id){
            // Prepare the SQL query
            $this->db->query('DELETE FROM posts WHERE id = :id');
            // Bind values
            $this->db->bind(':id', $id);
            // Execute the query
            if($this->db->execute()){
                return true;
            } else {
                return false;
            }
        }

        public function getPostById($id){
            $this->db->query("SELECT * FROM posts where id = :id");
            $this->db->bind(':id', $id);

            $row = $this->db->single();

            return $row;
        }
    }