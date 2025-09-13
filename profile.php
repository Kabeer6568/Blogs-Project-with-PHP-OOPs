<?php
$page_title = "Profile - BlogSpace";
$css_path = "";
$home_path = "";
$js_path = "";

session_start();

require_once "classes/user.php";
require_once "classes/post.php";

$users = new Users;
$post = new POST;

$users->pageVisible();

$id = $_SESSION['userid'];

$getData = $users->getUserByID($id);
$disData = $getData->fetch_assoc();

include 'includes/header.php';
?>

<div class="container">
    <h1><i class="fas fa-user-circle"></i> My Profile</h1>
    
    <!-- User Information Section -->
    <div class="user-info">
        <div class="user-details">
            <div class="user-detail">
                <i class="fas fa-user"></i>
                <strong>Username:</strong>
                <span><?php echo htmlspecialchars($disData['username']); ?></span>
            </div>
            <div class="user-detail">
                <i class="fas fa-envelope"></i>
                <strong>Email:</strong>
                <span><?php echo htmlspecialchars($disData['useremail']); ?></span>
            </div>
            <div class="user-detail">
                <i class="fas fa-calendar"></i>
                <strong>Member Since:</strong>
                <span><?php echo date('F j, Y', strtotime($disData['created_at'])); ?></span>
            </div>
        </div>
        
        <div class="action-buttons">
            <a href="update.php?id=<?php echo htmlspecialchars($disData['id']); ?>" class="btn">
                <i class="fas fa-edit"></i>
                Update Profile
            </a>
            <a href="delete.php?id=<?php echo htmlspecialchars($disData['id']); ?>" class="btn btn-danger">
                <i class="fas fa-trash"></i>
                Delete Account
            </a>
        </div>
    </div>
    
    <!-- Posts Section -->
    <div class="container">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
            <h2><i class="fas fa-newspaper"></i> My Posts</h2>
            <a href="create_post.php" class="btn btn-success">
                <i class="fas fa-plus"></i>
                Create New Post
            </a>
        </div>
        
        <?php 
        $res = $post->viewPost($id);
        
        if ($res->num_rows > 0): ?>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th><i class="fas fa-heading"></i> Title</th>
                            <th><i class="fas fa-align-left"></i> Content</th>
                            <th><i class="fas fa-image"></i> Featured Image</th>
                            <th><i class="fas fa-info-circle"></i> Status</th>
                            <th><i class="fas fa-tools"></i> Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($data = $res->fetch_assoc()): ?>
                            <tr>
                                <td>
                                    <strong><?php echo htmlspecialchars($data['title']); ?></strong>
                                </td>
                                <td>
                                    <?php 
                                    $content = htmlspecialchars($data['content']);
                                    echo strlen($content) > 100 ? substr($content, 0, 100) . '...' : $content;
                                    ?>
                                </td>
                                <td>
                                    <img src="<?php echo htmlspecialchars($data['featured_img']); ?>" 
                                         class="table-img" 
                                         alt="Featured Image">
                                </td>
                                <td>
                                    <span class="status-badge status-<?php echo $data['status']; ?>">
                                        <?php echo ucfirst($data['status']); ?>
                                    </span>
                                </td>
                                <td>
                                    <div style="display: flex; gap: 5px;">
                                        <a href="update.php?id=<?php echo htmlspecialchars($data['id']); ?>" 
                                           class="btn btn-sm">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="delete.php?id=<?php echo htmlspecialchars($data['id']); ?>" 
                                           class="btn btn-sm btn-danger">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <div class="container">
                <div class="text-center">
                    <i class="fas fa-pen-alt" style="font-size: 4rem; color: #ccc; margin-bottom: 20px;"></i>
                    <h3>No Posts Yet</h3>
                    <p>You haven't created any posts yet. Start sharing your thoughts with the world!</p>
                    <a href="create_post.php" class="btn btn-success" style="margin-top: 20px;">
                        <i class="fas fa-plus"></i>
                        Create Your First Post
                    </a>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php include 'includes/footer.php'; ?>