<?php
if ($_POST) { //We check if there is a post
    include("fonk.php"); //connecting to database

    //we take variables as integers
    $id = (int)$_POST['id'];
    $status = (int)$_POST['status'];


    $satir = array('id' => $id,
        'status' => $status,
    );
    // We write our data update query.
    $sql = "UPDATE products SET active=:status WHERE id=:id;";
    $status = $connect->prepare($sql)->execute($satir);    
    echo $id . " Numbered Data Changed";
}
?>
