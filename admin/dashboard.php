<?php

session_start();

require_once "../classes/user.php";
require_once "../classes/post.php";

$users = new Users;
$post = new Post;

$users->pageVisible();
$users->checkLogin();
$data = $users->viewAllUsers();



?>

<h1>ADMIN DASHBOARD</h1>

<table border=1>
    <tr>
        <th>USERNAME</th>
        <th>EMAIL</th>
        <th>EDIT</th>
        <th>DELETE</th>
    </tr>
    <?php
    
    while ($rows = $data->fetch_assoc()) { ?>
        <td>
        <?php echo htmlspecialchars($rows['username']); ?>
        </td>
        <td>
        <?php echo htmlspecialchars($rows['useremail']); ?>
        </td>
        <td>
        <button>
    <a href="http://localhost/blog_project/update.php?id=<?php echo htmlspecialchars($rows['id']); ?>">Update Data</a>
</button>
        </td>
        <td>
            <button>
    <a href="delete.php?id=<?php echo htmlspecialchars($rows['id']); ?>">Delete Data</a>
</button>
        </td>
    

    
    <tr>

    </tr>
    <?php } ?>
</table>




<?php 


if (isset($_POST['post_id'] , $_POST['status'])) {
    $post->postStatus($_POST['post_id'] , $_POST['status']);
}
else{
    echo "error";
}

$res = $post->viewAllPost();


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
        <th>POSTED BY</th>
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
            <img src="../<?php echo htmlspecialchars($data['featured_img']) ?>" style="width: 100px">
        </th>
        <th>
        <form action="" method="post">

            <input type="hidden" name="post_id" value="<?php echo $data['id']; ?>">

            <select name="status" onchange="this.form.submit()">
                <option value="pending" <?php if($data['status'] == 'pending'){echo 'selected';} ?>>Pending</option>
                <option value="approved" <?php if($data['status'] == 'approved'){echo 'selected';} ?>>Approved</option>
                <option value="rejected" <?php if($data['status'] == 'rejected'){echo 'selected';} ?>>Rejected</option>
            </select>
        </form>
        </th>
        <th>
            <?php echo htmlspecialchars($data['username']); ?>
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
    echo "<br><br>NO POSTS TO SHOW";
}

?>