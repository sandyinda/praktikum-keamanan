<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}
$user = $_SESSION['user'];
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <style>
        /* style.css - Versi berwarna untuk dashboard.php */
        body {
            margin: 0;
            padding: 0;
            background: linear-gradient(135deg, #6c5ce7, #00cec9);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .container {
            background-color: #ffffff;
            padding: 40px 50px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            text-align: center;
            width: 400px;
            animation: fadeIn 0.8s ease-in-out;
        }

        h2 {
            color: #2d3436;
            margin-bottom: 20px;
            font-size: 24px;
        }

        p {
            font-size: 16px;
            color: #636e72;
            margin-bottom: 20px;
        }

        a.logout-btn {
            display: inline-block;
            padding: 12px 30px;
            background-color: #d63031;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-weight: bold;
            font-size: 14px;
            transition: background-color 0.3s ease;
        }

        a.logout-btn:hover {
            background-color: #c0392b;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Selamat datang, <?php echo htmlspecialchars($user['name']); ?>!</h2>
        <p>Email: <?php echo htmlspecialchars($user['email']); ?></p>
        <a href="logout.php" class="logout-btn">Logout</a>
    </div>
</body>
</html>
