<?php

require_once "classes/post.php";

$post = new Post;

$res = $post->showAllPosts();

?>

<h1>ALL POSTS</h1>



<table border = 1>
    <tr>
        <th>TITLE</th>
        <th>CONTENT</th>
        <th>
            FEATURED IMAGE
        </th>
        <th>POSTED BY</th>
        
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
            <img src="<?php echo htmlspecialchars($data['featured_img']) ?>" style="width: 100px">
        </th>
        <th>
            <?php echo htmlspecialchars($data['username']) ?>
        </th>
        
    </tr>

<?php } ?>


