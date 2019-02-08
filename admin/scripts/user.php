<?php
    function createUser($fname, $username, $password, $email) {
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
    
        $create_user_query = 'INSERT INTO `tbl_user`(`user_fname`, `user_name`, `user_pass`, `user_email`)';
        $create_user_query .= ' VALUES (:user_fname, :user_name, :user_pass, :user_email)';
        $create_user_set = $pdo->prepare($create_user_query);
        $create_user_set->execute(
            array(
                ':user_fname' => $fname,
                ':user_name' => $username,
                ':user_pass' => $password,
                ':user_email' => $email
            )
        );

        if($create_user_set->rowCount()){
            redirect_to('index.php');
        }else{
            $message = 'user already exist!';
            return $message;
        }
    }

?>