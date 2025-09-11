<?php

session_start();

require_once "classes/user.php";

$users = new Users;

$users->checkLogin();

try {
    if (isset($_POST['submit'])) {
    $users->register($_POST['username'] , $_POST['useremail'] , $_POST['userpass']);
    header("location: profile.php");
    }
    
} catch (Exception $th) {
    echo $th->getMessage();
}




?>





<h1>REGISTER HERE</h1>

<form method = "post">
    Username : <input type="text" name="username">
    <br>
    <br>
    Email : <input type="email" name="useremail" id="">
    <br><br>
    Password : <input type="password" name="userpass" id="">
    <br><br>
    <input type="submit" value="Register" name="submit">
</form>

<p>Already have an account? <a href="login.php">Login Here</a></p>
