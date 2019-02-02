<?php
require_once('scripts/config.php');
confirm_logged_in();

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Admin Panel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="css/main.css" />
    
</head>
<body>
    <h1>Admin Dashboard</h1>
    <h3>Welcome <?php echo $_SESSION['user_name']; ?></h3>

    <p>This is the admin dashboard page</p>
    
    <nav>
        <ul>
            <li><a href="#">Create User</a></li>
            <li><a href="#">Edit User</a></li>
            <li><a href="#">Delete User</a></li>
            <li><a href="scripts/caller.php?caller_id=logout">Sign Out</a></li>
        </ul>
    </nav>

    <script src="js/main.js"></script>
</body>
</html>