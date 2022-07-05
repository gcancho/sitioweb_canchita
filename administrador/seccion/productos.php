<?php include("../template/cabecera.php") ?>

<?php

// print_r($_POST);
// print_r($_FILES);

$txtID = (isset($_POST['txtID'])) ? $_POST['txtID'] : "";
$txtNombre = (isset($_POST['txtNombre'])) ? $_POST['txtNombre'] : "";
$txtImagen = (isset($_FILES['txtImagen']['name'])) ? $_FILES['txtImagen']['name'] : "";
$txtDistrito = (isset($_POST['txtDistrito'])) ? $_POST['txtDistrito'] : "";
$accion = (isset($_POST['accion'])) ? $_POST['accion'] : "";

include("../config/bd.php");

// Los parametros que tienen dos puntos (:) son los nombres de los campos de la bd
switch ($accion) {
    case "Agregar":
        $sentenciaSQL = $conexion->prepare("INSERT INTO libros (nombre, imagen, distrito) VALUES (:nombre, :imagen, :distrito);");
        $sentenciaSQL->bindParam(':nombre', $txtNombre);

        $fecha = new DateTime();
        $nombreArchivo = ($txtImagen != "") ? $fecha->getTimestamp() . "_" . $_FILES["txtImagen"]["name"] : "imagen.jpg";

        $tmpImagen = $_FILES["txtImagen"]["tmp_name"];

        if ($tmpImagen != "") {
            move_uploaded_file($tmpImagen, "../../img/" . $nombreArchivo);
        }


        $sentenciaSQL->bindParam(':imagen', $nombreArchivo);
        $sentenciaSQL->bindParam(':distrito', $txtDistrito);
        $sentenciaSQL->execute();

        header("Location:productos.php");

        break;
    case "Modificar":
        $sentenciaSQL = $conexion->prepare("UPDATE libros SET nombre=:nombre,distrito=:distrito WHERE id=:id");
        $sentenciaSQL->bindParam(':nombre', $txtNombre);
        $sentenciaSQL->bindParam(':distrito', $txtDistrito);
        $sentenciaSQL->bindParam(':id', $txtID);
        $sentenciaSQL->execute();

        if ($txtImagen != "") {
            $fecha = new DateTime();
            $nombreArchivo = ($txtImagen != "") ? $fecha->getTimestamp() . "_" . $_FILES["txtImagen"]["name"] : "imagen.jpg";
            $tmpImagen = $_FILES["txtImagen"]["tmp_name"];

            move_uploaded_file($tmpImagen, "../../img/" . $nombreArchivo);

            $sentenciaSQL = $conexion->prepare("SELECT imagen FROM libros WHERE id=:id");
            $sentenciaSQL->bindParam(':id', $txtID);
            $sentenciaSQL->execute();
            $libro = $sentenciaSQL->fetch(PDO::FETCH_LAZY);


            if (isset($libro["imagen"]) && ($libro["imagen"] != "imagen.jpg")) {
                if (file_exists("../../img/" . $libro["imagen"])) {
                    unlink("../../img/" . $libro["imagen"]);
                }
            }

            $sentenciaSQL = $conexion->prepare("UPDATE libros SET imagen=:imagen,distrito=:distrito WHERE id=:id");
            $sentenciaSQL->bindParam(':imagen', $nombreArchivo);
            $sentenciaSQL->bindParam(':distrito', $txtDistrito);
            $sentenciaSQL->bindParam(':id', $txtID);
            $sentenciaSQL->execute();
        }
        header("Location:productos.php");

        break;

    case "Cancelar":
        header("Location:productos.php");
        break;

    case "Seleccionar":
        $sentenciaSQL = $conexion->prepare("SELECT * FROM libros WHERE id=:id");
        $sentenciaSQL->bindParam(':id', $txtID);
        $sentenciaSQL->execute();
        $libro = $sentenciaSQL->fetch(PDO::FETCH_LAZY);

        $txtNombre = $libro['nombre'];
        $txtImagen = $libro['imagen'];
        $txtDistrito = $libro['distrito'];
        break;

    case "Borrar":
        $sentenciaSQL = $conexion->prepare("SELECT imagen FROM libros WHERE id=:id");
        $sentenciaSQL->bindParam(':id', $txtID);
        $sentenciaSQL->execute();
        $libro = $sentenciaSQL->fetch(PDO::FETCH_LAZY);

        if (isset($libro["imagen"]) && ($libro["imagen"] != "imagen.jpg")) {
            if (file_exists("../../img/" . $libro["imagen"])) {
                unlink("../../img/" . $libro["imagen"]);
            }
        }

        $sentenciaSQL = $conexion->prepare("DELETE FROM libros WHERE id=:id");
        $sentenciaSQL->bindParam(':id', $txtID);
        $sentenciaSQL->execute();

        header("Location:productos.php");

        break;
}

$sentenciaSQL = $conexion->prepare("SELECT * FROM libros");
$sentenciaSQL->execute();
$listaLibros = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

?>


<div class="col-md-5">

    <div class="card">
        <div class="card-header">
            Datos de Libro
        </div>
        <div class="card-body">
            <form method="post" enctype="multipart/form-data">

                <div class="form-group">
                    <label for="txtID">ID:</label>
                    <input type="text" required readonly class="form-control" value="<?php echo $txtID; ?>" name="txtID" id="txtID" placeholder="ID">
                </div>

                <div class="form-group">
                    <label for="txtNombre">Nombre:</label>
                    <input type="text" required class="form-control" value="<?php echo $txtNombre; ?>" name="txtNombre" id="txtNombre" placeholder="Nombre del libro">
                </div>

                <div class="form-group">
                    <label for="txtImagen">Imagen:</label>

                    <br>
                    <?php if ($txtImagen != "") { ?>
                        <img class="img-thumbnail rounded" src="../../img/<?php echo $txtImagen; ?>" width="50" alt="">
                    <?php } ?>

                    <input type="file" class="form-control" name="txtImagen" id="txtImagen" placeholder="Nombre del libro">
                </div>

                <div class="form-group">
                    <label for="txtDistrito">Distrito:</label>
                    <input type="text" required class="form-control" value="<?php echo $txtDistrito; ?>" name="txtDistrito" id="txtDistrito" placeholder="Nombre del distrito">
                </div>

                <!-- Activar desactivar botones -->
                <div class="btn-group" role="group" aria-label="">
                    <button type="submit" name="accion" <?php echo ($accion == "Seleccionar") ? "disabled" : ""; ?> value="Agregar" class="btn btn-success">Agregar</button>
                    <button type="submit" name="accion" <?php echo ($accion != "Seleccionar") ? "disabled" : ""; ?> value="Modificar" class="btn btn-warning">Modificar</button>
                    <button type="submit" name="accion" <?php echo ($accion != "Seleccionar") ? "disabled" : ""; ?> value="Cancelar" class="btn btn-info">Cancelar</button>
                </div>

            </form>
        </div>
    </div>




</div>
<div class="col-md-7">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre de canchita</th>
                <th>Imagen</th>
                <th>Distrito</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($listaLibros as $libro) { ?>
                <tr>
                    <!-- Estos datos deben coincidir con los nomrbres de los campos de la bd -->
                    <td><?php echo $libro['id']; ?></td>
                    <td><?php echo $libro['nombre']; ?></td>
                    <td><img class="img-thumbnail rounded" src="../../img/<?php echo $libro['imagen']; ?>" width="50" alt=""></td>
                    <td><?php echo $libro['distrito']; ?></td>
                    <td>

                        <form method="post">

                            <input type="hidden" name="txtID" id="txtUD" value="<?php echo $libro['id']; ?>">
                            <input type="submit" name="accion" value="Seleccionar" class="btn btn-primary">
                            <input type="submit" name="accion" value="Borrar" class="btn btn-danger">

                        </form>

                    </td>
                </tr>
            <?php }  ?>
        </tbody>
    </table>
</div>

<?php include("../template/pie.php") ?>