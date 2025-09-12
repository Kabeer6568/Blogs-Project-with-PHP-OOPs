<?php

session_start();

require_once "../classes/user.php";

$users = new Users;

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

