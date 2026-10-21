<?php

session_start();
$_SESSION = [];
session_destroy();

header("Location: http://localhost:8080/src/api/Login.php");
exit();

