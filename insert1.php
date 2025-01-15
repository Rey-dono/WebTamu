<?php
session_start();
include "service/connection.php";

if(isset($_POST['text'])){

    $text = $_POST['text'];

    $sql = "INSERT INTO reports(nama, date) VALUES('$text', NOW())";

    if($conn->query($sql) === TRUE){
    $_SESSION['success'] = 'data berhasil ditambahkan';
    }else{
       $_SESSION['error'] = $conn->error;
    }
header("location: index.php");
    
}
$conn->close();
?>