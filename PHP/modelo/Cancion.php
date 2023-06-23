<?php

    class Cancion {
        private $id_cancion;
        private $titulo;
        private $duracion;
        private $id_artista;
        private $id_album;

        // Constructor
        public function __construct($id_cancion, $titulo, $duracion, $id_artista, $id_album) {
            $this->id_cancion = $id_cancion;
            $this->titulo = $titulo;
            $this->duracion = $duracion;
            $this->id_artista = $id_artista;
            $this->id_album = $id_album;
        }
        
        // Getters y Setters
        public function getIdCancion() {
            return $this->id_cancion;
        }

        public function setIdCancion($id_cancion){
            $this->id_cancion = $id_cancion;
        }
        
        public function getTitulo() {
            return $this->titulo;
        }
        
        public function setTitulo($titulo) {
            $this->titulo = $titulo;
        }
        
        public function getDuracion() {
            return $this->duracion;
        }
        
        public function setDuracion($duracion) {
            $this->duracion = $duracion;
        }
        
        public function getIdArtista() {
            return $this->id_artista;
        }
        
        public function setIdArtista($id_artista) {
            $this->id_artista = $id_artista;
        }
        
        public function getIdAlbum() {
            return $this->id_album;
        }
        
        public function setIdAlbum($id_album) {
            $this->id_album = $id_album;
        }
    }
?>