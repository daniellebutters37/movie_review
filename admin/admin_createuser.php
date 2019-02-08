<?php
    require_once('scripts/config.php');
    //cannot access unless user logged in is confirmed
    confirm_logged_in();

    if(isset($_POST['submit'])){
        // var_dump($_POST); making sure that the data is being placed into an array
        //Do some preprocess for the data. Trim means the start point. 
        $fname = trim($_POST['fname']);
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);
        $email = trim($_POST['email']);

        //validation ( || means or logic)
        if(empty($username) || empty($password) || empty($email)){
            $message = 'Please fill in the required fields';
        }else{
            $message = 'Data seems alright...';
            $message = createUser($fname, $username, $password, $email);
            
        }
    }
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Create User</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="css/main.css" />

</head>
<body>
    <?php if(!empty($message)):?>
        <p><?php echo $message;?></p>
    <?php endif;?>

    <h2>Create User</h2>
    <form action="admin_createuser.php" method="post">
        <label for="first-name">First Name:</label>
        <input type="text" id="first-name" name="fname" value=""><br><br>

        <label for="username">Username:</label>
        <input type="text" id="username" name="username" value=""><br><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value=""><br><br>

        <label for="password">Password:</label>
        <input type="text" id="password" name="password" value=""><br><br>

        <button type="submit" name="submit">Create User</button>
    </form>
    
<script src="js/main.js"></script>
</body>
</html>