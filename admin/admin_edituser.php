<?php
require_once('scripts/config.php');

confirm_logged_in();
$id = $_SESSION['user_id'];

$tbl ='tbl_user';
$col = 'user_id';

if(isset($_POST['submit'])){
    $fname = trim($_POST['fname']);
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $email = trim($_POST['email']);

    //validation
    if(empty($username) || empty($password) || empty($email)){
        $message = 'Please fill the required fields';
    }else{
        $message = editUser($id, $fname, $username, $password, $email);
    }
}
//TO DO Pull all user columns form tbl_user where user_id = $id

$found_user_set = getSingle($tbl, $col, $id);

if(is_string($found_user_set)){
    $message = 'Failed to get user info!';
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Edit User</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="../css/main.css">

</head>
<body>
    <?php if(!empty($message)):?>
        <p><?php echo $message;?></p>
    <?php endif;?>
<h2>Edit User</h2>
<?php if($found_user = $found_user_set->fetch(PDO::FETCH_ASSOC)):?>
<form action="admin_edituser.php" method="post">
    <label for="first-name">First Name:</label>
    <input type="text" id="first-name" name="fname" value="<?php echo $found_user['user_fname'];?>"><br><br>

    <label for="username">Username:</label>
    <input type="text" id="username" name="username" value="<?php echo $found_user['user_name'];?>"><br><br>

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" value="<?php echo $found_user['user_email'];?>"><br><br>

    <label for="email">New Password:</label>
    <input type="text" id="password" name="password" value=""><br><br>

    <button type="submit" name="submit">Edit User</button>
</form>
<?php endif; ?>

<nav>
    <ul>
        <li><a href="index.php">Dashboard</a></li>
        <li><a href="scripts/caller.php?caller_id=logout">Sign Out</a></li>
    </ul>
</nav>

<script src="main.js"></script>
</body>
</html>