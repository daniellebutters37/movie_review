<?php
$db_dsn = array(
    'host'=>'localhost',
    'dbname'=>'db_movies',
    'charset'=>'utf8',
);

$dsn ='mysql:'.http_build_query($db_dsn,'',';');

//This is the DB credentials
$db_user = 'root';
$db_pass = 'root';

//tri-catch not sure if it will have an acception, so anything that will break it will show connection error
try{
    $pdo = new PDO($dsn,$db_user,$db_pass);
    // var_dump($pdo);
}catch(PDOException $exception){
    echo'connect error'.$exception->getMessage();
    exit();
}

?>