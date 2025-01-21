<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(to right, #3b82f6, #9333ea); /* Gradien biru ke ungu */
            min-height: 100vh; /* Tinggi minimum layar penuh */
            display: flex; /* Aktifkan flexbox */
            flex-direction: column; /* Tata letak vertikal */
            align-items: center; /* Rata tengah horizontal */
            justify-content: center; /* Rata tengah vertikal */
            margin: 0; /* Hilangkan margin default */
            overflow-x: hidden; /* Sembunyikan overflow horizontal */
        }
        .container {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 2rem;
            width: 80%;
            max-width: 1200px;
        }

        .signup-container {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            padding: 2rem;
            width: 400px;
            flex-shrink: 0;
        }

        .signup-header {
            font-size: 24px;
            font-weight: bold;
            text-align: center;
            margin-bottom: 1.5rem;
        }

        .form-group {
            margin-bottom: 1rem;
            position: relative;
        }

        .form-group input {
            width: 100%;
            padding: 0.75rem 2.5rem;
            border-radius: 8px;
            border: 1px solid #ccc;
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

        .signup-btn {
            display: block;
            width: 100%;
            padding: 0.75rem;
            background: #596a85;
            color: #fff;
            border: none;
            border-radius: 8px;
            text-transform: uppercase;
            font-weight: bold;
            cursor: pointer;
            transition: background 0.3s;
        }

        .signup-btn:hover {
            background: #48576c;
        }

    </style>
</head>
<body>
    <div class="container">
        <!-- Form Sign Up -->
        <div class="signup-container">
            <div class="signup-header">SIGN UP</div>
            <form id="signup-form">
                <div class="form-group">
                    <i class="fas fa-user"></i>
                    <input type="text" id="username" placeholder="Enter Username" required>
                </div>
                <div class="form-group">
                    <i class="fas fa-key"></i>
                    <input type="password" id="password" placeholder="Enter Password" required>
                    <i class="fas fa-eye-slash toggle-password" onclick="togglePassword('password', this)"></i>
                </div>
                <div class="form-group">
                    <i class="fas fa-key"></i>
                    <input type="password" id="confirm-password" placeholder="Confirm Password" required>
                    <i class="fas fa-eye-slash toggle-password" onclick="togglePassword('confirm-password', this)"></i>
                </div>
                <a href="main.php" class="signup-btn" type="submit">SIGN UP</a>
            </form>
        </div>
    </div>

</body>
</html>
