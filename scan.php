<?php session_start();

if (isset($_SESSION['error'])) {
  echo $_SESSION['error'];
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Barcode scan</title>
  <style>
    body,
    html {
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


    .scanner {
      display: flex;
      width: 100%;
      position: absolute;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      height: 100%;
      z-index: 1;
      padding-bottom: 70px;
      margin: 70px;
    }

    #preview {
      border: 5px solid #000;
      border-radius: 10px;
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.5);
    }
  </style>

  <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.15.10/dist/sweetalert2.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.15.10/dist/sweetalert2.all.min.js"></script>
  <script type="text/javascript" src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
</head>

<body>
  <!-- background video -->
  <video class="video-background" autoplay muted loop>
    <source src="./assets/kamera.mp4" type="video/mp4">
  </video>

  <!-- cam scanner. please turn on your webcam to use this -->
  <div class="scanner">
    <video id="preview" width="35%"></video>
  </div>

  <!-- form to submit the scanned data -->
  <form action="service/insert1.php" method="post" class="form-horizontal" style="display: none;">
    <label>SCAN QR CODE</label>
    <input type="text" name="data" id="text" readonly="" placeholder="scan qrcode" class="form-control">
  </form>

  <?php
  if (isset($_SESSION['success'])) {
    echo "<script>
        Swal.fire({
            title: 'Success',
            text: '" . $_SESSION['success'] . "',
            icon: 'success',
            timer: 1000, // 2 seconds
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
            timer: 1000, // 2 seconds
            showConfirmButton: false
        });
    </script>";
    unset($_SESSION['error']);
  }
  ?>


  <script type="text/javascript">
    // create a scanner
    let scanner = new Instascan.Scanner({
      video: document.getElementById('preview')
    });
    scanner.addListener('scan', function(content) {
      document.getElementById('text').value = content;
    });

    // start the scanner
    Instascan.Camera.getCameras().then(function(cameras) {
      if (cameras.length > 0) {
        scanner.start(cameras[0]);
      } else {
        console.error('No cameras found.');
      }
    }).catch(function(e) {
      console.error(e);
    });

    // submit the form when a scan is done
    scanner.addListener('scan', function(c) {
      document.getElementById('text').value = c;
      document.forms[0].submit();

    });
  </script>
</body>

</html>