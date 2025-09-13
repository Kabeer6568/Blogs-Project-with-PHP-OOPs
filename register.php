<?php
$page_title = "Register - BlogSpace";
$css_path = "";
$home_path = "";
$js_path = "";

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
    $error_message = $th->getMessage();
}

include 'includes/header.php';
?>

<div class="form-container">
    <form method="post">
        <div class="text-center" style="margin-bottom: 30px;">
            <i class="fas fa-user-plus" style="font-size: 3rem; color: #667eea; margin-bottom: 20px;"></i>
            <h1>Join BlogSpace</h1>
            <p style="color: #666;">Create your account and start sharing your thoughts</p>
        </div>
        
        <?php if (isset($error_message)): ?>
            <div class="alert alert-error">
                <i class="fas fa-exclamation-circle"></i>
                <?php echo $error_message; ?>
            </div>
        <?php endif; ?>
        
        <div class="form-group">
            <label for="username">
                <i class="fas fa-user"></i>
                Username
            </label>
            <input type="text" 
                   id="username" 
                   name="username" 
                   placeholder="Choose a unique username" 
                   required>
        </div>
        
        <div class="form-group">
            <label for="email">
                <i class="fas fa-envelope"></i>
                Email Address
            </label>
            <input type="email" 
                   id="email" 
                   name="useremail" 
                   placeholder="Enter your email address" 
                   required>
        </div>
        
        <div class="form-group">
            <label for="password">
                <i class="fas fa-lock"></i>
                Password
            </label>
            <input type="password" 
                   id="password" 
                   name="userpass" 
                   placeholder="Create a strong password" 
                   required>
        </div>
        
        <div class="form-group">
            <input type="submit" value="Create Account" name="submit" class="btn" style="width: 100%;">
        </div>
        
        <div class="text-center">
            <p style="color: #666; margin-top: 20px;">
                Already have an account? 
                <a href="login.php" style="color: #667eea; text-decoration: none; font-weight: 600;">
                    Login Here
                </a>
            </p>
        </div>
    </form>
</div>
