<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en" class="font-ubuntu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.23/dist/full.min.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.0.0/dist/flowbite.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.15.10/dist/sweetalert2.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.15.10/dist/sweetalert2.all.min.js"></script>
    <title>Admin Dashboard</title>
    <style>
        /* Tambahkan sedikit styling untuk body */
        body {
  margin: 0;
  padding: 0;
  background-color: rgb(174, 143, 114);
}

html, body {
  height: 100%;


        }
        .container {
  min-height: 100vh;
  overflow: hidden;
  box-sizing: border-box;

        }
        .navbar {
            background-color: #841922;
        }
        .navbar a, .navbar button {
            color: #fff;
        }
        .navbar .navbar-link:hover {
            background-color: #64141b;
        }
        .table-container {
            max-width: 1200px;
            margin: 3rem auto;
            padding: 1rem;
            background-color: #841922;
            border-radius: 8px;
        }
        .table-header {
            background-color: #4A5568;
            color: white;
        }
        .table-header th {
            padding: 0.75rem 1.25rem;
            font-size: 1.2rem;
            text-align: left;
        }
        .table-body td {
            color: white;  /* Mengubah warna teks menjadi putih */
            padding: 1rem;
            text-align: left;
            border-top: 1px solid #4A5568;
        }
        .table-body tr:hover {
            background-color: #4A5568;
        }
        .action-btns button {
            padding: 0.5rem 1rem;
            margin: 0.25rem;
            border-radius: 8px;
            font-size: 1rem;
            cursor: pointer;
        }
        .action-btns .btn-edit {
            background-color: #4CAF50;
            color: white;
        }
        .action-btns .btn-edit:hover {
            background-color: #388E3C;
        }
        .action-btns .btn-delete {
            background-color: #F44336;
            color: white;
        }
        .action-btns .btn-delete:hover {
            background-color: #D32F2F;
        }
        <style>
    /* Modify navbar to align the title to the left */
    .navbar {
        background-color: #841922;
        display: flex;
        justify-content: flex-start; /* Align to the left */
        padding: 1rem;
    }

    .navbar a, .navbar button {
        color: #fff;
    }

    .navbar .navbar-link:hover {
        background-color: #64141b;
    }
</style>

<nav class="navbar">
    <div class="flex items-center">
        <a href="home.php" class="text-3xl font-bold">Admin Dashboard</a>
    </div>
    <div class="flex items-center space-x-7 ml-auto">
        <a href="./home.php" class="navbar-link">Event's List</a>
        <button class="navbar-link" onclick="window.location.href = '../service/logout.php'">Logout</button>
    </div>
</nav>


    <!-- Success/Error Alert -->
    <?php if (isset($_SESSION['success'])) { ?>
        <script>
            Swal.fire({
                title: 'Success',
                text: '<?= $_SESSION['success'] ?>',
                icon: 'success',
                timer: 1000,
                showConfirmButton: false
            });
        </script>
        <?php unset($_SESSION['success']);
    } elseif (isset($_SESSION['error'])) { ?>
        <script>
            Swal.fire({
                title: 'Error',
                text: '<?= $_SESSION['error'] ?>',
                icon: 'error',
                timer: 1000,
                showConfirmButton: false
            });
        </script>
        <?php unset($_SESSION['error']);
    } ?>

    <div class="table-container">
        <h1 class="text-4xl text-white mb-6">List of Admin's</h1>
        <a href="post-acc.php" class="text-xl text-blue-500 mb-4 inline-block">+ Add New Account</a>

        <!-- Admin Accounts Table -->
        <table class="w-full mt-4">
            <thead class="table-header">
                <tr>
                    <th class="p-3">ID</th>
                    <th class="p-3">Username</th>
                    <th class="p-3">Email</th>
                    <th class="p-3">Phone</th>
                    <th class="p-3">Created At</th>
                    <th class="p-3">Updated At</th>
                    <th class="p-3">Action</th>
                </tr>
            </thead>
            <tbody class="table-body">
                <?php
                include("../service/connection.php");
                $sql = "SELECT * FROM admin WHERE id != $_SESSION[id]";
                $result = $conn->query($sql);

                if (!$result) {
                    die("Invalid query: " . $conn->error);
                }

                while ($row = $result->fetch_assoc()) { ?>
                    <tr>
                        <td class="p-3"><?= $row['id'] ?></td>
                        <td class="p-3"><?= $row['username'] ?></td>
                        <td class="p-3"><?= $row['email'] ?></td>
                        <td class="p-3"><?= $row['phone'] ?></td>
                        <td class="p-3"><?= $row['created_at'] ?></td>
                        <td class="p-3"><?= $row['updated_at'] ?></td>
                        <td class="p-3 action-btns">
                            <button class="btn-edit" onclick="window.location.href='edit-acc.php?id=<?= $row['id'] ?>'">Edit</button>
                            <button class="btn-delete" onclick="document.getElementById('delete-modal-<?= $row['id'] ?>').showModal()">Delete</button>
                            <dialog id="delete-modal-<?= $row['id'] ?>" class="modal">
                                <div class="modal-box">
                                    <form method="dialog">
                                        <button class="btn btn-sm btn-circle absolute right-2 top-2">✕</button>
                                    </form>
                                    <h3 class="text-black font-bold">Warning!</h3>
                                    <p class="py-4 text-black">Once deleted, this data cannot be restored. Are you sure you want to delete this account?</p>
                                    <a href="../service/auth.php?id=<?= $row['id'] ?>&value=del_acc" class="btn btn-outline btn-error">Yes, Delete</a>
                                </div>
                            </dialog>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>
