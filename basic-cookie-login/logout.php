<?php
setcookie("uid", "", time() - 86400);
header("Location: index.php");
exit();