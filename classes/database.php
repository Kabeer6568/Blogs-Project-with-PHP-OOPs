<?php

class Database{

    private $host = "localhost";
    private $username = "root";
    private $pass = "";

    public $conn;

    public function __construct(){
    $this->conn = new mysqli($this->host , $this->username , $this->pass);

    if ($this->conn->connect_error) {
        echo "connection error" . $this->conn->connect_error;
    }
    else{
        $this->createDB();
    }

    }

    public function createDB(){

        $createDB_query = "CREATE DATABASE IF NOT EXISTS blog_project";
        $createDB = $this->conn->query($createDB_query);

        

        try {
            if ($createDB == FALSE) {
            throw new Exception("DB Creation failed: " . $this->conn->error);
        }
        else{
            $this->usersTable();
        }
        } catch (Exception $e) {
            echo "DATABASE ERROR" . $e->get_Message();
        }

    }

    public function usersTable(){

        $usedb = "USE blog_project";
        $this->conn->query($usedb);

        $usertable = "CREATE TABLE IF NOT EXISTS users(
        id INT AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(255) NOT NULL,
        useremail VARCHAR(255) NOT NULL,
        userpass VARCHAR(255) NOT NULL,
        role ENUM('admin' , 'user' ) default 'user',
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP)
        ";
        $res = $this->conn->query($usertable);

        if ($res == FALSE) {
            echo "ERROR";
        }

    }


}