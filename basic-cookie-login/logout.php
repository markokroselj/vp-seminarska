<?php
setcookie("uid", "", time() - 3600);
header("Location: index.php");
exit();