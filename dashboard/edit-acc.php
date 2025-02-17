<?php

include "../service/connection.php";

session_start();
if (isset($_SESSION['username']) == false) {
    header("location: index.php");
exit();
}

if($_SERVER['REQUEST_METHOD'] == 'GET') {
    if(!isset($_GET['id'])) {
        header('location: ./acc.php');
        exit;
    }

    $id = $_GET['id'];

    $sql = "SELECT username,email,phone,password FROM admin WHERE id=$id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    if(!$row) {
        header('location: ./acc.php');
        exit;
    }

    $name = $row['username'];
    $email = $row['email'];
    $phone = $row['phone'];
    $password = $row['password'];
} else {
    header('location: ./acc.php');
    $_SESSION['error'] = 'Data tidak ditemukan';
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Admin</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.0.0/dist/flowbite.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.23/dist/full.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.15.10/dist/sweetalert2.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.15.10/dist/sweetalert2.all.min.js"></script>

    <style>
       html, body {
    height: 100%; /* Ensure the html and body elements cover the full height */
    margin: 0; /* Remove any default margin */
    padding: 0; /* Remove any default padding */
    background-color: rgb(174, 143, 114); /* Set the background color */
    font-family: 'Ubuntu', sans-serif;
}

.container {
    width: 100px;
    margin: 0 auto;
    padding: 20px;
    background-color: #841922; /* Container background color */
    border-radius: 10px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    display: flex;
    flex-direction: column;
    justify-content: center; /* Center the content vertically */
}

        .input-field {
            width: 100%;
            padding: 12px;
            background-color: rgb(139, 56, 63);
            border-radius: 8px;
            color: white;
            border: 1px solid #2d3748;
        }
        .input-field:focus {
            border-color: #3182ce;
            outline: none;
        }

        label {
            font-size: 1.1rem;
            color: white;
            margin-bottom: 5px;
            display: inline-block;
        }

        .btn {
            padding: 10px 20px;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: bold;
            cursor: pointer;
        }

        .btn-success {
            background-color: #38a169;
            color: white;
        }

        .btn-success:hover {
            background-color: #2f855a;
        }

        .btn-error {
            background-color: #e53e3e;
            color: white;
        }

        .btn-error:hover {
            background-color: #c53030;
        }

        .btn-info {
            background-color: #4c51bf;
            color: white;
        }

        .btn-info:hover {
            background-color: #434190;
        }

        .flex {
            display: flex;
            align-items: center;
        }

        .justify-end {
            justify-content: flex-end;
        }

        .space-x-4 {
            margin-right: 1rem;
        }

        .mt-6 {
            margin-top: 1.5rem;
        }

        .mb-5 {
            margin-bottom: 1.25rem;
        }

        .text-lg {
            font-size: 1.125rem;
        }

        .text-white {
            color: white;
        }

        .rounded-md {
            border-radius: 8px;
        }
    </style>
</head>
<body class="text-white">

<div class="container">
    <h2 class="text-3xl font-bold mb-6">Update Admin Data</h2>
    <?php
    if (isset($_SESSION['success'])) {
        echo "<script>
            Swal.fire({
                title: 'Success',
                text: '" . $_SESSION['success'] . "',
                icon: 'success',
                timer: 1000, 
                showConfirmButton: false
            });
        </script>";
        unset($_SESSION['success']);
    } else if (isset($_SESSION['error'])) {
        echo "<script>
            Swal.fire({
                title: 'Error',
                text: '" . $_SESSION['error'] . "',
                icon: 'error',
                timer: 1000, 
                showConfirmButton: false
            });
        </script>";
        unset($_SESSION['error']);
    }
    ?>

    <form action="../service/auth.php" method="post">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        
        <div class="mb-5">
            <label for="name" class="block text-lg font-medium mb-2">Name</label>
            <input type="text" name="name" id="name" class="input-field" placeholder="Enter Name" value="<?php echo $name; ?>">
        </div>
        
        <div class="mb-5">
            <label for="email" class="block text-lg font-medium mb-2">Email</label>
            <input type="email" name="email" id="email" class="input-field" placeholder="Enter Email" value="<?php echo $email; ?>">
        </div>
        
        <div class="mb-5">
            <label for="phone" class="block text-lg font-medium mb-2">Phone</label>
            <input type="text" name="phone" id="phone" class="input-field" placeholder="Enter Phone Number" value="<?php echo $phone; ?>">
        </div>

        <div class="mb-5">
            <label for="password" class="block text-lg font-medium mb-2">Password</label>
            <input type="password" name="password" id="password" class="input-field" placeholder="Leave blank to keep current password">
        </div>
        
        <div class="mb-5">
            <label for="cpassword" class="block text-lg font-medium mb-2">Confirm Password</label>
            <input type="password" name="cpassword" id="cpassword" class="input-field" placeholder="Confirm New Password">
        </div>
        
        <div class="flex justify-end space-x-4 mt-6">
            <button type="submit" name="type" value="edit" class="btn btn-success">Submit</button>
            <a href="./acc.php" class="btn btn-error">Cancel</a>
            <input type="reset" class="btn btn-info" value="Reset">

        </div>
    </form>
</div>

</body>
</html>
