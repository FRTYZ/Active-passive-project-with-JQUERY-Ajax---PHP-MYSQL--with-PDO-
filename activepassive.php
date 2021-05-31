<?php
if ($_POST) { //We check if there is a post
    include("fonc.php"); //connecting to database

    //we take variables as integers
    $id = (int)$_POST['id'];
    $status = (int)$_POST['status'];


    $line = array('id' => $id,
        'status' => $status,
    );
    // We write our data update query.
    $sql = "UPDATE products SET active=:status WHERE id=:id;";
    $status = $connect->prepare($sql)->execute($line);    
    echo $id . " Numbered Data Changed";
}
?>
