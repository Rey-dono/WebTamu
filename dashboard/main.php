<?php session_start(); 
if (isset($_SESSION['username']) == false) {
    header("location: index.php");
exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guest Book Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        .transition-transform {
            transition: transform 0.3s ease;
        }

        .hover-scale:hover {
            transform: scale(1.05);
        }

        /* Sidebar dengan latar belakang sesuai palet */
        .sidebar {
            height: 100vh;
            width: 250px;
            position: fixed;
            top: 0;
            left: 0;
            background: #841922; /* Warna latar sidebar */
            transform: translateX(-100%);
            transition: transform 0.3s ease;
        }

        .sidebar.open {
            transform: translateX(0);
        }

        /* Latar belakang utama halaman */
        body {
            background: rgb(174, 143, 114); /* Latar belakang utama pakai warna #841922 */
        }

        /* Tombol glow */
        .glow-button {
            background: #841922; /* Warna gradient tombol */
            border: none;
            border-radius: 50px;
            color: white;
            padding: 10px 20px;
            font-size: 1.2rem;
            cursor: pointer;
            box-shadow: 0 0 20px rgba(108, 108, 108, 0.5), 0 0 30px rgb(100, 100, 100);
            transition: all 0.3s ease;
        }

        .glow-button:hover {
            box-shadow: 0 0 30px rgba(108, 108, 108, 0.7), 0 0 40px rgb(100, 100, 100);
        }

        .pagination {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .pagination a {
            color: #841922;
            padding: 12px 20px;
            margin: 0 5px;
            text-decoration: none;
            font-weight: bold;
            border: 2px solid #fff;
            border-radius: 10px;
            transition: background-color 0.3s, color 0.3s;
        }

        .pagination a:hover {
            background-color: rgb(174, 143, 114); /* Warna hover pagination sesuai palet */
            color: #fff;
            border-color: rgb(174, 143, 114);
        }

        .pagination a.active {
            background-color: #64141b; /* Warna tombol aktif lebih gelap */
            color: #fff;
            border-color: #64141b;
        }

        .pagination a.disabled {
            pointer-events: none;
            color: #7f8c8d;
            background-color: #95a5a6;
            border-color: #95a5a6;
        }

        /* Tabel dengan latar belakang sesuai palet */
        /* Tabel dengan latar belakang #841922 */
table {
    background-color: #841922; /* Latar tabel pakai #841922 */
    color: #fff; /* Teks putih supaya kontras */
    width: 100%;
    border-collapse: collapse; /* Menghilangkan garis ganda antar tabel */
}

table th {
    background-color: #841922; /* Header tabel pakai rgb(174, 143, 114) */
    color: white; /* Teks header tabel tetap putih */
    padding: 12px 15px;
    text-align: left;
}

table td {
    background-color: #841922; /* Isi tabel pakai #841922 */
    border-top: 1px solid #fff; /* Garis pemisah antar baris dengan warna putih */
    padding: 12px 15px;
    text-align: left;
}

table tr:hover {
    background-color: #64141b; /* Warna hover baris tabel lebih gelap */
}

table th, table td {
    /* border: 1px solid #fff; Border putih di setiap sel tabel */
}

    </style>
</head>

<body class="min-h-screen flex flex-col overflow-x-hidden">


    <!-- Sidebar -->
    <div id="sidebar" class="sidebar">
        <ul class="mt-16 text-white text-lg">
            <li class="px-4 py-3 hover:bg-#841922-700 transition-colors"><a href="create_event.php">Event</a></li>
            <li class="px-4 py-3 hover:bg-#841922-700 transition-colors"><a href="logout.php">Logout</a></li>
        </ul>
    </div>

    <!-- Main Content -->
    <main class="w-full max-w-6xl mt-[6rem] mx-auto px-6">
        <div class="bg-gray-800 bg-opacity-50 p-6 rounded-lg shadow-lg mb-8 transition-transform hover-scale">
            <h2 class="text-2xl font-bold text-white mb-4 flex items-center">
                <i class="fas fa-check-circle text-green-500 mr-2"></i>
                Successful Registrations
            </h2>
            <table class="w-full text-left text-white">
                <thead>
                    <tr class="bg-gray-700">
                        <th class="px-4 py-2 cursor-pointer" onclick="sortTable('id')">ID</th>
                        <th class="px-4 py-2 cursor-pointer" onclick="sortTable('nama')">Name</th>
                        <th class="px-4 py-2 cursor-pointer" onclick="sortTable('lvl')">Level</th>
                        <th class="px-4 py-2 cursor-pointer" onclick="sortTable('date')">Date</th>
                        <th class="px-4 py-2 cursor-pointer" onclick="sortTable('time')">Time</th>
                        <th class="px-4 py-2 cursor-pointer" onclick="sortTable('events')">Event</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include "../service/connection.php";

                    // Get event ID from URL
                    if (!isset($_SESSION['id'])) {
                        $_SESSION['id'] = intval($_GET['id']);
                    } else if($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
                        $_SESSION['id'] = intval($_GET['id']);
                    }

                    $id = $_SESSION['id'];

                    // Handle pagination
                    $records_per_page = 5;
                    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                    $offset = ($page - 1) * $records_per_page;

                    // Handle search term
                    $search = isset($_GET['search']) ? $_GET['search'] : '';

                    // Handle sorting
                    $sort_column = isset($_GET['sort']) ? $_GET['sort'] : 'id';
                    $sort_order = isset($_GET['order']) && $_GET['order'] == 'asc' ? 'ASC' : 'DESC';

                    $sql =  "SELECT r.id, t.nama AS nama, t.level AS lvl, r.date, r.time, e.name AS events
                    FROM reports r
                    JOIN tamu t ON r.fid_tamu = t.id
                    JOIN events e ON r.events_fid = e.id
                    WHERE r.events_fid = $id
                    AND (t.nama LIKE '%$search%' OR e.name LIKE '%$search%')
                    ORDER BY $sort_column $sort_order
                    LIMIT $offset, $records_per_page
 ";
                    $query = $conn->query($sql);

                    // Count total records
                    $total_records_query = "SELECT COUNT(*) AS total
                        FROM reports r
                        JOIN events e ON r.events_fid = e.id
                        WHERE e.name LIKE '%$search%';
                        ";
                    $total_records_result = $conn->query($total_records_query);
                    $total_records = $total_records_result->fetch_assoc()['total'];
                    $total_pages = ceil($total_records / $records_per_page);
                    while ($row = $query->fetch_assoc()) {
                    ?>
                        <tr class="hover:bg-gray-700 transition-colors">
                            <td class="border-t border-gray-600 px-4 py-2"><?php echo $row['id']; ?></td>
                            <td class="border-t border-gray-600 px-4 py-2"><?php echo $row['nama']; ?></td>
                            <td class="border-t border-gray-600 px-4 py-2"><?php echo $row['lvl']; ?></td>
                            <td class="border-t border-gray-600 px-4 py-2"><?php echo $row['date']; ?></td>
                            <td class="border-t border-gray-600 px-4 py-2"><?php echo $row['time']; ?></td>
                            <td class="border-t border-gray-600 px-4 py-2"><?php echo $row['events']; ?></td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </main>

    <!-- Pagination -->
    <div class="pagination">
        <a href="?id=<?=$id?>&page=<?= $page - 1 ?>&search=<?= $search ?>&sort=<?= $sort_column ?>&order=<?= $sort_order ?>" class="<?= $page <= 1 ? 'disabled' : '' ?>">Previous</a>
        <?php for ($i = 1; $i <= $total_pages; $i++): ?>
            <a href="?page=<?= $i ?>&search=<?= $search ?>&sort=<?= $sort_column ?>&order=<?= $sort_order ?>" <?= $i === $page ? 'class="active"' : '' ?>><?= $i ?></a>
        <?php endfor; ?>
        <a href="?id=<?=$id?>&page=<?= $page + 1 ?>&search=<?= $search ?>&sort=<?= $sort_column ?>&order=<?= $sort_order ?>" class="<?= $page >= $total_pages ? 'disabled' : '' ?>">Next</a>
    </div>

    <div class="flex justify-center mt-8 mb-10 space-x-4">
        <button onclick="location.href = 'pdf.php'" class="glow-button">Generate Report</button>
    </div>

    <script>
        const hamburger = document.getElementById('hamburger');
        const sidebar = document.getElementById('sidebar');

        hamburger.addEventListener('click', () => {
            sidebar.classList.toggle('open');
        });

        // Sorting function
        function sortTable(column) {
            const currentUrl = new URL(window.location.href);
            const currentSort = currentUrl.searchParams.get('sort');
            const currentOrder = currentUrl.searchParams.get('order') === 'asc' ? 'desc' : 'asc';

            currentUrl.searchParams.set('sort', column);
            currentUrl.searchParams.set('order', currentOrder);

            window.location.href = currentUrl.toString();
        }
    </script>
</body>
</html>
