<?php
    function createUser($fname, $username, $email) {
        include('connect.php');

        //TODO: the following query will create a new row in tbl_user table 
        //with user_fname = $fname
        //user_name = $username
        //user_pass = $password
        //user_email = $email

        //TODO: redirect user to index.php if success
        //otherwise return a message

        $check_user_exist_query = 'SELECT COUNT(*) FROM tbl_user WHERE user_name = :username';
        $check_user_exist = $pdo->prepare($check_user_exist_query);
        $check_user_exist->execute(
            array(
                ':username' => $username
            )
        );

        if(($check_user_exist->fetchColumn())>0){
            return 'user already exists!';
        }

        //give random password that is 10 characters long based on set group of characters 
        function randomAssignedPassword($length = 10) {
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = strlen($characters);
            $assignedPassword = '';
            for ($i = 0; $i < $length; $i++) {
                $assignedPassword .= $characters[rand(0, $charactersLength - 1)];
            }
            return $assignedPassword;
        }

        //place assigned password into table and have it enrypted
        $password = randomAssignedPassword();
        $create_user_query = 'INSERT INTO `tbl_user`(`user_fname`, `user_name`, `user_pass`, `user_email`, `user_time_created`) VALUES (:user_fname, :user_name, :user_pass, :user_email, '.time().')';
        $create_user_set = $pdo->prepare($create_user_query);
        $create_user_set->execute(
            array(
                ':user_fname' => $fname,
                ':user_name' => $username,
                ':user_pass' => md5($password),
                ':user_email' => $email
            )
        );
        // check password (not encrypted) test to make sure its the correct password by logging in again
        // echo($password); die();

        //send email of un-encrypted password
        if($create_user_set->rowCount() > 0){

        $homepage = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http')."://".$_SERVER['SERVER_NAME'];

        $headers = "From: donotreply@movie.com";
        $emailSubject = "Movie Account Setup";
        $emailBody = "Thanks for setting up your new account!".
        "\nUsername Created: $username. Temporary Password: $password. Click Here to Login Now: $homepage";
    
        mail($headers, $email_subject, $emailBody);
        // redirect_to('index.php');
        echo 'Password Has been sent to email, '.$password;

        }else{
            $message = 'User already exist!';
            return $message;
        }
    }


    function editUser($id, $fname, $username, $password, $email){

        include('connect.php');
        $update_user_query = 'UPDATE `tbl_user` SET `user_fname` = :fname,  `user_name` = :uname,  `user_email` = :email,  `user_pass` = :pass WHERE `user_id` = :id';

        $update_user_set = $pdo->prepare($update_user_query);
        $update_user_set->execute(
            array(
                ':fname' => $fname,
                ':uname' => $username,
                ':email' => $email,
                ':pass' => md5($password),
                ':id' => $id
            )
        );


        if($update_user_set->rowCount() > 0 ){
            return 'Your information has been changed';
        } else {
            return ' Something has gone wrong! We were unable to make changes';
        }
    }

?>