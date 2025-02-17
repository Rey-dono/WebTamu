<?php 
session_start(); 
if (isset($_SESSION['username']) == false) {
    header("location: index.php");
exit();
}
?>
<!DOCTYPE html>
<html lang="en" class="font-ubuntu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.0.0/dist/flowbite.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.23/dist/full.min.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.15.10/dist/sweetalert2.all.min.js"></script>
</head>
<body class="bg-[rgb(174,143,114)] text-white h-[100vh]">

<nav class="bg-[#841922] p-4 shadow-md">
    <div class="max-w-screen-xl mx-auto flex justify-between items-center"> 
        <li>
            <a href="./acc.php" class="flex items-center space-x-4">Admin Account's</a>
        </li>
        <a href="https://flowbite.com/" class="flex items-center space-x-3">
            <img src="https://flowbite.com/docs/images/logo.svg" class="h-8" alt="Flowbite Logo" />
            <span class="text-2xl font-semibold text-white">Admin Panel</span>
        </a>
        <div class="flex items-center space-x-4">
            <input value="<?= isset($_GET['search']) ? $_GET['search'] : '' ?>" type="text" id="searchInput" class="p-2 rounded-md bg-gray-700 text-white border border-gray-600" placeholder="Search...">
            <a href="./create_event.php" class="btn btn-outline btn-primary">Add New Event +</a>
        </div>
    </div>
</nav>

<main class="container mx-auto p-6">
    <h1 class="text-4xl font-bold text-white text-center mb-8">Available Events</h1>
    
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

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <?php 
        include("../service/connection.php");

        $records_per_page = 5;
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $offset = ($page - 1) * $records_per_page;

        // Handle search term
        $search = isset($_GET['search']) ? $_GET['search'] : '';

        // Handle sorting
        $sort_column = isset($_GET['sort']) ? $_GET['sort'] : 'id'; // Default to 'id'
        $sort_order = isset($_GET['order']) && $_GET['order'] == 'asc' ? 'ASC' : 'DESC'; // Default to descending order

        // Modify the query to include search and sorting
        $sql =  "SELECT *
        FROM events
        WHERE (name LIKE '%$search%' OR instansi LIKE '%$search%')
        ORDER BY $sort_column $sort_order
        LIMIT $offset, $records_per_page
        ";

        // echo $sql;
        $query = $conn->query($sql);

        // Count total records
        $total_records_query = "SELECT COUNT(*) AS total
            FROM events
            WHERE name LIKE '%$search%';
            ";
        $total_records_result = $conn->query($total_records_query);
        $total_records = $total_records_result->fetch_assoc()['total'];
        $total_pages = ceil($total_records / $records_per_page);
        
        while ($row = $query->fetch_assoc()) {
        ?>
            <div class="bg-[#841922] p-4 rounded-lg shadow-lg transition-transform hover:scale-105">
                <h3 class="text-xl font-semibold"><?= $row['name'] ?></h3>
                <p class="text-sm text-gray-400">Instansi: <?= $row['instansi'] ?></p>
                <p class="text-sm text-gray-400">Start: <?= $row['waktu_mulai'] ?></p>
                <p class="text-sm text-gray-400">End: <?= $row['waktu_berakhir'] ?></p>

                <div class="flex justify-between mt-4">
                    <a href='main.php?id=<?= $row["id"] ?>' class="btn btn-outline btn-info">Details</a>
                    <button class="btn btn-outline btn-error" onclick="document.getElementById('my_modal_3_<?=$row['id']?>').showModal()">Delete</button>
                </div>
            </div>
            <dialog id='my_modal_3_<?=$row['id']?>' class='modal'>
            <div class='modal-box'>
    <form method='dialog'>
        <button class='btn btn-sm btn-circle absolute right-2 top-2'>✕</button>
    </form>
    <h3 class='font-bold text-color-black'>Warning!</h3>
    <p class='py-4 text-black'>Deleting this event will affect related reports. Are you sure you want to delete it?</p>
    <a class='btn btn-outline btn-error' href='../service/auth.php?id=<?=$row['id']?>&value=del_e'>Ya</a>
</div>

            </dialog>
            
        <?php
        }
        ?>
    </div>

</main>

<script src="https://cdn.tailwindcss.com"></script>
<script>
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
