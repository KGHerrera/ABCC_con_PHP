<?php
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['username'])) {
    // Redireccionar al formulario de inicio de sesión
    header('Location: login.php');
    exit();
}
?>