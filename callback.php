<?php
session_start();
require_once 'config.php';

if (!isset($_GET['state']) || $_GET['state'] !== $_SESSION['oauth2_state']) {
    die('Invalid state (CSRF check failed)');
}

if (!isset($_GET['code'])) {
    die('Authorization code not found');
}

$code = $_GET['code'];

$token_url = 'https://oauth2.googleapis.com/token';

$data = [
    'code' => $code,
    'client_id' => $client_id,
    'client_secret' => $client_secret,
    'redirect_uri' => $redirect_uri,
    'grant_type' => 'authorization_code'
];

$options = [
    'http' => [
        'method' => 'POST',
        'header'  => "Content-type: application/x-www-form-urlencoded",
        'content' => http_build_query($data)
    ]
];

$context  = stream_context_create($options);
$response = file_get_contents($token_url, false, $context);
if (!$response) {
    die('Error fetching token');
}

$token_data = json_decode($response, true);
$access_token = $token_data['access_token'] ?? null;
if (!$access_token) {
    die('Access token not found');
}

$userinfo = file_get_contents('https://www.googleapis.com/oauth2/v1/userinfo?access_token=' . urlencode($access_token));
$user_data = json_decode($userinfo, true);

$_SESSION['user'] = [
    'name' => $user_data['name'] ?? '',
    'email' => $user_data['email'] ?? ''
];

header('Location: dashboard.php');
exit;
?>
