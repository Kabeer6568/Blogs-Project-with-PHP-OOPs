<?php
$page_title = "Update Profile - BlogSpace";
$css_path = "";
$home_path = "";
$js_path = "";

session_start();

require_once "classes/user.php";

$users = new Users;

$users->pageVisible();
$id = $_GET['id'];
$getUserByID = $users->getUserByID($id);
$getData = $getUserByID->fetch_assoc();

$success_message = '';
$error_message = '';

if (isset($_POST['update'])) {
    try {
        $result = $users->updateUser($_POST['username'], $_POST['useremail'], $_POST['userpass'], $id);
        if ($result) {
            $success_message = "Profile updated successfully!";
            // Refresh data
            $getUserByID = $users->getUserByID($id);
            $getData = $getUserByID->fetch_assoc();
        } else {
            $error_message = "Failed to update profile. Please try again.";
        }
    } catch (Exception $e) {
        $error_message = "An error occurred: " . $e->getMessage();
    }
}

include 'includes/header.php';
?>

<div class="form-container">
    <form method="post">
        <div class="text-center" style="margin-bottom: 30px;">
            <i class="fas fa-user-edit" style="font-size: 3rem; color: #667eea; margin-bottom: 20px;"></i>
            <h1>Update Profile</h1>
            <p style="color: #666;">Keep your information up to date</p>
        </div>
        
        <?php if ($success_message): ?>
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i>
                <?php echo $success_message; ?>
            </div>
        <?php endif; ?>
        
        <?php if ($error_message): ?>
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
                   value="<?php echo htmlspecialchars($getData['username']); ?>" 
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
                   value="<?php echo htmlspecialchars($getData['useremail']); ?>" 
                   required>
        </div>
        
        <div class="form-group">
            <label for="password">
                <i class="fas fa-lock"></i>
                New Password
            </label>
            <input type="password" 
                   id="password" 
                   name="userpass" 
                   placeholder="Leave blank to keep current password">
            <small style="color: #666; font-size: 14px; margin-top: 5px; display: block;">
                <i class="fas fa-info-circle"></i>
                Only enter a password if you want to change it
            </small>
        </div>
        
        <div class="form-group">
            <input type="submit" value="Update Profile" name="update" class="btn" style="width: 100%;">
        </div>
        
        <div class="text-center">
            <a href="profile.php" style="color: #667eea; text-decoration: none; margin-right: 20px;">
                <i class="fas fa-arrow-left"></i>
                Back to Profile
            </a>
            <a href="index.php" style="color: #667eea; text-decoration: none;">
                <i class="fas fa-home"></i>
                Home
            </a>
        </div>
    </form>
</div>

<style>
.alert {
    animation: slideIn 0.3s ease-out;
}

@keyframes slideIn {
    from {
        opacity: 0;
        transform: translateY(-20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.form-group input[type="password"]::placeholder {
    color: #999;
    font-style: italic;
}

small {
    display: flex;
    align-items: center;
    gap: 5px;
}
</style>

<?php include 'includes/footer.php'; ?>