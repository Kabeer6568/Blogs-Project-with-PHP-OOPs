<?php
$page_title = "Home - All Posts";
$css_path = "";
$home_path = "";
$js_path = "";
include 'includes/header.php';

require_once "classes/post.php";

$post = new Post;
$res = $post->showAllPosts();
?>

<div class="container">
    <h1><i class="fas fa-newspaper"></i> Latest Blog Posts</h1>
    
    <?php if ($res->num_rows > 0): ?>
        <div class="posts-grid">
            <?php while ($data = $res->fetch_assoc()): ?>
                <article class="post-card">
                    <img src="<?php echo htmlspecialchars($data['featured_img']); ?>" 
                         alt="<?php echo htmlspecialchars($data['title']); ?>" 
                         class="post-img">
                    <div class="post-content">
                        <h2 class="post-title"><?php echo htmlspecialchars($data['title']); ?></h2>
                        <p class="post-excerpt">
                            <?php 
                            $content = htmlspecialchars($data['content']);
                            echo strlen($content) > 150 ? substr($content, 0, 150) . '...' : $content;
                            ?>
                        </p>
                        <div class="post-meta">
                            <div class="post-author">
                                <i class="fas fa-user"></i>
                                <span><?php echo htmlspecialchars($data['username']); ?></span>
                            </div>
                            <div class="post-date">
                                <i class="fas fa-calendar"></i>
                                <span><?php echo date('M j, Y', strtotime($data['created_at'])); ?></span>
                            </div>
                        </div>
                    </div>
                </article>
            <?php endwhile; ?>
        </div>
    <?php else: ?>
        <div class="container">
            <div class="text-center">
                <i class="fas fa-newspaper" style="font-size: 4rem; color: #ccc; margin-bottom: 20px;"></i>
                <h2>No Posts Available</h2>
                <p>There are no approved posts to display at the moment. Check back later!</p>
                <?php if (!isset($_SESSION['userid'])): ?>
                    <div class="action-buttons" style="justify-content: center; margin-top: 30px;">
                        <a href="register.php" class="btn">
                            <i class="fas fa-user-plus"></i>
                            Join Us
                        </a>
                        <a href="login.php" class="btn btn-secondary">
                            <i class="fas fa-sign-in-alt"></i>
                            Login
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    <?php endif; ?>
</div>

<?php include 'includes/footer.php'; ?>