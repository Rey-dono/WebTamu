
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background: rgb(174, 143, 114); /* Ganti warna background ke rgb(174, 143, 114) */
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            margin: 0;
            overflow-x: hidden;
        }

        .container {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 2rem;
            width: 80%;
            max-width: 1200px;
        }

        .login-container {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            padding: 2rem;
            width: 600px;
            height: 300px;
            flex-shrink: 0;
        }

        .login-header {
            font-size: 24px;
            font-weight: bold;
            text-align: center;
            margin-bottom: 1.5rem;
            color: #841922;
        }

        .form-group {
            margin-bottom: 1rem;
            position: relative;
        }

        .form-group input {
            width: 100%;
            padding: 0.75rem 2.5rem;
            border-radius: 8px;
            border: 1px solid #ddd;
            font-size: 14px;
            background-color: #f3f8ff;
            color: #333;
        }

        .form-group i {
            position: absolute;
            left: 10px;
            top: 50%;
            transform: translateY(-50%);
            color: #666;
        }

        .form-group .toggle-password {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #666;
        }

        .login-btn {
            display: block;
            width: 100%;
            padding: 0.75rem;
            background: #841922;
            color: #fff;
            border: none;
            border-radius: 8px;
            text-transform: uppercase;
            font-weight: bold;
            cursor: pointer;
            transition:  0.3s;
        }

        .login-btn:hover {
            background: #6d0e15; /* Hover tombol menjadi lebih gelap */
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2 class="login-header">Login</h2>
        <form action="../service/auth.php" method="POST">
            <div class="form-group relative">
                <i class="fas fa-user absolute left-3 top-3 text-gray-500"></i>
                <input type="text" name="username" placeholder="Username" required class="w-full pl-10 p-2 border rounded-lg">
            </div>
            <div class="form-group relative">
                <i class="fas fa-key absolute left-3 top-3 text-gray-500"></i>
                <input type="password" name="password" placeholder="Password" required class="w-full pl-10 p-2 border rounded-lg">
            </div>
            <button type="submit" name="type" value="login" class="login-btn">Login</button>
        </form>
    </div>
</body>
</html>
