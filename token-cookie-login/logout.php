<?php
require_once "User.php";

if(isset($_COOKIE["token"]) && !empty($_COOKIE["token"])){
    User::unset_access_token($_COOKIE["token"]);
}
setcookie("token", "", time() - 86400);
header("Location: index.php");
exit();