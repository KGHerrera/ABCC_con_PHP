<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Altas de Canciones</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>

    <?php
    include('./PHP/controlador/sesionHandler.php');
  
    ?>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Mi Sitio Web</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Acerca de</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Contacto</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./PHP/cerrar_sesion.php">Cerrar Sesión</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container mt-4">
        <h2>Altas de Canciones</h2>
        <form action="./PHP/controlador/agregarCancion.php" method="POST">
            <div class="form-group">
                <label for="titulo">Título:</label>
                <input type="text" class="form-control" id="titulo" name="titulo" required>
            </div>
            <div class="form-group">
                <label for="duracion">Duración:</label>
                <input type="text" class="form-control" id="duracion" name="duracion" required>
            </div>
            <div class="form-group">
                <label for="id_artista">ID Artista:</label>
                <input type="text" class="form-control" id="id_artista" name="id_artista" required>
            </div>
            <div class="form-group">
                <label for="id_album">ID Álbum:</label>
                <input type="text" class="form-control" id="id_album" name="id_album" required>
            </div>
            <button type="submit" class="btn btn-primary">Guardar Canción</button>
        </form>
    </div>

    <div class="container mt-3">
        <?php
        $mensaje = $_GET['mensaje'] ?? '';

        if ($mensaje == 1) {
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                La canción se agregó correctamente
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>';
        } elseif ($mensaje == 0) {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                Hubo un error al agregar la canción
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>';
        } elseif ($mensaje == 2) {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                Hubo un error al agregar la canción
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>';
        } elseif ($mensaje == 3) {
            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                La canción se modificó correctamente
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>';
        }
        ?>
    </div>


    <div class="modal fade" id="modalModificar" tabindex="-1" aria-labelledby="modalModificarLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalModificarLabel">Modificar Canción</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formModificarCancion" action="./PHP/controlador/modificarCancion.php" method="POST">
                        <div class="form-group">
                            <label for="inputID">ID Canción</label>
                            <input type="text" class="form-control" id="inputID" name="idCancion" readonly>
                        </div>
                        <div class="form-group">
                            <label for="inputTitulo">Título</label>
                            <input type="text" class="form-control" id="inputTitulo" name="titulo">
                        </div>
                        <div class="form-group">
                            <label for="inputDuracion">Duración</label>
                            <input type="text" class="form-control" id="inputDuracion" name="duracion">
                        </div>
                        <div class="form-group">
                            <label for="inputIdArtista">ID Artista</label>
                            <input type="text" class="form-control" id="inputIdArtista" name="idArtista">
                        </div>
                        <div class="form-group">
                            <label for="inputIdAlbum">ID Álbum</label>
                            <input type="text" class="form-control" id="inputIdAlbum" name="idAlbum">
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary">Guardar cambios</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <script>
        function openModal(event) {
            event.preventDefault(); // Prevenir el comportamiento predeterminado del enlace
            var idCancion = event.target.getAttribute('data-id-cancion');
            var titulo = event.target.getAttribute('data-titulo');
            var duracion = event.target.getAttribute('data-duracion');
            var idArtista = event.target.getAttribute('data-id-artista');
            var idAlbum = event.target.getAttribute('data-id-album');

            document.getElementById('inputID').value = idCancion;
            document.getElementById('inputTitulo').value = titulo;
            document.getElementById('inputDuracion').value = duracion;
            document.getElementById('inputIdArtista').value = idArtista;
            document.getElementById('inputIdAlbum').value = idAlbum;

            $('#modalModificar').modal('show');
        }
    </script>


    <div class="container">
        <table class="table table-striped mt-4 my-4">
            <thead>
                <h2 class="text-center">Canciones</h2>
                <tr>
                    <th>Id</th>
                    <th>Título</th>
                    <th>Duración</th>
                    <th>Id Artista</th>
                    <th>Id Álbum</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include('tablaCanciones.php');
                ?>
            </tbody>
        </table>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>