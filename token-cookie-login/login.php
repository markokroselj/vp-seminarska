<?php
require_once "User.php";

if (!isset($_POST['username']) || empty($_POST['username']) || !isset($_POST['password']) || empty($_POST['password'])) {
    http_response_code(401);
    echo '401 Unauthorized';
    exit();
}

if(User::valid_login($_POST['username'], $_POST['password'])){
    $access_token = md5(uniqid('', true).rand(1000000, 9999999));

    User::set_access_token($_POST['username'], $access_token);
    setcookie('token', $access_token, time() + 604800);
    
    header('Location: index.php');
    exit();
}else {
    http_response_code(401);
    echo '401 Unauthorized';
    exit();
}