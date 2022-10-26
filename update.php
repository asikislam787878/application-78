<?php

    $id = $_POST['e_id'];
    $fname = $_POST['e_fname'];
    $lname = $_POST['e_lname'];

    $conn = mysqli_connect('localhost', 'root', '', 'asikislam') or die("Connection Fialed!");

    $updateData = "UPDATE `info` SET  `fname`='$fname',`lname`='$lname' WHERE Id = $id";

    $result = mysqli_query($conn, $updateData);

    if($result === TRUE){
        echo 1;
    }else{
        echo 0;
    }

?>