<?php

require_once "classes/user.php";

session_start();

$users = new Users;

$users->checkLogin();

if (isset($_POST['submit'])) {
    $users->login($_POST['username'] , $_POST['pass']);
}

?>





<h1>LOGIN HERE</h1>

<form method = "post">
    Username/Email : <input type="text" name="username">
    <br>
    <br>
    Password : <input type="password" name="pass" id="">
    <br><br>
    <input type="submit" value="Login" name="submit">
</form>

<p>Dont have an account? <a href="register.php">Register Here</a></p>
