<?php

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

?>


<h1>CREATE A POST</h1>

<form action="" method="post" enctype="multipart/form-data">

Title : <input type="text" name="title" id="">
<br><br>
Content input: <textarea name="content" id=""></textarea>
<br><br>
Featured Image: <input type="file" name="featured_img" accept= "image/*">
<br><br>
<input type="submit" value="Post" name="post">

</form>