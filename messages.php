<?php

session_start();

global $password, $username, $pdo, $user;
require_once __DIR__ . '/vendor/autoload.php';

require_once 'src/api/conexion.php';


if (isset($_SESSION['username'])) {

    $accion = $_POST['accion'] ?? "";

    $username = $_SESSION['username'];

    $mensajes = $pdo->prepare('SELECT * FROM message WHERE username = ?');

    $mensajes->execute([$username]);

    $resultadoMensajes = $mensajes->fetchAll(PDO::FETCH_ASSOC);

    if ($accion == 'Logout'){
        session_start();
        $_SESSION = [];
        session_destroy();

        header("Location: http://localhost:8080/src/api/index.php");
        exit();
    }

    if ($accion == 'crearMensaje'){
        header("Location: http://localhost:8080/new.php");
    }

} else {
    header('Location: src/api/index.php');
    exit;
}

$accionEliminar = $_GET["accion"] ?? "";
if ($accionEliminar == "eliminar") {
    $id = $_GET["id"] ??"";

    $eliminar = $pdo->prepare(
        'DELETE FROM message WHERE id = ? AND username = ?'
    );

    $eliminar->execute([$id, $username]);

    header('Location: messages.php');
    exit;
}
?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Document</title>

    <style>
        table{
            border: 1px solid black;

        }
        th{
            border: 1px solid black;
        }
        td{
            border: 1px solid black;

        }

        .volver{
            margin-top: 10px;
        }
    </style>
</head>
<body>

<?php
if (isset($_SESSION['username'])) {
    echo '<h1>Usuarios correctos</h1>';

    ?>

    <table>
        <tr>
            <th>id</th>
            <th>Username</th>
            <th>Body</th>
            <th>creado el</th>
        </tr>

        <?php
        foreach ($resultadoMensajes as $i => $mensaje){
            echo '<tr>';
            echo '<td>' . $mensaje['id'] . '</td>';
            echo '<td>' . $mensaje['username'] . '</td>';
            echo '<td>' . $mensaje['body'] . '</td>';
            echo '<td>' . $mensaje['created_at'] . '</td>';
            echo "<td>
                   <a href='messages.php?accion=eliminar&id=" . $mensaje['id'] . "'
                    onclick=\"return confirm('¿Seguro que quieres eliminar este partido?')\">
                    Eliminar
                    </a>
                   </td>";
            echo '</tr>';
        }
        ?>



    </table>

    <form action="" METHOD="post">
        <p><button type="submit" name="accion" value="Logout">Volver a Logearte</button>
            | <button type="submit" name="accion" value="crearMensaje">Crear Mensaje</button></p>
    </form>

    <?php

}else{
    echo '<h1>Usuarios incorrectos</h1>';
}
?>



</body>
</html>

