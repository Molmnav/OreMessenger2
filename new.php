<?php

date_default_timezone_set('Europe/Madrid');

require_once 'src/api/conexion.php';
global $pdo;

session_start();



if (!isset($_SESSION['username'])) {
    header('Location: index.php');
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $accion = $_POST["accion"] ?? "";

    if ($accion == "Cancelar") {
        header('Location: messages.php');
        exit;
    }

    if ($accion == "Enviar") {

        $body = $_POST["body"] ?? "";
        $username = $_SESSION['username'];

        $stmt = $pdo->prepare('INSERT INTO message (username, body,created_at) VALUES (?, ?,NOW())');

        $stmt->execute([$username, $body]);

        if ($body != ""){
            header('Location: messages.php');
            exit;
        }
    }








}

?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Document</title>
</head>
<body>

<h1>Crear nuevo mensaje</h1>
<form action="" method="post">

    <label for="body">Mensaje: </label><br>

    <textarea name="body" id="body" cols="30" rows="10" placeholder="Introduce tu mensaje aqui..."></textarea><br>

    <button type="submit" name="accion" value="Enviar">Enviar</button>

    <button type="submit" name="accion" value="Cancelar">Cancelar</button>

</form>

</body>
</html>
