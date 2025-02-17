<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.15.10/dist/sweetalert2.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.15.10/dist/sweetalert2.all.min.js"></script>
    <title>Selamat Datang</title>
    <style>
        body, html {
            margin: 0;
            padding: 0;
            height: 100%;
            overflow: hidden;
        }

        .video-background {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            /* z-index: 1; */
        }

        .content {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;
            position: relative;
            transform: translateY(25%); /* Sedikit geser ke bawah */
        }


        .pixel-button {
            font-family: "Press Start 2P", serif;
            font-size: 30px;
            background-color: #ffcc00;
            color: #000;
            border: 4px solid #000;
            padding: 10px 20px;
            text-transform: upppercase;
            cursor: pointer;
            box-shadow: 0 5px #b8860b;
            transition: transform 0.2s, box-shadow 0.2s;
            border-radius: 40px;
            text-decoration: none;
            z-index: 1;

        }

        .pixel-button:active {
            transform: translateY(5px);
            box-shadow: 0 2px #b8860b;
        }

        .pixel-button:hover {
            background-color: #ffda3c;
        }
    </style>
</head>
<body>
    <video class="video-background" autoplay muted loop>
        <source src="./assets/kuning.mp4" type="video/mp4">
    </video>

    <?php
    session_start();
                if(isset($_SESSION['success'])){
                    echo "<script>Swal.fire('Success', '".$_SESSION['success']."', 'success');</script>";
                    unset($_SESSION['success']);
                } else if(isset($_SESSION['error'])){
                    echo "<script>Swal.fire('Error', '".$_SESSION['error']."', 'error');</script>";
                    unset($_SESSION['error']);
                }
                ?>

    <div class="content">    
        <div class="button-container">
            <a href="scan.php" class="pixel-button">scan</a>
            <a href="formulir.php" class="pixel-button">Formulir</a>
        </div>
    </div>
</body>
</html>
