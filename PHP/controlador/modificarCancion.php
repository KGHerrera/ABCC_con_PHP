<?php
include('../modelo/Cancion.php');
include('../conexion/Conexion.php');
include('../controlador/CancionDAO.php');

$id_cancion = $_POST['idCancion'];
$titulo = $_POST['titulo'];
$duracion = $_POST['duracion'];
$id_artista = $_POST['idArtista'];
$id_album = $_POST['idAlbum'];

// Crear una instancia de la canción con los datos del formulario
$cancion = new Cancion($id_cancion, $titulo, $duracion, $id_artista, $id_album);

// Invocar el método de modificar canción en CancionDAO
$cancionDAO = new CancionDAO();
$resultado = $cancionDAO->actualizarCancion($cancion);

// Redireccionar al formulario con el mensaje correspondiente
if ($resultado) {
    header('Location: ../../altasCanciones.php?mensaje=3');
} else {
    header('Location: ../../altasCanciones.php?mensaje=2');
}
?>