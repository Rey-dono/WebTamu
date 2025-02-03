<?php
session_start();
  ?>


<!DOCTYPE html>
<html lang="en" class="font-ubuntu" >
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <script src="https://cdn.tailwindcss.com"></script>
        <link href="https://cdn.jsdelivr.net/npm/flowbite@3.0.0/dist/flowbite.min.css" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.23/dist/full.min.css" rel="stylesheet" type="text/css" />
        
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.15.10/dist/sweetalert2.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.15.10/dist/sweetalert2.all.min.js"></script>
        <title>Document</title>
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
      <input type="text" id="searchInput" class="block w-full p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search...">
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
          <a href="./home.php"  class="block py-2 px-3 text-gray-900 rounded-sm hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 md:dark:hover:text-blue-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">Event's List</a>
        </li>
        <li>
          <a href="#" class="block py-2 px-3 text-white bg-blue-700 rounded-sm md:bg-transparent md:text-blue-700 md:p-0 md:dark:text-blue-500" aria-current="page">Admin Account's</a>
        </li>
        
      </ul>
    </div>
  </div>
</nav>
        <div class="mx-14 mt-20">
        <h1 class="text-[3rem] mb-7">List of Admin's</h1>
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

        <a class="text-[2rem] hover:text-sky-600" role="button" href="./post-acc.php">Add Account +</a>
   <table class="mt-3 w-[100%]">
        <thead>
            <tr class="text-[1.3rem]">
                <th class="p-3">id</th>
                <th class="p-3">username</th>
                <th class="p-3">Email</th>
                <th class="p-3">Phone</th>
                <th class="p-3">Created_At</th>
                <th class="p-3">Updated_At</th>
                <th class="p-3">Action</th>
            </tr>
        </thead>
        
        <?php 
include("../service/connection.php");
$sql = "SELECT * FROM admin";
$result = $conn->query($sql);

if (!$result) {
    die("invalid" . $conn->error);
}

while ($row = $result->fetch_assoc()) {
    echo"
    <tr class='text-center'>
        <td class='border-t-2 border-white'>$row[id]</td>
        <td class='border-t-2 border-white'>$row[username]</td>
        <td class='border-t-2 border-white'>$row[email]</td>
        <td class='border-t-2 border-white'>$row[phone]</td>
        <td class='border-t-2 border-white'>$row[created_at]</td>
        <td class='border-t-2 border-white'>$row[updated_at]</td>
        <td class='border-t-2 border-white'>
            <a class='btn btn-outline btn-info m-3' href='edit-acc.php?id=$row[id]'>Edit</a>
            <!-- You can open the modal using ID.showModal() method -->
            <button class='btn btn-outline btn-error m-3' onclick='my_modal_3.showModal()'>Delete</button>
            <dialog id='my_modal_3' class='modal 0'>
            <div class='modal-box '>
                <form method='dialog'>
                <button class='btn btn-sm btn-circle btn-ghost absolute right-2 top-2'>✕</button>
                </form>
                <h3 class='text-lg font-bold'>Peringatan!</h3>
                <p class='py-4'>Data yang dihapus tidak dapat dikembalikan lagi. Apa kamu yakin untuk menghapus data ini?</p>
                <a class='btn btn-outline btn-error' name='del_acc' href='../service/auth.php?id=$row[id]'>ya</a>
            </div>
            </dialog>
            </td>
    </tr>
        ";
    }
    ?>
    </table>

    </div>
</body>
</html>