<?php
$page_title = "Create Post - BlogSpace";
$css_path = "";
$home_path = "";
$js_path = "";

session_start();

require_once "classes/user.php";
require_once "classes/post.php";

$users = new Users;
$users->pageVisible();

$id = $_SESSION['userid'];

$getpost = new Post;

if (isset($_POST['post'])) {
    $getpost->createPost($id , $_POST['title'] , $_POST['content'] , $_FILES['featured_img']);
    header("location: profile.php");
}

include 'includes/header.php';
?>

<div class="form-container">
    <form method="post" enctype="multipart/form-data">
        <div class="text-center" style="margin-bottom: 30px;">
            <i class="fas fa-pen-alt" style="font-size: 3rem; color: #667eea; margin-bottom: 20px;"></i>
            <h1>Create New Post</h1>
            <p style="color: #666;">Share your thoughts and ideas with the world</p>
        </div>
        
        <div class="form-group">
            <label for="title">
                <i class="fas fa-heading"></i>
                Post Title
            </label>
            <input type="text" 
                   id="title" 
                   name="title" 
                   placeholder="Enter an engaging title for your post" 
                   required>
        </div>
        
        <div class="form-group">
            <label for="content">
                <i class="fas fa-align-left"></i>
                Content
            </label>
            <textarea id="content" 
                      name="content" 
                      placeholder="Write your post content here... Share your thoughts, experiences, or knowledge!"
                      rows="8" 
                      required></textarea>
        </div>
        
        <div class="form-group">
            <label for="featured_img">
                <i class="fas fa-image"></i>
                Featured Image
            </label>
            <input type="file" 
                   id="featured_img" 
                   name="featured_img" 
                   accept="image/*" 
                   required>
            <small style="color: #666; font-size: 14px; margin-top: 5px; display: block;">
                <i class="fas fa-info-circle"></i>
                Choose an attractive image that represents your post content
            </small>
        </div>
        
        <div class="form-group">
            <input type="submit" value="Publish Post" name="post" class="btn" style="width: 100%;">
        </div>
        
        <div class="text-center">
            <a href="profile.php" style="color: #667eea; text-decoration: none;">
                <i class="fas fa-arrow-left"></i>
                Back to Profile
            </a>
        </div>
    </form>
</div>

<style>
.form-container form {
    max-width: 600px;
}

textarea {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    resize: vertical;
    min-height: 150px;
}

input[type="file"] {
    padding: 12px;
    background: #f8f9fa;
    border: 2px dashed #e1e5e9;
    text-align: center;
}

input[type="file"]:hover {
    border-color: #667eea;
    background: rgba(102, 126, 234, 0.05);
}

.image-preview {
    margin-top: 15px;
    text-align: center;
}

.image-preview img {
    max-width: 300px;
    max-height: 200px;
    border-radius: 10px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
}
</style>

<?php include 'includes/footer.php'; ?>