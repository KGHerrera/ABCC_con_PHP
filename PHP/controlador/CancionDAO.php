<?php

class CancionDAO {

    public function __construct(){
    }

    public function altaCancion($cancion) {
        return Conexion::altaCancion($cancion);
    }

    public function bajaCancion($id) {
        return Conexion::bajaCancion($id);
    }

    public function actualizarCancion($cancion) {
        return Conexion::actualizarCancion($cancion);
    }

    public function buscarCancion($criterios) {
        return Conexion::buscarCancion($criterios);
    }

    public function mostrarCanciones(){
        return Conexion::mostrarCanciones();
    }
}

?>