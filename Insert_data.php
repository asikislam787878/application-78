<?php

$frist_names = $_POST['first_name'];
$last_names = $_POST['last_name'];

$conn = mysqli_connect('localhost', 'root', '', 'asikislam') or die("Connection Fialed!");

$insertData = " INSERT INTO `info`(`fname`, `lname`) VALUES ('$frist_names','$last_names') ";

$query = mysqli_query($conn, $insertData);

if($query === TRUE){
    echo 1;
}else{
    echo 0;
}

?>