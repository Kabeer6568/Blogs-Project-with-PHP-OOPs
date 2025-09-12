<?php

require_once "database.php";


class Post extends Database{

    public function createPost($user_id , $title , $content , $featured_img){

        
        $target_dir = "uploads/";
        $file_name = uniqid() . "_" . basename($featured_img['name']);
        $target_file = $target_dir . $file_name;

        if (move_uploaded_file($featured_img['tmp_name'] , $target_file)) {

            $createPost_query = "INSERT INTO posts(user_id , title , content , featured_img) VALUES 
        (? , ? , ? , ?)";
        $stat = $this->conn->prepare($createPost_query);
        $stat->bind_param("isss" , $user_id , $title , $content , $target_file);
        
        return $stat->execute();
        }
        else{
            echo "Error uploading file";
        }
        
    }

    public function viewPost($user_id){

        $viewPost = "SELECT * FROM posts WHERE user_id = ?";
        $stat = $this->conn->prepare($viewPost);
        $stat->bind_param("i" , $user_id);
        $stat->execute();
        $res = $stat->get_result();

        return $res;

    }

    public function viewAllPost(){

        $viewAllPost = "SELECT * FROM posts";
        $res = $this->conn->query($viewAllPost);
        return $res;
    }

}