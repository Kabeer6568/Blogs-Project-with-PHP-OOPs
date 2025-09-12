<?php

session_start();

require_once "classes/user.php";

$users = new Users;

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