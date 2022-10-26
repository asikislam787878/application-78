<?php

$id = $_POST['id'];

$conn = mysqli_connect('localhost', 'root', '', 'asikislam') or die("Connection Fialed!");

$deleteData = " DELETE FROM `info` WHERE Id = {$id} ";

$query = mysqli_query($conn, $deleteData);

if($query === TRUE){
    echo 1;
}else{
    echo 0;
}

?>