<?php require_once('admin/scripts/config.php');
if(isset($_GET['id'])){
    $tbl = 'tbl_movies';
    $col = 'movies_id';
    $value = $_GET['id'];
    $results = getSingle($tbl, $col, $value);
}else{
    echo 'error';
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Movie Reviews</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="css/main.css">
    <script src="main.js"></script>
</head>
<body>
<?php include('templates/header.html'); ?>
    
    <h1>This is the Movie Site</h1>

    <div class="singleMovie">
    <?php
        while($row = $results->fetch(PDO::FETCH_ASSOC)):?>
            <div><img class="singleThumb" src="images/<?php echo $row['movies_cover'];?>" alt="<?php echo $row['movie_title'];?>"></div>
            <div class="details"> 
                <h3><?php echo $row['movies_title'];?></h3>
                <p><?php echo $row['movies_year'];?></p>
                <p><?php echo $row['movies_runtime'];?></p>
                <p><?php echo $row['movies_storyline'];?></p>
            </div>
        <?php endwhile;?>
    </div>

<?php include('templates/footer.html'); ?>

</body>
</html>