<?php

require_once 'conexion.php';
global $pdo;

session_start();

$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $stmt = $pdo->prepare('SELECT * FROM person WHERE username = ? AND password = ?');

    $stmt->execute([$username, $password]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        session_regenerate_id(true);
        $_SESSION['username'] = $user['username'];

        header('Location: ../../messages.php');
        exit;

    }
}

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Document</title>

    <style>

    </style>
</head>
<body>

<form action="" method="post">
    <label for="username">Usuario: </label>
    <input type="text" id="username" name="username">
    <br>
    <label for="password">Contraseña: </label>
    <input type="password" id="password" name="password">
    <br>
    <button type="submit" name="accion" value="Iniciar-Sesion">Iniciar Sesion</button>

</form>

</body>
</html>
