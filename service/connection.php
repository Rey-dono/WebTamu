<?php
$server_name = 'localhost';
$username = 'root';
$password = '';
$database = "tamu_v.2.3";//sesuaikan nama database

$conn = mysqli_connect($server_name, $username, $password, $database);

if ($conn->connect_error) {
    die("gagal". $conn->connect_error);
}