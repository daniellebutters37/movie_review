<?php
require_once('scripts/config.php');
    if(empty($_POST['username']) || empty($_POST['password'])){
        $message = 'Please fill in username and password to continue';
    }else{
        $username = $_POST['username'];
        $password = $_POST['password'];
        $ip = $_SERVER['REMOTE_ADDR'];

        $message = login($username, $password, $ip);
        // echo $message;
    }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Admin Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="css/main.css" />
    
</head>
<body>
    <?php if(!empty($message)):?>
        <p><?php echo $message;?></p>
    <?php endif;?>

    <form action="admin_login.php"  method="post">
        <label>Username:
            <input type="text" name="username" value="">
        </label>
        <br>
        <label>Password:
            <input type="password" name="password" value="">
        </label>
        <br>
        <button type="submit">Submit</button>
        <br>
    </form>


    <script src="js/main.js"></script>
</body>
</html>