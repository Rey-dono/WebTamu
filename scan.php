<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barcode scan</title>
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
        .scanner{
            z-index: 1;
        }
    </style>
    
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.15.10/dist/sweetalert2.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.15.10/dist/sweetalert2.all.min.js"></script>
    <script type="text/javascript" src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
</head>
<body>
    <video class="video-background" autoplay muted loop>
        <source src="./assets/scann.mp4" type="video/mp4">
    </video>
    <div class="scanner">
        <video id="preview" width="45%"></video>
            <?php
                if(isset($_SESSION['error'])){
                    echo"
                    <div class='alert alert-danger'>
                    <h4>ERROR!</h4>
                    ".$_SESSION['error']."
                    </div>
                    ";
                }

                if(isset($_SESSION['success'])){
                    echo"
                    <div class='alert alert-success' >
                    <h4>SUCCESS!</h4>
                    ".$_SESSION['success']."
                    </div>
                    ";
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
        //
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

      scanner.addListener('scan',function(c){
        document.getElementById('text').value=c;
        document.forms[0].submit();

      });
    </script>
</body>
</html>
