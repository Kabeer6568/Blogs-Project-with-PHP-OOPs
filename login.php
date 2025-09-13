<?php
$page_title = "Login - BlogSpace";
// $css_path = "";
// $home_path = "";
// // $js_path = "";

require_once "classes/user.php";

session_start();

$users = new Users;
$users->checkLogin();

if (isset($_POST['submit'])) {
    $users->login($_POST['username'] , $_POST['pass']);
}

include 'includes/header.php';
?>

<div class="form-container">
    <form method="post">
        <div class="text-center" style="margin-bottom: 30px;">
            <i class="fas fa-sign-in-alt" style="font-size: 3rem; color: #667eea; margin-bottom: 20px;"></i>
            <h1>Welcome Back!</h1>
            <p style="color: #666;">Sign in to your account to continue</p>
        </div>
        
        <div class="form-group">
            <label for="username">
                <i class="fas fa-user"></i>
                Username or Email
            </label>
            <input type="text" 
                   id="username" 
                   name="username" 
                   placeholder="Enter your username or email" 
                   required>
        </div>
        
        <div class="form-group">
            <label for="password">
                <i class="fas fa-lock"></i>
                Password
            </label>
            <input type="password" 
                   id="password" 
                   name="pass" 
                   placeholder="Enter your password" 
                   required>
        </div>
        
        <div class="form-group">
            <input type="submit" value="Sign In" name="submit" class="btn" style="width: 100%;">
        </div>
        
        <div class="text-center">
            <p style="color: #666; margin-top: 20px;">
                Don't have an account? 
                <a href="register.php" style="color: #667eea; text-decoration: none; font-weight: 600;">
                    Register Here
                </a>
            </p>
        </div>
    </form>
</div>

<?php  ?>