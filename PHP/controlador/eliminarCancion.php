<?php

include('../controlador/CancionDAO.php');
include('../conexion/Conexion.php');
include('../modelo/Cancion.php');

$id_cancion = $_GET['id_cancion'];

$datos_correctos = true;

if ($datos_correctos) {
    $cancionDAO = new CancionDAO();
    Conexion::obtenerConexion();
    $resultado = $cancionDAO->bajaCancion($id_cancion);
    if ($resultado) {
        header('Location: ../../altasCanciones.php');
    } else {
        echo "Error al eliminar la canción";
    }
}
?>