<?php

include('./PHP/modelo/Cancion.php');
include('./PHP/conexion/Conexion.php');
include('./PHP/controlador/CancionDAO.php');

$cancionDAO = new CancionDAO();
$resultado = $cancionDAO->mostrarCanciones();

if ($resultado->rowCount()) {
    while ($result = $resultado->fetch(PDO::FETCH_ASSOC)) {
        printf("<tr>");
        printf("<td>" . $result["id_cancion"] . "</td>");
        printf("<td>" . $result["titulo"] . "</td>");
        printf("<td>" . $result["duracion"] . "</td>");
        printf("<td>" . $result["id_artista"] . "</td>");
        printf("<td>" . $result["id_album"] . "</td>");
        printf(
            "<td><a href='#' data-id-cancion='%s' data-titulo='%s' data-duracion='%s' data-id-artista='%s' data-id-album='%s' class='btn btn-outline-success mr-3 btnModificar' onclick='openModal(event)'>Modificar</a>",
            $result["id_cancion"],
            $result["titulo"],
            $result["duracion"],
            $result["id_artista"],
            $result["id_album"]
        );
        printf("<a href='./PHP/controlador/eliminarCancion.php?id_cancion=%s' class='btn btn-outline-danger'>Eliminar</a></td>", $result["id_cancion"]);
        printf("</tr>");
    }
} else {
    echo ("Aun no se agregan canciones");
}
?>