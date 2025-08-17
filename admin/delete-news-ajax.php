<?php
include('../include/db.php');

if(isset($_POST['id'])){
    $id = intval($_POST['id']);
    $sql = "DELETE FROM news WHERE id = $id";
    if(mysqli_query($conn, $sql)){
        echo "success";
    } else {
        echo "error";
    }
}
?>
