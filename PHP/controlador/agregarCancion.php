<?php
include('../modelo/Cancion.php');
include('../conexion/Conexion.php');
include('../controlador/CancionDAO.php');

$titulo = $_POST['titulo'];
$duracion = $_POST['duracion'];
$id_artista = $_POST['id_artista'];
$id_album = $_POST['id_album'];

// Crear una instancia de la canción con los datos del formulario
$cancion = new Cancion(0, $titulo, $duracion, $id_artista, $id_album);

// Invocar el método de agregar canción en CancionDAO
$cancionDAO = new CancionDAO();
$resultado = $cancionDAO->altaCancion($cancion);

// Redireccionar al formulario con el mensaje correspondiente
if ($resultado) {
    header('Location: ../../altasCanciones.php?mensaje=1');
} else {
    header('Location: ../../altasCanciones.php?mensaje=0');
}
?>