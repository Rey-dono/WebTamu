<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=press+start+2P&display=swap" rel="stylesheet">
    <title>Selamat Datang</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap');
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

        .content {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;
            position: relative;
            transform: translateY(25%);
        }

        .button-container {
            display: flex;
            flex-direction: column;
            gap: 20px;
            align-items: center;
        }

        .pixel-button {
            font-family: "Press Start 2P", serif;
            font-size: 16px;
            background-color: #ffcc00;
            color: #000;
            border: 4px solid #000;
            padding: 10px 20px;
            text-transform: uppercase;
            text-decoration: none;
            cursor: pointer;
            box-shadow: 0 5px #b8860b;
            transition: transform 0.2s, box-shadow 0.2s;
            border-radius: 40px;
        }

        .pixel-button:active {
            transform: translateY(5px);
            box-shadow: 0 2px #b8860b;
        }

        .pixel-button:hover {
            background-color: #ffda3c;
        }

        .button {
            font-family: "Press Start 2P", cursive;
            font-size: 16px;
            background-color: #ffcc00;
            color: #000;
            border: 4px solid #000;
            padding: 10px 20px;
            text-transform: uppercase;
            cursor: pointer;
            box-shadow: 0 5px #b8860b;
            transition: transform 0.2s, box-shadow 0.2s;
            border-radius: 40px;
        }

        .button:active {
            transform: translateY(5px);
            box-shadow: 0 2px #b8860b;
        }

        .button:hover {
            background-color: #ffda3c;
        }
    </style>
</head>
<body>
    <video class="video-background" autoplay muted loop>
        <source src="./assets/landing.mp4" type="video/mp4">
        Your browser does not support the video tag.
    </video>

    <div class="content">    
        <div class="button-container">
            <button class="pixel-button">Formulir</button>
            <a href="scan.php" class="pixel-button">scan</a>
        </div>
    </div>
</body>
</html>
