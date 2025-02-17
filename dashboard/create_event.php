<?php
session_start();

if (isset($_SESSION['username']) == false) {
    header("location: index.php");
    exit();
}

if (isset($_SESSION['success'])) {
    echo "<script>
        Swal.fire({
            title: 'Success',
            text: '" . $_SESSION['success'] . "',
            icon: 'success',
            showConfirmButton: false
        });
    </script>";
} else if (isset($_SESSION['error'])) {
    echo "<script>
        Swal.fire({
            title: 'Error',
            text: '" . $_SESSION['error'] . "',
            icon: 'error',
            showConfirmButton: false
        });
    </script>";
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
            background-color: rgb(174, 143, 114); /* Background hitam */
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            color: white;
            font-family: Arial, sans-serif;
            font-size: 20px;
        }
        nav {
            background: #841922; /* Darker background for the navbar */
            width: 100%;
            position: fixed;
            top: 0;
            z-index: 10;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 1rem;
        }
        nav h1 {
            color: #fefefe; /* White text color for the navbar */
        }
        main {
            margin-top: 170px; /* Tambahkan jarak top untuk menghindari tumpang tindih dengan navbar */
            width: 80%; /* Lebar form lebih lebar agar lebih nyaman di desktop */
            max-width: 1000px;
            margin-left: auto;
            margin-right: auto;
            padding-left: 2rem;
            padding-right: 2rem;
        }
        form {
            background-color: rgb(139, 56, 63); /* Dark background for the form */
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            margin-bottom: 50px; /* Menambahkan jarak bawah pada form */
        }
        input, select, button {
            background-color:  rgba(0, 0, 0, 0.3);  /* Background putih untuk input */
            border: 1px solid #555; /* Border sedikit lebih terang */
            color: #333; /* Teks input berwarna gelap (item) */
            padding: 0.75rem;
            border-radius: 8px;
            width: 100%;
            height: 4rem;
            font-size: 1rem;
            padding-left: 20px; /* Menambahkan jarak kiri pada input */
        }
        input::placeholder, select::placeholder {
            color: #fff; /* Placeholder dengan warna lebih terang */
            padding-left: 20px;
        }
        button {
            background-color: #00BFFF; /* Button dengan warna biru terang */
            border: none;
            cursor: pointer;
            transition: background-color 0.3s ease;
            height: 4rem;
        }
        button:hover {
            background-color: #1e90ff; /* Biru lebih gelap saat hover */
        }
        h1 {
            font-size: 2rem;
            color: white;
        }
        .mb-4 {
            margin-bottom: 1.5rem;
        }
        label {
            font-weight: bold;
        }
    </style>
</head>
<body>

    <nav>
        <div class="max-w-6xl mx-auto px-6 py-3 flex justify-between items-center relative">
            <h1 class="text-2xl font-bold text-white">Formulir Event</h1>
        </div>
    </nav>

    <main>

        <form action="../service/auth.php" method="post" id="eventForm" class="p-6 rounded-lg shadow-md">
            <h1 class="text-4xl font-bold  text-center mb-8">Tambah Event Baru</h1>
            <div class="mb-4">
                <label for="name" class="block text-black-700 font-bold mb-2">Nama:</label>
                <input type="text" name="name" id="name" required placeholder="Masukkan nama event">
            </div>
            
            <div class="mb-4">
                <label for="instansi" class="block text-white-700 font-bold mb-2">Instansi:</label>
                <input type="text" name="instansi" id="instansi" required placeholder="Masukkan nama instansi">
            </div>

            <div class="mb-4">
                <label for="start" class="block text-white-700 font-bold mb-2">Tanggal Mulai:</label>
                <input type="date" name="start" id="start" required placeholder="masukkan tanggal acara">
            </div>

            <div class="mb-4">
                <label for="over" class="block text-white-700 font-bold mb-2">Tanggal Selesai:</label>
                <input type="date" name="over" id="over" required placeholder="masukkan tanggal selesai acara">
            </div>

            <button type="submit" name="type" value="event" class="bg-blue-500 text-white px-4 py-2 rounded-lg">Tambahkan Event</button>
        </form>

    </main>

</body>
</html>