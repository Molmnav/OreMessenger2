<?php

// Configuración PDO
// Captura errores PDO

$host = "localhost";
$user = "root";
$pass = "ejemplo_pass";
$port = "33060";
$dbname = "oremessenger";

$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';


try {
    $pdo = new PDO("mysql:host=$host;port=$port;dbname=$dbname;charset=utf8", $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
} catch (PDOException $e) {
    die("Error conexión BD: " . $e->getMessage());
}