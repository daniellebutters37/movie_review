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

    <p>User Last Logged In At: 
        <!-- echo out last login time -->
        <?php 
        if($_SESSION['user_table']['last_visit'] != NULL){
            date_default_timezone_set("America/Toronto");
            echo date('m/d/Y h:i:s', $_SESSION['user_table']['last_visit']);
        } else {
            echo "Congrats, First Login!";
        } 
        ?>
    </p>

    <h3>
        <!-- echo out day greetings -->
        <?php 
            date_default_timezone_set("America/Toronto");
            $time = date("G");

            if($time >= 5 && $time <= 12){
                echo "Morning, ";
            } else if($time >= 12 && $time <= 16){
                echo "Afternoon, ";
            } else {
                echo "Evening, ";
            } 

            echo $_SESSION['user_name']; 
        ?>
    </h3>

    <p>This is the admin dashboard page</p>
    
    <nav>
        <ul>
            <li><a href="admin_createuser.php">Create User</a></li>
            <li><a href="#">Edit User</a></li>
            <li><a href="#">Delete User</a></li>
            <li><a href="scripts/caller.php?caller_id=logout">Sign Out</a></li>
        </ul>
    </nav>

    <script src="js/main.js"></script>
</body>
</html>