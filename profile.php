<?php

session_start();

require_once "classes/user.php";
require_once "classes/post.php";

$users = new Users;
$post = new POST;

$users->pageVisible();

$id = $_SESSION['userid'];

$getData = $users->getUserByID($id);

$disData = $getData->fetch_assoc();



?>

<h1>
   USER PROFILE 
</h1>

USERNAME : <?php echo htmlspecialchars($disData['username']); ?>
<br><br>
EMAIL : <?php echo htmlspecialchars($disData['useremail']); ?>

<br><br>

<button>
    <a href="update.php?id=<?php echo htmlspecialchars($disData['id']); ?>">Update Data</a>
</button>
<button>
    <a href="delete.php?id=<?php echo htmlspecialchars($disData['id']); ?>">Delete Data</a>
</button>

<h1>POST</h1>

<button>
    <a href="create_post.php">Create a Post</a>
</button>

<?php 

$res = $post->viewPost($id);


if ($res->num_rows > 0) {
   
?>

<h1>VIEW YOUR POSTS</h1>

<table border = 1>
    <tr>
        <th>TITLE</th>
        <th>CONTENT</th>
        <th>
            FEATURED IMAGE
        </th>
        <th>STATUS</th>
        <th>UPDATE POST</th>
        <th>DELETE POST</th>
    </tr>
    <?php 
    
        while ($data = $res->fetch_assoc()) {
    
    ?>
    <tr>
        <th>
            <?php echo htmlspecialchars($data['title']) ?>
        </th>
        <th>
            <?php echo htmlspecialchars($data['content']) ?>
        </th>
        <th>
            <img src="<?php echo htmlspecialchars($data['featured_img']) ?>" style="width: 200px">
        </th>
        <th>
            <button>
            <?php echo htmlspecialchars($data['status']) ?>
        </button>
        </th>
        <th>
            <button >
                <a href="update.php?id=<?php echo htmlspecialchars($data['id']) ?>">
                    UPDATE POST
                </a>
            </button>
        </th>
        <th>
            <button >
                <a href="delete.php?id=<?php echo htmlspecialchars($data['id']) ?>">
                    DELETE POST
                </a>
            </button>
        </th>
    </tr>

    <?php } ?>
</table>

<?php }
else{
    echo "<br><br>You dont have any post yet <br> POST NOW?";
}

?>