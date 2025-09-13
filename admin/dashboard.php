<?php
$page_title = "Admin Dashboard - BlogSpace";
$css_path = "../";
$home_path = "../";
$admin_path = "";
$js_path = "../";

session_start();

require_once "../classes/user.php";
require_once "../classes/post.php";

$users = new Users;
$post = new Post;

$users->pageVisible();
// $users->checkLogin();
$data = $users->viewAllUsers();

include '../includes/header.php';

if (isset($_POST['post_id'], $_POST['status'])) {
    $post->postStatus($_POST['post_id'], $_POST['status']);
    echo "";
}

$res = $post->viewAllPost();
?>

<div class="container">
    <h1><i class="fas fa-tachometer-alt"></i> Admin Dashboard</h1>
    
    <!-- Users Management Section -->
    <div class="container">
        <h2><i class="fas fa-users"></i> User Management</h2>
        
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th><i class="fas fa-user"></i> Username</th>
                        <th><i class="fas fa-envelope"></i> Email</th>
                        <th><i class="fas fa-calendar"></i> Joined</th>
                        <th><i class="fas fa-tools"></i> Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($rows = $data->fetch_assoc()): ?>
                        <tr>
                            <td>
                                <strong><?php echo htmlspecialchars($rows['username']); ?></strong>
                                <?php if ($rows['role'] === 'admin'): ?>
                                    <span class="status-badge" style="background: #e3f2fd; color: #1565c0; margin-left: 10px;">
                                        Admin
                                    </span>
                                <?php endif; ?>
                            </td>
                            <td><?php echo htmlspecialchars($rows['useremail']); ?></td>
                            <td><?php echo date('M j, Y', strtotime($rows['created_at'])); ?></td>
                            <td>
                                <div style="display: flex; gap: 5px;">
                                    <a href="../update.php?id=<?php echo htmlspecialchars($rows['id']); ?>" 
                                       class="btn btn-sm">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="delete.php?id=<?php echo htmlspecialchars($rows['id']); ?>" 
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
    </div>
    
    <!-- Posts Management Section -->
    <div class="container">
        <h2><i class="fas fa-newspaper"></i> Posts Management</h2>
        
        <?php if ($res->num_rows > 0): ?>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th><i class="fas fa-heading"></i> Title</th>
                            <th><i class="fas fa-align-left"></i> Content</th>
                            <th><i class="fas fa-image"></i> Featured Image</th>
                            <th><i class="fas fa-info-circle"></i> Status</th>
                            <th><i class="fas fa-user"></i> Posted By</th>
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
                                    <img src="../<?php echo htmlspecialchars($data['featured_img']); ?>" 
                                         class="table-img" 
                                         alt="Featured Image">
                                </td>
                                <td>
                                    <form action="" method="post" style="margin: 0;">
                                        <input type="hidden" name="post_id" value="<?php echo $data['id']; ?>">
                                        <select name="status" 
                                                onchange="this.form.submit()" 
                                                class="status-badge status-<?php echo $data['status']; ?>"
                                                style="border: none; background: transparent; cursor: pointer;">
                                            <option value="pending" <?php if($data['status'] == 'pending'){echo 'selected';} ?>>
                                                Pending
                                            </option>
                                            <option value="approved" <?php if($data['status'] == 'approved'){echo 'selected';} ?>>
                                                Approved
                                            </option>
                                            <option value="rejected" <?php if($data['status'] == 'rejected'){echo 'selected';} ?>>
                                                Rejected
                                            </option>
                                        </select>
                                    </form>
                                </td>
                                <td>
                                    <div style="display: flex; align-items: center; gap: 8px;">
                                        <i class="fas fa-user-circle" style="color: #667eea;"></i>
                                        <?php echo htmlspecialchars($data['username']); ?>
                                    </div>
                                </td>
                                <td>
                                    <div style="display: flex; gap: 5px;">
                                        <a href="../update.php?id=<?php echo htmlspecialchars($data['id']); ?>" 
                                           class="btn btn-sm" 
                                           title="Update Post">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="delete.php?id=<?php echo htmlspecialchars($data['id']); ?>" 
                                           class="btn btn-sm btn-danger" 
                                           title="Delete Post">
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
                    <i class="fas fa-newspaper" style="font-size: 4rem; color: #ccc; margin-bottom: 20px;"></i>
                    <h3>No Posts Available</h3>
                    <p>There are no posts to manage at the moment.</p>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>

<style>
.status-badge select {
    font-size: 12px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 1px;
    padding: 6px 12px;
    border-radius: 20px;
}

.status-badge select:focus {
    outline: none;
    box-shadow: 0 0 0 2px rgba(102, 126, 234, 0.3);
}

.table-container {
    margin-bottom: 40px;
}

.container h2 {
    border-bottom: 2px solid #e1e5e9;
    padding-bottom: 10px;
    margin-bottom: 25px;
    color: #333;
}

.btn[title] {
    position: relative;
}

.btn[title]:hover::after {
    content: attr(title);
    position: absolute;
    bottom: 100%;
    left: 50%;
    transform: translateX(-50%);
    background: #333;
    color: white;
    padding: 5px 8px;
    border-radius: 4px;
    font-size: 12px;
    white-space: nowrap;
    z-index: 1000;
}
</style>
