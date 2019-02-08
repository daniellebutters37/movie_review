<?php

function login($username, $password, $ip){
    require('connect.php');
    //Check if username exists
    $check_exist_query = 'SELECT COUNT(*) FROM tbl_user WHERE user_name = :username';
        // echo $check_exist_query;

    $user_set = $pdo->prepare($check_exist_query);
    $user_set->execute(
        array(
            ':username' => $username
            )
    );
    
    if(($user_set->fetchColumn())>0){
        $password_fail_query = 'SELECT account_lockout FROM tbl_user WHERE user_name = "'.$username.'"';
        $password_fail_query = $pdo->query($password_fail_query);
        $password_fail = $password_fail_query->fetch(PDO::FETCH_ASSOC);

        //after 3 login attempts are incorrect block login
        if($password_fail['account_lockout'] == 3){
            $message = 'You have exceeded you login attempts. Your account it temporarily locked';
            return $message;
        }else{
           //Check if password matches username
            $get_user_query = 'SELECT * FROM tbl_user WHERE user_name = :username AND user_pass = :password';
            $get_user_set = $pdo->prepare($get_user_query);
            
            $get_user_set->execute(
                array(
                    ':username' => $username,
                    ':password' => $password
                )
            );
            while($found_user = $get_user_set->fetch(PDO::FETCH_ASSOC)){
                $id = $found_user['user_id'];
                $_SESSION['user_id'] = $id;
                $_SESSION['user_name'] = $found_user['user_name'];
                $_SESSION['user_table'] = $found_user;

                //update user login IP
                //user_ip colum within tbl_user table
                //Don't for get binding
                $update_ip_query = 'UPDATE `tbl_user` SET `user_ip` = :user_ip WHERE `tbl_user`.`user_id` = :user_id';
                $update_ip_set = $pdo->prepare($update_ip_query);
                $update_ip_set->execute(
                    array(
                        ':user_id' => $id,
                        ':user_ip' => $ip
                    )
                );
            }

            if(empty($id)){
                //count setup for incorrect password attempts
                $message = ($password_fail['account_lockout'] <2) ? 'Login Failed!' : 'You have exceeded you login attempts. Your account it temporarily locked';
                //add one each time wrong password is attempted
                $pdo->exec('UPDATE `tbl_user` SET `account_lockout` = `account_lockout` + 1 WHERE `user_name` = "'.$username.'"');
                return $message;
            }else{
                //reset password attempts to 0 if user failed less than 3 and then put in correct password
                $pdo->exec('UPDATE `tbl_user` SET `account_lockout` = 0 WHERE `user_id` = "'.$id.'"');
            }
            redirect_to('index.php');
        }

    }else{
        $message = 'Login Failed!';
        return $message;
    }
}

?>