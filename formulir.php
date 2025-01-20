<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir Tamu Undangan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Press Start 2P', cursive;
            margin: 0;
            overflow: hidden;
        }
        .background-video {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: -1;
        }
    </style>
</head>
<body class="flex items-center justify-center min-h-screen">
    <!-- Video Background -->
    <video class="background-video" autoplay loop muted>
        <source src="./assets/video.mp4" type="video/mp4">
        Your browser does not support the video tag.
    </video>

    <!-- Form Container -->
    <div class="bg-gray-300 p-8 rounded-lg shadow-lg relative w-full max-w-lg">
        <div class="absolute -top-10 left-1/2 transform -translate-x-1/2 bg-blue-600 text-yellow-400 px-4 py-2 rounded">
            <h1 class="text-center">Formulir<br>Tamu<br>Undangan</h1>
        </div>
        <form class="space-y-4 mt-12">
            <div>
                <label for="nama" class="block text-black">NAMA LENGKAP</label>
                <input type="text" id="nama" class="w-full p-2 border border-gray-400 rounded" placeholder="Masukkan nama lengkap">
            </div>
            <div>
                <label for="event" class="block text-black">EVENT</label>
                <select id="event" class="w-full p-2 border border-gray-400 rounded">
                    <option>Pilih event</option>
                    <option>Pameran SMKN 71</option>
                    <option>JobFair</option>
                    <option>EduFair</option>
                </select>
            </div>
            <div>
                <label for="telepon" class="block text-black">NOMOR TELEPON</label>
                <input type="text" id="telepon" class="w-full p-2 border border-gray-400 rounded" placeholder="Masukkan nomor telepon">
            </div>
            <div>
                <label for="token" class="block text-black">TOKEN</label>
                <input type="text" id="token" class="w-full p-2 border border-gray-400 rounded" placeholder="Masukkan token">
            </div>
            <button type="submit" class="w-full bg-yellow-400 text-black py-2 rounded">KIRIM</button>
        </form>
    </div>
</body>
</html>
