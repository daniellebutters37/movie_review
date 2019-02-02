<?php require_once('admin/scripts/config.php');
if(isset($_GET['filter'])){
    $tbl1 = 'tbl_movies';
    $tbl2 = 'tbl_genre';
    $tbl3 = 'tbl_mov_genre';
    $col1 = 'movies_id';
    $col2 = 'genre_id';
    $col3 = 'genre_name';
    $filter = $_GET['filter'];
    $results = filterResults($tbl1, $tbl2, $tbl3, $col1, $col2, $col3, $filter);
}else{
    $results = getAll('tbl_movies');
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Movie Reviews</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="css/main.css" />
    <script src="main.js"></script>
</head>
<body>
    <?php include('templates/header.html'); ?>

    <h1>This is the Movie Site</h1>
    <div class="movies">
    <ul>
    <?php

// $results = getAll('tbl_movies');
        while($row = $results->fetch(PDO::FETCH_ASSOC)):?>
        <div>
            <img class="thumb" src="images/<?php echo $row['movies_cover'];?>" alt="<?php echo $row['movie_title'];?>">
            <h3><?php echo $row['movies_title'];?></h3>
            <a href="details.php?id=<?php echo $row['movies_id'];?>">Read More</a>
        </div>
        <?php endwhile;?>
    </ul>
    </div>

    <?php include('templates/footer.html'); ?>

</body>
</html>