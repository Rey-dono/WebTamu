<?php
session_start();
include "../service/connection.php";

if(isset($_POST['data'])){

    $item = $_POST['data'];

    // check if the token is exist
    $sql = "SELECT token FROM tamu WHERE token = '$item'";

    if($conn->query($sql)->num_rows > 0){

        // check if fid_tamu already exists in reports
        $checkSql = "SELECT fid_tamu FROM reports WHERE fid_tamu = (SELECT id FROM tamu WHERE token = '$item')";
        if($conn->query($checkSql)->num_rows == 0){
            $sql = "INSERT INTO reports (fid_tamu, date, time, events_fid) VALUES (
            (SELECT id FROM tamu WHERE token = '$item'), 
            CURDATE(), 
            CURTIME(), 
            (SELECT fid_events FROM tamu WHERE token = '$item') 
            )";
            $conn->query($sql);
            $_SESSION['success'] = 'data berhasil ditambahkan';
        } else {
            $_SESSION['error'] = 'kamu sudah scan';
        }
    } else {
       $_SESSION['error'] = "Kamu tidak terdaftar";
    }

    // redirect to scan.php
header("location: ../scan.php");
}
// $conn->close();