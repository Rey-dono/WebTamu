<?php 
session_start();

include "connection.php";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $type = $_POST['type'];
    
    switch($type){
        case 'form':
            form();
            break;

        case 'login':
            login();
            break;

        case 'event':
            event();
            break;
        
        case 'account':
            account();
            break;

        case 'edit':
            edit();
            break;
        
        case 'delete':
            delete();
            break;            

        default:
        header ("location: ../index.php");
        break;
    }
} else if($_SERVER["REQUEST_METHOD"] == "GET"){
    $type = $_GET['value'];
    switch($type){
        case 'del_e':
            del_e();
            break;
        case 'del_acc':
            del_acc();
            break;
        default:
            // header ("location: ../index.php");
            echo "$type";
            break;
    }
}


function del_e(){
    include "connection.php";
    $id = $_GET['id'];
    $sql = "DELETE FROM events WHERE id=$id";
    $result = mysqli_query($conn, $sql);
    if($result){
        $_SESSION['success'] = 'data berhasil dihapus';
    } else {
        $_SESSION['error'] = 'Data salah';
    }
    header ("location: ../dashboard/home.php");
}

function del_acc(){
    include "connection.php";
    $id = $_GET['id'];
    $sql = "DELETE FROM admin WHERE id=$id";
    $result = mysqli_query($conn, $sql);
    if($result){
        $_SESSION['success'] = 'data berhasil dihapus';
    } else {
        $_SESSION['error'] = 'Data salah';
    }
    header ("location: ../dashboard/acc.php");
}

function edit() {
    include "connection.php";
    $id= $_POST['id'];
    $name= $_POST['name'];
    $email= $_POST['email'];
    $phone= $_POST['phone'];
    $password=  $_POST['password'];
    $cpassword= $_POST['cpassword'];

    if(empty($password) && empty($cpassword)){ // If the password is empty and the confirm password is empty
        if(empty($name) || empty($email) || empty($phone)){
            $_SESSION['error']='Isi dlu';
            header("location: ../dashboard/edit-acc.php?id=$id");
            exit;
        }

        $sql_check = "SELECT email FROM admin WHERE (email = '$email' OR phone = '$phone') AND id != $id";
        $result_check = $conn->query($sql_check);

        // Jika ada record lain dengan email atau phone yang sama, tampilkan error
        if ($result_check->num_rows > 0) {
            $_SESSION['error'] = "Kesamaan ditemukan: Email dan/atau NO Telephone sudah digunakan.";
            header("location: ../dashboard/edit-acc.php?id=$id");
            exit;
        }

        $sql= "UPDATE admin SET username = '$name', email = '$email', phone = '$phone' WHERE id = $id";
        $result = $conn->query($sql);
        
        if (!$result){
            $_SESSION['error']= "Query salah" . $conn->error;
            header("location: ../dashboard/edit-acc.php?id=$id");
            $_SESSION['error']= "Query salah: {$conn->error}";
        }

        $_SESSION['success'] = "updated";
        header("location: ../dashboard/acc.php");
        exit;
    } else { // If the password is not empty and the confirm password is not empty

        if(empty($name)){
            $_SESSION['error']='nama harus diisi';
            header("location: ../dashboard/edit-acc.php?id=$id");
            exit;
        } else if(empty($email)){
            $_SESSION['error']='email harus diisi';
            header("location: ../dashboard/edit-acc.php?id=$id");
            exit;
        } else if(empty($phone)){
            $_SESSION['error']='phone harus diisi';
            header("location: ../dashboard/edit-acc.php?id=$id");
            exit;
        } else if($password != $cpassword){
            $_SESSION['error']='password tidak sesuai';
            header("location: ../dashboard/edit-acc.php?id=$id");
            exit;
        }

        
        $sql_check = "SELECT * FROM admin WHERE (email = '$email' OR phone = '$phone') AND id != $id";
        $result_check = $conn->query($sql_check);
        
        // Jika ada record lain dengan email atau phone yang sama, tampilkan error
        if ($result_check->num_rows > 0) {
            $_SESSION['error'] = "Kesamaan ditemukan: Email dan NO Telephone sudah digunakan.";
            header("location: ../dashboard/edit-acc.php?id=$id");
            exit;
        }
        if($password == $cpassword){
            $password = hash('sha256', $_POST['password']); // Hash the input password using SHA-256
            $sql= "UPDATE admin SET username = '$name', email = '$email', phone = '$phone', password = '$password' WHERE id = $id";
            $result = $conn->query($sql);
            
            if (!$result){
                $_SESSION['error']= "Query salah" . $conn->error;
                header("location: ../dashboard/edit-acc.php?id=$id");
                $_SESSION['error']= "Query salah: {$conn->error}";
            }
    
            $_SESSION['success'] = "Data berhasil diubah dan password berhasil diupdate";
            header("location: ../dashboard/acc.php");
            exit;
        }else{
            $_SESSION['error'] = 'Password Tidak Sesuai';
            header("location: ../dashboard/edit-acc.php?id=$id");
            exit;
        }
    } 
}

function account(){
    include "connection.php";
    $username = $_POST['username'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = hash('sha256', $_POST['password']); // Hash the input password using SHA-256
    $cpassword = hash('sha256', $_POST['cpassword']);

    if ($password == $cpassword) {
        $sql = "SELECT * FROM admin WHERE email='$email'";
        $result = mysqli_query($conn, $sql);
        if (!$result->num_rows > 0) {
            $sql = "INSERT INTO admin (username, email, password, phone)
                    VALUES ('$username', '$email', '$password', '$phone')";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                $_SESSION['success'] = 'Selamat, registrasi berhasil!';
                header("Location: ../dashboard/acc.php");
                exit();
            } else {
                $_SESSION['error'] = 'Ada data yang salah';
            }
        } else {
            $_SESSION['error'] = 'Email sudah terdaftar';
        }
    } else {
        $_SESSION['error'] = 'Password Tidak Sesuai';
    }

    header ("location: ../dashboard/acc.php");
}

function event(){
    include "connection.php";
    $name = $_POST['name'];
    $instansi = $_POST['instansi'];
    $start = $_POST['start'];
    $over = $_POST['over'];

    $sql = "SELECT name FROM events WHERE name = '$name'";
    $result = mysqli_query($conn, $sql);
    if(!$result->num_rows > 0){
        // Check if the event dates overlap with any existing events
        $sql = "SELECT * FROM events WHERE ('$start' BETWEEN waktu_mulai AND waktu_berakhir) OR ('$over' BETWEEN waktu_mulai AND waktu_berakhir) OR (waktu_mulai BETWEEN '$start' AND '$over') OR (waktu_berakhir BETWEEN '$start' AND '$over')";
        $result = mysqli_query($conn, $sql);
        
        if(!$result->num_rows > 0){
            $sql = "INSERT INTO events ( name, instansi, waktu_mulai, waktu_berakhir) VALUES ('$name', '$instansi', '$start', '$over')";
            $result = mysqli_query($conn, $sql);
            if($result){
                $_SESSION['success'] = 'data berhasil ditambahkan';
            } else {
                $_SESSION['error'] = 'Data salah';
            }
        } else {
            $_SESSION['error'] = 'Tanggal event bertabrakan dengan event lain';
        }
    } else {
        $_SESSION['error'] = 'Data sudah ada';
    }

    header ("location: ../dashboard/home.php");
}


function delete(){
    include "connection.php";
    $id = $_GET['id'];
    $sql = "DELETE FROM  WHERE id=$id";
    $result = mysqli_query($conn, $sql);
    if($result){
        $_SESSION['success'] = 'data berhasil dihapus';
    } else {
        $_SESSION['error'] = 'Data salah';
    }
    header ("location: ../dashboard/home.php");
}

function form(){
    include "connection.php";
   // Tambahkan ini jika belum ada

    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $telepon = mysqli_real_escape_string($conn, $_POST['telepon']);
    $token = mysqli_real_escape_string($conn, $_POST['token']);
    $sql_e = "SELECT id FROM events WHERE CURDATE() BETWEEN waktu_mulai AND waktu_berakhir";

    $event = mysqli_query($conn,$sql_e);
    if($event->num_rows == 0){
      $_SESSION['error'] = 'Tidak ada event yang berlangsung';
        header ("location: ../index.php");
        
    }
    $level = ($token != "") ? 'VIP' : 'REGULAR';

    $sql = "SELECT * FROM tamu WHERE nama = '$nama'";
    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) == 0){ 
        $sql = "INSERT INTO tamu (nama, fid_events, level, token, telepon) VALUES ('$nama', (SELECT id FROM events WHERE CURDATE() BETWEEN waktu_mulai AND waktu_berakhir), '$level', '$token', '$telepon')";
        $result = mysqli_query($conn, $sql);
        if($result){
           
                $sql = "INSERT INTO reports (fid_tamu, date, time, events_fid) VALUES (
                    (SELECT id FROM tamu WHERE telepon = $telepon), 
                    CURDATE(), 
                    CURTIME(), 
                    (SELECT id FROM events WHERE CURDATE() BETWEEN waktu_mulai AND waktu_berakhir)
                    )";
                    
                    $result = mysqli_query($conn, $sql);
            $_SESSION['success'] = 'data berhasil ditambahkan';
            
        } else {
            $_SESSION['error'] = 'Terjadi kesalahan saat menambahkan data';
        }
    } else {
        $_SESSION['error'] = 'Data sudah ada';
    }

    header("location: ../index.php");
    exit();
}



function login(){
    include "connection.php";
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password =  hash('sha256', $_POST['password']); // Hash the input password using SHA-256
    $sql = "SELECT * FROM admin WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $sql);

    if ($result->num_rows > 0) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['username'] = $row['username'];
        $_SESSION['id'] = $row['id'];
        $_SESSION['success'] = 'Berhasil login';
        header('location: ../dashboard/home.php');
        exit();
    } else {
        $_SESSION['error'] = 'Ada data yang salah';
        }
    }
