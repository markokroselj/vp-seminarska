<?php
if (isset($_COOKIE['token']) && !empty($_COOKIE['token'])) {
    require_once "User.php";
    $token = $_COOKIE['token'];
    if (User::valid_token($token)) {
    $username = htmlspecialchars(User::get_username_from_token($token));
?>

        <!DOCTYPE html>
        <html lang="sl">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Hello</title>
        </head>

        <body>
            <h1>Pozdravljen <?= $username ?>! 👋</h1>
            <a href="logout.php">Odjava</a>
        </body>

        </html>
<?php
        exit();
    }
}

?>

<!DOCTYPE html>
<html lang="sl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Prijava</title>
</head>

<body>
    <h1>Prijava</h1>
    <form action="login.php" method="POST">
        <div class="input-wrapper">
            <div class="input-container">
                <label for="username">Uporabniško ime</label>
                <input type="text" name="username" id="username">
            </div>
            <div class="input-container">
                <label for="password">Geslo</label>
                <input type="password" name="password" id="password">
            </div>
        </div>
        <button>Prijava</button>
    </form>
</body>

</html>