<?php
require_once "User.php";

if (!isset($_POST['username']) || empty($_POST['username']) || !isset($_POST['password']) || empty($_POST['password'])) {
    http_response_code(401);
    echo '401 Unauthorized';
    exit();
}

if(User::valid_login($_POST['username'], $_POST['password'])){
    setcookie('uid', htmlspecialchars($_POST['username']), time() + 604800);
    header('Location: index.php');
    exit();
}else {
    http_response_code(401);
    echo '401 Unauthorized';
    exit();
}