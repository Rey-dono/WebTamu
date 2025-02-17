<?php

session_start();
if (isset($_SESSION['username']) == false) {
    header("location: index.php");
exit();
}
if (isset($_SESSION['success'])) {
    echo "<script>Swal.fire('Success', '" . $_SESSION['success'] . "', 'success');</script>";
    unset($_SESSION['success']);
} else if (isset($_SESSION['error'])) {
    echo "<script>Swal.fire('Error', '" . $_SESSION['error'] . "', 'error');</script>";
    unset($_SESSION['error']);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir Event</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.15.10/dist/sweetalert2.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.15.10/dist/sweetalert2.all.min.js"></script>

    <style>
        body {
            background: rgb(174, 143, 114);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 2rem;
        }

        .container {
            width: 100%;
            max-width: 500px;
            background: #841922;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        .form-title {
            font-size: 1.75rem;
            font-weight: bold;
            text-align: center;
            margin-bottom: 1.5rem;
            color: white;
        }

        .form-group {
            margin-bottom: 1rem;
        }

        .form-group label {
            font-weight: bold;
            color: white;
            margin-bottom: 0.5rem;
            display: block;
        }

        .form-group input {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 1rem;
            outline: none;
            transition: all 0.3s ease;
        }

        .form-group input:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 5px rgba(59, 130, 246, 0.5);
        }

        .submit-btn {
            width: 100%;
            padding: 0.75rem;
            background-color: #3b82f6;
            color: white;
            font-size: 1rem;
            font-weight: bold;
            border-radius: 8px;
            transition:  0.3s ease;
            cursor: pointer;
            text-align: center;
        }

        .submit-btn:hover {
            background-color: #2563eb;
        }
    </style>
</head>

<body>

    <div class="container">
        <h1 class="form-title">Buat Akun Baru</h1>
        <form action="../service/auth.php" method="post" id="eventForm">
            
            <div class="form-group">
                <label for="name">Username</label>
                <input type="text" name="username" id="name" required>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" required>
            </div>

            <div class="form-group">
                <label for="phone">No. Telepon</label>
                <input type="number" name="phone" id="phone" required>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" required>
            </div>

            <div class="form-group">
                <label for="cpassword">Konfirmasi Password</label>
                <input type="password" name="cpassword" id="cpassword" required>
            </div>

            <button type="submit" name="type" value="account" class="submit-btn">Buat Akun</button>
        </form>
    </div>

</body>

</html>
