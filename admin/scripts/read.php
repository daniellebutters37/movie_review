<?php

function getAll($tbl){
    include('connect.php');

    //fill the following variable with a SQL query that fetching all info from the given tbl $tbl

    $queryAll = 'SELECT * FROM ' .$tbl;
    $runAll = $pdo->query($queryAll);

    if($runAll){
        return $runAll;
    }else{
        $error = 'There was a problem accessing this info';
        return $error;
    }
}

function getSingle($tbl, $col, $value){
    include('connect.php');
    $querySingle = 'SELECT * FROM '.$tbl.' WHERE '.$col.' = '.$value;

    $runSingle = $pdo->query($querySingle);
    if($runSingle){
        return $runSingle;
    }else{
        $error = 'There was a problem!';
        return $error;
    }
}

function filterResults($tbl1, $tbl2, $tbl3, $col1, $col2, $col3, $filter) {
    include('connect.php');
        $filterQuery = 'SELECT * FROM '.$tbl1.' as a, ';
        $filterQuery.= $tbl2.' as b, ';
        $filterQuery.= $tbl3.' as c ';
        $filterQuery.= ' WHERE a.' .$col1.' = c.'.$col1 ;
        $filterQuery.= ' AND b.' .$col2.' = c.'.$col2 ;
        $filterQuery.= ' AND b.' .$col3.' = "'.$filter.'"' ;
    // echo $filterQuery;exit;

    $runQuery = $pdo->query($filterQuery);
    if($runQuery){
        return $runQuery;
    }else{
        $error = 'There was a problem';
        return $error;
    }
}

?>