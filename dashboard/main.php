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

        .sidebar {
            height: 100vh;
            width: 250px;
            position: fixed;
            top: 0;
            left: 0;
            background: linear-gradient(45deg, #4f46e5, #9333ea);
            transform: translateX(-100%);
            transition: transform 0.3s ease;
        }

        .sidebar.open {
            transform: translateX(0);
        }

        .glow-button {
            background: linear-gradient(45deg, #ff00ff, #ff00ff);
            border: none;
            border-radius: 50px;
            color: white;
            padding: 10px 20px;
            font-size: 1.2rem;
            cursor: pointer;
            box-shadow: 0 0 20px rgba(255, 0, 255, 0.5), 0 0 30px rgb(1, 119, 209);
            transition: all 0.3s ease;
        }

        .glow-button:hover {
            box-shadow: 0 0 30px rgba(255, 0, 255, 0.7), 0 0 40px rgb(1, 119, 209);
        }

        .pagination {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .pagination a {
            color: #fff;
            padding: 12px 20px;
            margin: 0 5px;
            text-decoration: none;
            font-weight: bold;
            border: 2px solid #fff;
            border-radius: 10px;
            transition: background-color 0.3s, color 0.3s;
        }

        .pagination a:hover {
            background-color: #f39c12;
            color: #fff;
            border-color: #f39c12;
        }

        .pagination a.active {
            background-color: #27ae60;
            color: #fff;
            border-color: #27ae60;
        }

        .pagination a.disabled {
            pointer-events: none;
            color: #7f8c8d;
            background-color: #95a5a6;
            border-color: #95a5a6;
        }
    </style>
    </style>
</head>
<body class="bg-gradient-to-r from-blue-500 to-purple-500 min-h-screen flex flex-col overflow-x-hidden">
    <!-- Navigation Bar -->
    <nav class="bg-gradient-to-r from-purple-800 to-indigo-800 w-full fixed top-0 z-10 shadow-lg">
        <div class="max-w-6xl mx-auto px-6 py-3 flex justify-between items-center relative">
            <button id="hamburger" class="text-white text-2xl focus:outline-none">
                <i class="fas fa-bars"></i>
            </button>
            <h1 class="text-2xl font-bold text-white">Guest Book Admin</h1>
            <!-- Search Form -->
            <form action="#" method="GET" class="flex items-center space-x-2">
                <input type="text" name="search" placeholder="Search..." class="px-4 py-2 rounded-lg text-black focus:outline-none" value="<?= isset($_GET['search']) ? $_GET['search'] : '' ?>">
                <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition-colors">Search</button>
            </form>
        </div>
    </nav>

    <!-- Sidebar -->
    <div id="sidebar" class="sidebar">
        <ul class="mt-16 text-white text-lg">
            <li class="px-4 py-3 hover:bg-indigo-700 transition-colors"><a href="create_event.php">Event</a></li>
            <li class="px-4 py-3 hover:bg-indigo-700 transition-colors"><a href="#">Logout</a></li>
        </ul>
    </div>

    <!-- Main Content -->
    <main class="w-full max-w-6xl mt-[6rem] mx-auto px-6">
        <div class="bg-white bg-opacity-20 p-6 rounded-lg shadow-lg mb-8 transition-transform hover-scale">
            <h2 class="text-2xl font-bold text-white mb-4 flex items-center">
                <i class="fas fa-check-circle text-green-500 mr-2"></i>
                Successful Registrations
            </h2>
            <table class="w-full text-left text-white">
                <thead>
                    <tr class="bg-indigo-800 bg-opacity-75">
                        <th class="px-4 py-2 cursor-pointer" onclick="sortTable('id')">ID</th>
                        <th class="px-4 py-2 cursor-pointer" onclick="sortTable('nama')">Name</th>
                        <th class="px-4 py-2 cursor-pointer" onclick="sortTable('date')">Date</th>
                        <th class="px-4 py-2 cursor-pointer" onclick="sortTable('time')">Time</th>
                        <th class="px-4 py-2 cursor-pointer" onclick="sortTable('events')">Event</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    include "../service/connection.php";

                    $records_per_page = 4;
                    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                    $offset = ($page - 1) * $records_per_page;

                    // Handle search term
                    $search = isset($_GET['search']) ? $_GET['search'] : '';

                    // Handle sorting
                    $sort_column = isset($_GET['sort']) ? $_GET['sort'] : 'id'; // Default to 'id'
                    $sort_order = isset($_GET['order']) && $_GET['order'] == 'asc' ? 'ASC' : 'DESC'; // Default to descending order

                    // Modify the query to include search and sorting
                    $sql = "SELECT id, nama, date, time, events FROM reports WHERE date(time) = CURDATE() AND (nama LIKE '%$search%' OR events LIKE '%$search%') ORDER BY $sort_column $sort_order LIMIT $offset, $records_per_page";
                    $query = $conn->query($sql);

                    // Count total records
                    $total_records_query = "SELECT COUNT(*) AS total FROM reports WHERE nama LIKE '%$search%' OR events LIKE '%$search%'";
                    $total_records_result = $conn->query($total_records_query);
                    $total_records = $total_records_result->fetch_assoc()['total'];
                    $total_pages = ceil($total_records / $records_per_page);

                    while ($row = $query->fetch_assoc()) {
                ?>
                    <tr class="hover:bg-purple-700 transition-colors">
                        <td class="border-t border-purple-500 px-4 py-2"><?php echo $row['id']; ?></td>
                        <td class="border-t border-purple-500 px-4 py-2"><?php echo $row['nama']; ?></td>
                        <td class="border-t border-purple-500 px-4 py-2"><?php echo $row['date']; ?></td>
                        <td class="border-t border-purple-500 px-4 py-2"><?php echo $row['time']; ?></td>
                        <td class="border-t border-purple-500 px-4 py-2"><?php echo $row['events']; ?></td>
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
        <a href="?page=<?= $page - 1 ?>&search=<?= $search ?>&sort=<?= $sort_column ?>&order=<?= $sort_order ?>" class="<?= $page <= 1 ? 'disabled' : '' ?>">Previous</a>
        <?php for ($i = 1; $i <= $total_pages; $i++): ?>
            <a href="?page=<?= $i ?>&search=<?= $search ?>&sort=<?= $sort_column ?>&order=<?= $sort_order ?>" <?= $i === $page ? 'class="active"' : '' ?>><?= $i ?></a>
        <?php endfor; ?>
        <a href="?page=<?= $page + 1 ?>&search=<?= $search ?>&sort=<?= $sort_column ?>&order=<?= $sort_order ?>" class="<?= $page >= $total_pages ? 'disabled' : '' ?>">Next</a>
    </div>

    <div class="flex justify-center mt-8 mb-10 space-x-4">
        <button class="glow-button">Generate Report</button>
    </div>

    <!-- Footer -->
    <footer class="bg-gradient-to-r from-purple-800 to-indigo-800 w-full py-4 mt-auto">
        <div class="max-w-6xl mx-auto px-6 text-center text-white">
            <p>&copy; 2025 Guest Book Admin</p>
        </div>
    </footer>

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