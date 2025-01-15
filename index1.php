<?php session_start();?>
<html>
<head>
    <title>Instascan</title>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/webrtc.adapter/3.3.3/adapter.min.js"></script>
    <!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.1.10/vue.min.js"></script> -->
    <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
    <script type="text/javascript" src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
     <!-- <script type="text/javascript" src="assets/js/instascan.min.js"></script> -->
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.js"> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <video id="preview" width="100%"></video>
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
            <div class="col-md-6">
                <form action="insert1.php" method="post" class="form-horizontal">
                <label>SCAN QR CODE</label>
                <input type="text" name="text" id="text" readonly="" placeholder="scan qrcode" class="form-control">
                </form> 
                 <table class= "table table-bordered">
                    <thead>
                        <tr>
                            <td>id</td>
                            <td>nama</td>
                            <td>date</td>
                            <td>time</td>
                            <td>events</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include "./service/connection.php";

                        $sql ="SELECT id,nama,date,time,events FROM reports WHERE date(time)=CURDATE()";
                        $query = $conn->query($sql);
                        while ($row = $query->fetch_assoc()){
                        ?>

                        <tr>
                            <td><?php echo $row['id'];?></td>
                            <td><?php echo $row['nama'];?></td>
                            <td><?php echo $row['date'];?></td>
                            <td><?php echo $row['time'];?></td>
                            <td><?php echo $row['events'];?></td>
                        </tr>
                        
                        <?php
                        }
                        ?>
                    </tbody>
                 </table>
            </div>
        </div>
    </div>

    <!-- <script type="text/javascript">
        let scanner = new Instascan.Scanner({ video: document.getElementById('preview')});
        Instascan.Camera.getCameras().then(function(cameras){
            if(cameras.length > 0){
                scanner.start(cameras[0]);
            } else{
                alert('No cameras found');
            }

        }) .catch(function(e) {
            console.error(e);
        });

        scanner.addListener('scan', (content, image) => {
            console.log(content)
        })
        
    </script> -->

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

