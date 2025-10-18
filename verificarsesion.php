<?php
session_start();

// Verificar si el usuario está logueado
if (!isset($_SESSION['usuario_logueado'])) {
    header("Location: login.php");
    exit();
}
?>