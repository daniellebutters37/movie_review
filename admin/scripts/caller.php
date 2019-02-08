<?php
    require('config.php');

    if(isset($_GET['caller_id'])){
        $action = $_GET['caller_id'];

        switch($action){
            case 'logout':
            last_visit();
            logged_out();
            break;
        }
    }


?>