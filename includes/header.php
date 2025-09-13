<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($page_title) ? $page_title : 'Blog Project'; ?></title>
    <link rel="stylesheet" href="<?php echo isset($css_path) ? $css_path : ''; ?>assets/css/style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar">
        <div class="nav-container">
            <div class="nav-brand">
                <a href="<?php echo isset($home_path) ? $home_path : ''; ?>index.php">
                    <i class="fas fa-blog"></i>
                    BlogSpace
                </a>
            </div>
            <ul class="nav-menu">
                <li><a href="<?php echo isset($home_path) ? $home_path : ''; ?>index.php"><i class="fas fa-home"></i> Home</a></li>
                <?php if (isset($_SESSION['userid'])): ?>
                    <?php if (isset($_SESSION['is_admin']) && $_SESSION['is_admin']): ?>
                        <li><a href="<?php echo isset($admin_path) ? $admin_path : ''; ?>admin/dashboard.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
                    <?php else: ?>
                        <li><a href="<?php echo isset($home_path) ? $home_path : ''; ?>profile.php"><i class="fas fa-user"></i> Profile</a></li>
                        <li><a href="<?php echo isset($home_path) ? $home_path : ''; ?>create_post.php"><i class="fas fa-plus"></i> Create Post</a></li>
                    <?php endif; ?>
                    <li><a href="<?php echo isset($home_path) ? $home_path : ''; ?>logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
                <?php else: ?>
                    <li><a href="<?php echo isset($home_path) ? $home_path : ''; ?>login.php"><i class="fas fa-sign-in-alt"></i> Login</a></li>
                    <li><a href="<?php echo isset($home_path) ? $home_path : ''; ?>register.php"><i class="fas fa-user-plus"></i> Register</a></li>
                <?php endif; ?>
            </ul>
            <div class="hamburger">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
    </nav>
    <main class="main-content">