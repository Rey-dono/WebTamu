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
                border-bottom-left-radius: 50% 20%;
                border-bottom-right-radius: 50% 20%;
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
            
/* Pagination container */
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

/* Pagination link hover and active states */
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

/* Disabled pagination link */
.pagination a.disabled {
    pointer-events: none;
    color: #7f8c8d;
    background-color: #95a5a6;
    border-color: #95a5a6;
}
        </style>
    </head>
    <body class="bg-gradient-to-r from-blue-500 to-purple-500 min-h-screen flex flex-col items-center overflow-x-hidden">
        <nav class="bg-gradient-to-r from-purple-800 to-indigo-800 w-full fixed top-0 left-0 right-0 z-10 shadow-lg">
            <div class="max-w-4xl mx-auto px-4 py-2 flex justify-between items-center">
                <h1 class="text-2xl font-bold text-white neon-text">Guest Book Admin</h1>
                <div class="relative">
                    <input type="text" placeholder="Search" class="pl-10 pr-4 py-2 rounded-full shadow-md focus:outline-none transition-transform hover-scale">
                    <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-500"></i>
                </div>
                <div class="flex items-center space-x-4">
                    <button class="text-2xl text-white transition-transform hover-scale">
                    </button>
                    <button class="text-2xl text-white transition-transform hover-scale">
                        <i class="fas fa-sign-out-alt"></i>
                    </button>
                </div>
            </div>
        </nav>
        <div class="w-full max-w-4xl mt-[6rem]">
            <div class="bg-white bg-opacity-20 p-6 rounded-lg shadow-lg mb-8 transition-transform hover-scale">
                <h2 class="text-2xl font-bold text-white mb-4 flex items-center">
                    <i class="fas fa-check-circle text-green-500 mr-2"></i>
                    Successful Registrations
                </h2>
                <table class="w-full text-left text-white">
                <thead>
                        <tr>
                            <th class="px-4 py-2">ID</th>
                            <th class="px-4 py-2">Name</th>
                            <th class="px-4 py-2">Date</th>
                            <th class="px-4 py-2">Time</th>
                            <th class="px-4 py-2">Event</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include "../service/connection.php";

                        $records_per_page = 4; // Maximum records per page set to 4
                        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1; // Current page number
                        $offset = ($page - 1) * $records_per_page; // Calculate offset



                        $sql ="SELECT id,nama,date,time,events FROM reports WHERE date(time)=CURDATE() LIMIT $offset, $records_per_page";
                        $query = $conn->query($sql);

                        $total_records_query = "SELECT COUNT(*) AS total FROM reports";
                        $total_records_result = $conn->query($total_records_query);
                        $total_records = $total_records_result->fetch_assoc()['total'];
                        $total_pages = ceil($total_records / $records_per_page);
                        while ($row = $query->fetch_assoc()){
                        ?>

                        <tr class="hover:bg-purple-700 transition-colors">
                            <td class="border-t border-purple-500 px-4 py-2"><?php echo $row['id'];?></td>
                            <td class="border-t border-purple-500 px-4 py-2"><?php echo $row['nama'];?></td>
                            <td class="border-t border-purple-500 px-4 py-2"><?php echo $row['date'];?></td>
                            <td class="border-t border-purple-500 px-4 py-2"><?php echo $row['time'];?></td>
                            <td class="border-t border-purple-500 px-4 py-2"><?php echo $row['events'];?></td>
                        </tr>
                        
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>


            <!-- failed report -->
            <!-- <div class="bg-white bg-opacity-20 p-6 rounded-lg shadow-lg transition-transform hover-scale">
                <h2 class="text-2xl font-bold text-white mb-4 flex items-center">
                    <i class="fas fa-times-circle text-red-500 mr-2"></i>
                    Failed QR Code Scans
                </h2>
                <table class="w-full text-left text-white">
                    <thead>
                        <tr>
                            <th class="px-4 py-2">ID</th>
                            <th class="px-4 py-2">Name</th>
                            <th class="px-4 py-2">Email</th>
                            <th class="px-4 py-2">Phone</th>
                            <th class="px-4 py-2">Company</th>
                            <th class="px-4 py-2">Reason</th>
                            <th class="px-4 py-2">Registration Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="hover:bg-purple-700 transition-colors">
                            <td class="border-t border-purple-500 px-4 py-2">1</td>
                            <td class="border-t border-purple-500 px-4 py-2">Michael</td>
                            <td class="border-t border-purple-500 px-4 py-2">michael@gmail.com</td>
                            <td class="border-t border-purple-500 px-4 py-2">321-654-9870</td>
                            <td class="border-t border-purple-500 px-4 py-2">Tech Solutions</td>
                            <td class="border-t border-purple-500 px-4 py-2">QR Code not recognized</td>
                            <td class="border-t border-purple-500 px-4 py-2">2023-10-05</td>
                        </tr>
                    </tbody>
                </table>
            </div> -->


            <!-- pagnation -->
            <div class="pagination">
                <!-- Previous Button -->
                <a href="?page=<?= $page - 1 ?>" class="<?= $page <= 1 ? 'disabled' : '' ?>">Previous</a>

                <!-- Page Number Links -->
                <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                    <a href="?page=<?= $i ?>" <?= $i === $page ? 'class="active"' : '' ?>><?= $i ?></a>
                <?php endfor; ?>

                <!-- Next Button -->
                <a href="?page=<?= $page + 1 ?>" class="<?= $page >= $total_pages ? 'disabled' : '' ?>">Next</a>
            </div>

            <div class="flex justify-center mt-8 space-x-4">
                <button class="glow-button">Generate Report</button>
            </div>
        </div>
        <footer class="bg-gradient-to-r from-purple-800 to-indigo-800 w-full py-4 mt-8 w-[100vw]">
            <div class="max-w-4xl mx-auto px-4 flex justify-between items-center text-white">
                <p>© 2025 Guest Book Admin</p>
            </div>
        </footer>
    </body>
    </html>