<?php
session_start();
require_once 'config.php';

$state = bin2hex(random_bytes(16));
$_SESSION['oauth2_state'] = $state;

$auth_url = "https://accounts.google.com/o/oauth2/v2/auth?" . http_build_query([
    'client_id' => $client_id,
    'redirect_uri' => $redirect_uri,
    'response_type' => 'code',
    'scope' => 'https://www.googleapis.com/auth/userinfo.email https://www.googleapis.com/auth/userinfo.profile',
    'state' => $state,
    'access_type' => 'offline',
    'prompt' => 'consent'
]);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login dengan Google</title>
    <style>
        body {
            background-color: rgb(7, 202, 228); /* biru muda */
            font-family: Arial, sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }

        .login-box {
            background-color: #ffffff;
            padding: 40px 30px;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
            text-align: center;
        }

        .login-box h2 {
            margin-top: 0;
            color: #333333;
            font-size: 24px;
        }

        .google-login-btn {
            margin-top: 20px;
            padding: 10px;
            display: inline-block;
            background-color:rgb(19, 17, 17);
            border: 2px solid #1e9bd4;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: box-shadow 0.3s ease;
        }

        .google-login-btn:hover {
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
        }

        .google-login-btn img {
            height: 40px;
        }
    </style>
</head>
<body>
    <div class="login-box">
        <h2>Login</h2>
        <a class="google-login-btn" href="<?php echo htmlspecialchars($auth_url); ?>">
            <img src="https://developers.google.com/identity/images/btn_google_signin_dark_normal_web.png" alt="Login with Google" />
        </a>
    </div>
</body>
</html>

