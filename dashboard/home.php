<?php session_start();
if (isset($_SESSION['id'])) {
    unset($_SESSION['id']);
}
?>
<!DOCTYPE html >
<html lang="en" class="font-ubuntu" >
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.23/dist/full.min.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.15.10/dist/sweetalert2.all.min.js"></script>


</head>
<body class="bg-slate-900 text-white h-[100vh]">

<nav class="bg-white border-gray-200 dark:bg-gray-900">
  <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
  <a href="https://flowbite.com/" class="flex items-center space-x-3 rtl:space-x-reverse">
      <img src="https://flowbite.com/docs/images/logo.svg" class="h-8" alt="Flowbite Logo" />
      <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">Flowbite</span>
  </a>
  <div class="flex md:order-2">
    <button type="button" data-collapse-toggle="navbar-search" aria-controls="navbar-search" aria-expanded="false" class="md:hidden text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-2.5 me-1">
      <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
      </svg>
      <span class="sr-only">Search</span>
    </button>
    <div class="relative hidden md:block">
      <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
        </svg>
        <span class="sr-only">Search icon</span>
      </div>
      <input  value="<?= isset($_GET['search']) ? $_GET['search'] : '' ?>" type="text" id="searchInput" class="block w-full p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search...">
    </div>
    <button data-collapse-toggle="navbar-search" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="navbar-search" aria-expanded="false">
        <span class="sr-only">Open main menu</span>
        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
        </svg>
    </button>
  </div>
    <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-search">
      <div class="relative mt-3 md:hidden">
        <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
          <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
          </svg>
        </div>
        <input type="text" id="search-navbar" class="block w-full p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search...">
      </div>
      <ul class="flex flex-col p-4 md:p-0 mt-4 font-medium border border-gray-100 rounded-lg bg-gray-50 md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
        <li>
          <a href="#" class="block py-2 px-3 text-white bg-blue-700 rounded-sm md:bg-transparent md:text-blue-700 md:p-0 md:dark:text-blue-500" aria-current="page">Event's List</a>
        </li>
        <li>
          <a href="./acc.php" class="block py-2 px-3 text-gray-900 rounded-sm hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 md:dark:hover:text-blue-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">Admin Account's</a>
        </li>
        
      </ul>
    </div>
  </div>
</nav>

<main class="p-6">
        <h1 class="text-4xl font-bold text-white text-center mb-8">Available Events</h1>
        <a class="text-[2rem] hover:text-sky-600" role="button" href="./create_event.php">Add New Events +</a>

        <table class="mt-3 w-[100%]">
        <thead>
            <tr class="text-[1.3rem]">
                <th onclick="sortTable('id')" class="p-3">Id</th>
                <th onclick="sortTable('name')" class="p-3">Name</th>
                <th onclick="sortTable('instansi')" class="p-3">Instansi</th>
                <th onclick="sortTable('date(start)')" class="p-3">date(start)</th>
                <th onclick="sortTable('date(end)')" class="p-3">Over</th>
                <th class="p-3 w-[20%]">Action</th>
            </tr>
        </thead>
            <tbody>
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
// var_dump($query->fetch_assoc());
while ($row = $query->fetch_assoc()) {

    ?>
    <tr class='text-center'>
    <td class='border-t-2 border-white'><?= $row['id'] ?></td>
    <td class='border-t-2 border-white'><?= $row['name'] ?></td>
    <td class='border-t-2 border-white'><?= $row['instansi'] ?></td>
    <td class='border-t-2 border-white'><?= $row['date(start)'] ?></td>
    <td class='border-t-2 border-white'><?= $row['date(over)'] ?></td>
    <td class='border-t-2 border-white'>
        <a class='btn btn-outline btn-info m-3' href='main.php?id=<?= $row["id"] ?>'>Seen Details</a>
        <a href="deleteevents.php?id=<?= $row['id'] ?>" class="btn btn-outline btn-error m-3" onclick="return confirm('Apakah Anda yakin ingin menghapus event ini?');">Delete</a>
    </td>
</tr>


            <dialog id='my_modal_3' class='modal 0'>
            <div class='modal-box '>
                <form method='dialog'>
                <button class='btn btn-sm btn-circle btn-ghost absolute right-2 top-2'>✕</button>
                </form>
                <h3 class='text-lg font-bold'>Peringatan!</h3>
                <p class='py-4'>Data yang dihapus tidak dapat dikembalikan lagi. Apa kamu yakin untuk menghapus data ini?</p>
                <a class='btn btn-outline btn-error' name='del-e' href='../service/auth.php?=$row["id"]?>'>ya</a>
            </div>
            </dialog>
            </td>
    </tr>
    <?php
    }
    ?>
            </tbody>
        </table>

        <div class="flex justify-center mt-5 gap-4">
    <a href="?page=<?= $page - 1 ?>&search=<?= $search ?>&sort=<?= $sort_column ?>&order=<?= $sort_order ?>" class="<?= $page <= 1 ? 'hidden' : 'btn btn-outline btn-primary' ?>">Previous</a>
    <?php for ($i = 1; $i <= $total_pages; $i++): ?>
        <a href="?page=<?= $i ?>&search=<?= $search ?>&sort=<?= $sort_column ?>&order=<?= $sort_order ?>" 
           class="btn <?= $i === $page ? 'btn-primary' : 'btn-outline' ?>">
            <?= $i ?>
        </a>
    <?php endfor; ?>
    <a href="?page=<?= $page + 1 ?>&search=<?= $search ?>&sort=<?= $sort_column ?>&order=<?= $sort_order ?>" class="<?= $page >= $total_pages ? 'hidden' : 'btn btn-outline btn-primary' ?>">Next</a>
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