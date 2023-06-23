<?php
session_start();

include('../conexion/Conexion.php');
include('../modelo/Usuario.php');

$username = $_POST['username'];
$password = $_POST['password'];

$usuario = new Usuario();
$usuario->setNombreUsuario($username);
$usuario->setContrasenia($password);


if (Conexion::verificarUsuario($usuario)) {
    // Inicio de sesión exitoso
    $_SESSION['username'] = $username;
    header('Location: ../../altasCanciones.php');
} else {
    // Credenciales incorrectas
    echo "Credenciales de inicio de sesión incorrectas";
}
?>