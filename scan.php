<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barcode Scan</title>
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
            z-index: -1;
        }

        .scanner {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100%;
            z-index: 1;
            padding-bottom: 20px;
            margin: 20px;
        }

        #preview {
            border: 5px solid #000;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.5);
        }

        .alert {
            margin-top: 20px;
            padding: 15px;
            width: 80%;
            max-width: 400px;
            text-align: center;
            border: 1px solid #000;
            border-radius: 5px;
            background-color: #f8d7da;
            color: #721c24;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
        }
    </style>

    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.15.10/dist/sweetalert2.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.15.10/dist/sweetalert2.all.min.js"></script>
    <script type="text/javascript" src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
</head>
<body>
    <video class="video-background" autoplay muted loop>
        <source src="./assets/barcode.mp4" type="video/mp4">
    </video>

    <div class="scanner">
        <video id="preview" width="45%"></video>
        <?php
            if(isset($_SESSION['error'])){
                echo"<div class='alert'>
                <h4>ERROR!</h4>
                ".$_SESSION['error']."</div>";
            }

            if(isset($_SESSION['success'])){
                echo"<div class='alert alert-success'>
                <h4>SUCCESS!</h4>
                ".$_SESSION['success']."</div>";
            }
        ?>
    </div>

    <form action="insert1.php" method="post" class="form-horizontal" style="display: none;">
        <label>SCAN QR CODE</label>
        <input type="text" name="text" id="text" readonly="" placeholder="scan qrcode" class="form-control">
    </form>

    <script type="text/javascript">
        let scanner = new Instascan.Scanner({ video: document.getElementById('preview') });
        scanner.addListener('scan', function (content) {
            document.getElementById('text').value = content;
            document.forms[0].submit();
        });

        Instascan.Camera.getCameras().then(function (cameras) {
            if (cameras.length > 0) {
                scanner.start(cameras[0]);
            } else {
                console.error('No cameras found.');
            }
        }).catch(function (e) {
            console.error(e);
        });
    </script>
</body>
</html>
