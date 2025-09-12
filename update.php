<?php

session_start();

require_once "classes/user.php";

$users = new Users;

$users->pageVisible();
$id = $_GET['id'];
$getUserByID = $users->getUserByID($id);
$getData = $getUserByID->fetch_assoc();



if (isset($_POST['update'])) {
    $users->updateUser($_POST['username'] , $_POST['useremail'] , $_POST['userpass'] , $id);
}

?>

<h1>UPDATE DATA</h1>

<form method = "post">
    Username : <input type="text" name="username" value="<?php echo htmlspecialchars($getData['username']); ?>">
    <br>
    <br>
    Email : <input type="email" name="useremail" value="<?php echo htmlspecialchars($getData['useremail']); ?>">
    <br><br>
    Password : <input type="password" name="userpass" value="">
    <br><br>
    <input type="submit" value="Update" name="update">
</form>

<p>Already have an account? <a href="login.php">Login Here</a></p>

