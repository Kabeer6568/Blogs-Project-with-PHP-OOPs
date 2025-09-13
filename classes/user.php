<?php

require_once "database.php";



class Users{

    private $conn;

    public function __construct(){

        $db = new Database;
        $this->conn = $db->conn;

    }

    public function register($username , $useremail , $userpass){

        if ($this->checkEmail($useremail)) {
            echo "User already exists";
            
        }
        else{

        $register_query = "INSERT INTO users (username , useremail , userpass) VALUES 
        (? ,? ,?)";

        $hash = password_hash($userpass , PASSWORD_BCRYPT);

        $stat = $this->conn->prepare($register_query);
        $stat->bind_param("sss" , $username , $useremail , $hash);
        $res = $stat->execute();

        try {
            if ($res == FALSE) {
                throw new exception("Error In Registration" . $res->connect_error);
            }
        } catch (exception $th) {
            $th->getMessage();
        }
    }
    }

    public function checkEmail($useremail){

        $checkemail = "SELECT * FROM users WHERE useremail = ?";
        $stat = $this->conn->prepare($checkemail);
        $stat->bind_param("s" , $useremail);
        $stat->execute();
        $res = $stat->get_result();

        return $res->num_rows > 0;

    }

    public function login($userinput , $userpass){

        $login_query = "SELECT * FROM users WHERE username = ? OR useremail = ?";
        $stat = $this->conn->prepare($login_query);
        $stat->bind_param("ss" , $userinput , $userinput);
        $stat->execute();
        $res = $stat->get_result();

        if ($res->num_rows > 0) {
            $rows = $res->fetch_assoc();
            $stored_hash = $rows['userpass'];
            if (password_verify($userpass , $stored_hash)) {
                $_SESSION['userid'] = $rows['id'];
                $_SESSION['username'] = $rows['username'];
                $_SESSION['is_admin'] = ($rows['role'] === 'admin');

                if ($_SESSION['is_admin'] === true) {
                    header("location: admin/dashboard.php");
                }
                else{
                    header("location: profile.php");
                }

                
            }
            else{
                echo "Incorrect Password";
            }
        }
        else{
            echo "Username or Email does not exists";
        }


    }

    public function checkLogin(){
        if (!empty($_SESSION['userid'])) {
            if ($_SESSION['is_admin'] == TRUE) {
                header("location: http://localhost/blog_project/admin/dashboard.php");
            }
            else{
            header("location: profile.php");
            }
        }
        
    }
    public function pageVisible(){
        if (empty($_SESSION['userid'])) {
            header("location: http://localhost/blog_project/login.php");
        }
    }

    public function getUserByID($id){

        $getByID_query = "SELECT * FROM users WHERE id = ?";
        $stat = $this->conn->prepare($getByID_query);
        $stat->bind_param("i" , $id);
        $stat->execute();

        return $res = $stat->get_result();
    }

    public function viewAllUsers(){

        $viewAll_query = "SELECT * FROM users";
        $res = $this->conn->query($viewAll_query);

        return $res;
    }

    public function updateUser($username , $useremail , $userpass , $id){

        if (empty($userpass)) {
            $pass = $this->getUserByID($id);
            $old_pass = $pass->fetch_assoc();
            $hash = $old_pass['userpass'];
        }
        else{
            $hash = password_hash($userpass , PASSWORD_BCRYPT);
        }

        $updateUser_query = "UPDATE users SET username = ? , useremail = ? , userpass = ?
        WHERE id =?";
        $stat = $this->conn->prepare($updateUser_query);
        $stat->bind_param("sssi" , $username , $useremail , $hash , $id);
        
        return $stat->execute();

    }





}