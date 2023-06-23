<?php

class Conexion
{
    private static $conexion;
    private function __construct()
    {
        $host = 'localhost';
        $dbname = 'music';
        $usuario = 'postgres';
        $contrasenia = '12345';

        $dsn = "pgsql:host=$host;dbname=$dbname";
        $opciones = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ];

        try {
            Conexion::$conexion = new PDO($dsn, $usuario, $contrasenia, $opciones);
            //echo 'se conecto con exito';
        } catch (PDOException $e) {
            echo 'Error de conexión: ' . $e->getMessage();
            exit;
        }
    }

    public static function obtenerConexion()
    {
        if (Conexion::$conexion == null) {
            new Conexion();
        }

        return Conexion::$conexion;
    }

    public static function altaCancion($cancion)
    {
        try {
            Conexion::$conexion->beginTransaction();

            $sql = 'INSERT INTO Cancion (titulo, duracion, id_artista, id_album) VALUES (?, ?, ?, ?)';

            $query = Conexion::$conexion->prepare($sql);
            Conexion::$conexion->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            $query->bindValue(1, $cancion->getTitulo(), PDO::PARAM_STR);
            $query->bindValue(2, $cancion->getDuracion(), PDO::PARAM_STR);
            $query->bindValue(3, $cancion->getIdArtista(), PDO::PARAM_INT);
            $query->bindValue(4, $cancion->getIdAlbum(), PDO::PARAM_INT);
            $query->execute();

            Conexion::$conexion->commit();

            return true;
        } catch (Exception $e) {
            Conexion::$conexion->rollBack();
        }

        return false;
    }

    public static function bajaCancion($idCancion)
    {
        try {
            Conexion::$conexion->beginTransaction();

            $sql = 'DELETE FROM Cancion WHERE id_cancion = ?';

            $query = Conexion::$conexion->prepare($sql);
            $query->bindValue(1, $idCancion, PDO::PARAM_INT);
            $query->execute();

            Conexion::$conexion->commit();

            return true;
        } catch (Exception $e) {
            Conexion::$conexion->rollBack();
        }

        return false;
    }

    public static function actualizarCancion($cancion)
    {
        try {
            Conexion::$conexion->beginTransaction();

            $sql = 'UPDATE Cancion SET titulo = ?, duracion = ?, id_artista = ?, id_album = ? WHERE id_cancion = ?';

            $query = Conexion::$conexion->prepare($sql);
            Conexion::$conexion->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            $query->bindValue(1, $cancion->getTitulo(), PDO::PARAM_STR);
            $query->bindValue(2, $cancion->getDuracion(), PDO::PARAM_STR);
            $query->bindValue(3, $cancion->getIdArtista(), PDO::PARAM_INT);
            $query->bindValue(4, $cancion->getIdAlbum(), PDO::PARAM_INT);
            $query->bindValue(5, $cancion->getIdCancion(), PDO::PARAM_INT);
            $query->execute();

            Conexion::$conexion->commit();

            return true;
        } catch (Exception $e) {
            Conexion::$conexion->rollBack();
        }

        return false;
    }

    public static function mostrarCanciones()
    {
        try {
            $sql = 'SELECT * FROM Cancion';
            $query = Conexion::$conexion->prepare($sql);
            $query->execute();
            return $query;
        } catch (PDOException $e) {
            echo 'Error en la consulta: ' . $e->getMessage();
            return null;
        }
    }

    public static function buscarCancion($criterios)
    {
        try {
            $sql = "SELECT * FROM Cancion WHERE ";
            $conditions = [];

            if (!empty($criterios->getIdCancion())) {
                $conditions[] = "id_cancion = " . $criterios->getIdCancion();
            }

            if (!empty($criterios->getTitulo())) {
                $conditions[] = "titulo LIKE '" . $criterios->getTitulo() . "'";
            }

            if (!empty($criterios->getDuracion())) {
                $conditions[] = "duracion = '" . $criterios->getDuracion() . "'";
            }

            if (!empty($criterios->getIdArtista())) {
                $conditions[] = "id_artista = " . $criterios->getIdArtista();
            }

            if (!empty($criterios->getIdAlbum())) {
                $conditions[] = "id_album = " . $criterios->getIdAlbum();
            }

            $consulta = $sql . implode(" OR ", $conditions);

            $query = Conexion::$conexion->prepare($consulta);
            $query->execute();

            $resultados = $query->fetchAll(PDO::FETCH_ASSOC);

            return $resultados;
        } catch (Exception $e) {
            echo 'Error en la búsqueda: ' . $e->getMessage();
        }

        return null;
    }


    public static function verificarUsuario($usuario)
    {
        try {
            $sql = 'SELECT COUNT(*) AS count FROM usuarios WHERE nombre_usuario = ? AND contrasenia = ?';

            $query = Conexion::$conexion->prepare($sql);
            $query->bindValue(1, $usuario->getNombreUsuario(), PDO::PARAM_STR);
            $query->bindValue(2, $usuario->getContrasenia(), PDO::PARAM_STR);
            $query->execute();

            $result = $query->fetch(PDO::FETCH_ASSOC);

            if ($result['count'] > 0) {
                // El usuario existe en la base de datos y la contraseña coincide
                return true;
            } else {
                // El usuario no existe en la base de datos o la contraseña no coincide
                return false;
            }
        } catch (Exception $e) {
            // Manejo de errores
        }

        return false;
    }


}

Conexion::obtenerConexion();

?>