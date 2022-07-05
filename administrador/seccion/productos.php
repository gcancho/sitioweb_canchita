<?php include("../template/cabecera.php") ?>

<?php

// print_r($_POST);
// print_r($_FILES);

$txtID = (isset($_POST['txtID'])) ? $_POST['txtID'] : "";
$txtNombre = (isset($_POST['txtNombre'])) ? $_POST['txtNombre'] : "";
$txtImagen = (isset($_FILES['txtImagen']['name'])) ? $_FILES['txtImagen']['name'] : "";
$txtDistrito = (isset($_POST['txtDistrito'])) ? $_POST['txtDistrito'] : "";
$txtDireccion = (isset($_POST['txtDireccion'])) ? $_POST['txtDireccion'] : "";

$txtTelefono = (isset($_POST['txtTelefono'])) ? $_POST['txtTelefono'] : ""; //telefono, horario, tarifa_dia, tarifa_noche, medio_pago
$txtHorario = (isset($_POST['txtHorario'])) ? $_POST['txtHorario'] : "";
$txtTarifaDia = (isset($_POST['txtTarifaDia'])) ? $_POST['txtTarifaDia'] : "";
$txtTarifaNoche = (isset($_POST['txtTarifaNoche'])) ? $_POST['txtTarifaNoche'] : "";
$txtMedioPago = (isset($_POST['txtMedioPago'])) ? $_POST['txtMedioPago'] : "";

$accion = (isset($_POST['accion'])) ? $_POST['accion'] : "";

include("../config/bd.php");

// Los parametros que tienen dos puntos (:) son los nombres de los campos de la bd
switch ($accion) {
    case "Agregar":
        //telefono, horario, tarifa_dia, tarifa_noche, medio_pago
        $sentenciaSQL = $conexion->prepare("INSERT INTO libros (nombre, imagen, distrito, direccion, telefono, horario, tarifa_dia, tarifa_noche, medio_pago) VALUES (:nombre, :imagen, :distrito, :direccion, :telefono, :horario, :tarifa_dia, :tarifa_noche, :medio_pago);");
        $sentenciaSQL->bindParam(':nombre', $txtNombre);

        $fecha = new DateTime();
        $nombreArchivo = ($txtImagen != "") ? $fecha->getTimestamp() . "_" . $_FILES["txtImagen"]["name"] : "imagen.jpg";

        $tmpImagen = $_FILES["txtImagen"]["tmp_name"];

        if ($tmpImagen != "") {
            move_uploaded_file($tmpImagen, "../../img/" . $nombreArchivo);
        }


        $sentenciaSQL->bindParam(':imagen', $nombreArchivo);
        $sentenciaSQL->bindParam(':distrito', $txtDistrito);
        $sentenciaSQL->bindParam(':direccion', $txtDireccion);

        $sentenciaSQL->bindParam(':telefono', $txtTelefono); //telefono, horario, tarifa_dia, tarifa_noche, medio_pago
        $sentenciaSQL->bindParam(':horario', $txtHorario);
        $sentenciaSQL->bindParam(':tarifa_dia', $txtTarifaDia);
        $sentenciaSQL->bindParam(':tarifa_noche', $txtTarifaNoche);
        $sentenciaSQL->bindParam(':medio_pago', $txtMedioPago);
        $sentenciaSQL->execute();

        header("Location:productos.php");

        break;
    case "Modificar":
        //telefono, horario, tarifa_dia, tarifa_noche, medio_pago
        $sentenciaSQL = $conexion->prepare("UPDATE libros SET nombre=:nombre,distrito=:distrito,direccion=:direccion,telefono=:telefono,horario=:horario,tarifa_dia=:tarifa_dia,tarifa_noche=:tarifa_noche,medio_pago=:medio_pago WHERE id=:id");
        $sentenciaSQL->bindParam(':nombre', $txtNombre);
        $sentenciaSQL->bindParam(':distrito', $txtDistrito);
        $sentenciaSQL->bindParam(':direccion', $txtDireccion);

        $sentenciaSQL->bindParam(':telefono', $txtTelefono);
        $sentenciaSQL->bindParam(':horario', $txtHorario);
        $sentenciaSQL->bindParam(':tarifa_dia', $txtTarifaDia);
        $sentenciaSQL->bindParam(':tarifa_noche', $txtTarifaNoche);
        $sentenciaSQL->bindParam(':medio_pago', $txtMedioPago);

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

            $sentenciaSQL = $conexion->prepare("UPDATE libros SET imagen=:imagen,distrito=:distrito,direccion=:direccion WHERE id=:id");
            $sentenciaSQL->bindParam(':imagen', $nombreArchivo);
            $sentenciaSQL->bindParam(':distrito', $txtDistrito);
            $sentenciaSQL->bindParam(':direccion', $txtDireccion);

            $sentenciaSQL->bindParam(':telefono', $txtTelefono); //telefono, horario, tarifa_dia, tarifa_noche, medio_pago
            $sentenciaSQL->bindParam(':horario', $txtHorario);
            $sentenciaSQL->bindParam(':tarifa_dia', $txtTarifaDia);
            $sentenciaSQL->bindParam(':tarifa_noche', $txtTarifaNoche);
            $sentenciaSQL->bindParam(':medio_pago', $txtMedioPago);

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
        $txtDireccion = $libro['direccion'];

        $txtTelefono = $libro['telefono']; //telefono, horario, tarifa_dia, tarifa_noche, medio_pago
        $txtHorario = $libro['horario'];
        $txtTarifaDia = $libro['tarifa_dia'];
        $txtTarifaNoche = $libro['tarifa_noche'];
        $txtMedioPago = $libro['medio_pago'];
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


<div class="col-md-3">

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
                    <label for="txtNombre">Nombre cancha:</label>
                    <input type="text" required class="form-control" value="<?php echo $txtNombre; ?>" name="txtNombre" id="txtNombre" placeholder="Nombre de canchita">
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
                    <input type="text" class="form-control" value="<?php echo $txtDistrito; ?>" name="txtDistrito" id="txtDistrito" placeholder="Nombre del distrito">
                </div>

                <div class="form-group">
                    <label for="txtDireccion">Direccion:</label>
                    <input type="text" class="form-control" value="<?php echo $txtDireccion; ?>" name="txtDireccion" id="txtDireccion" placeholder="Ingrese la dirección">
                </div>

                <!-- telefono, horario, tarifa_dia, tarifa_noche, medio_pago -->

                <div class="form-group">
                    <label for="txtDireccion">Telefono:</label>
                    <input type="text" class="form-control" value="<?php echo $txtTelefono; ?>" name="txtTelefono" id="txtTelefono" placeholder="Ingrese el telefono">
                </div>

                <div class="form-group">
                    <label for="txtDireccion">Horario:</label>
                    <input type="text" class="form-control" value="<?php echo $txtHorario; ?>" name="txtHorario" id="txtHorario" placeholder="Ingrese el horario">
                </div>

                <div class="form-group">
                    <label for="txtDireccion">Tarifa Día:</label>
                    <input type="text" class="form-control" value="<?php echo $txtTarifaDia; ?>" name="txtTarifaDia" id="txtTarifaDia" placeholder="Ingrese tarifa dia">
                </div>

                <div class="form-group">
                    <label for="txtDireccion">Tarifa Noche:</label>
                    <input type="text" class="form-control" value="<?php echo $txtTarifaNoche; ?>" name="txtTarifaNoche" id="txtTarifaNoche" placeholder="Ingrese tarifa noche">
                </div>

                <div class="form-group">
                    <label for="txtDireccion">Medio de pago:</label>
                    <input type="text" class="form-control" value="<?php echo $txtMedioPago; ?>" name="txtMedioPago" id="txtMedioPago" placeholder="Ingrese medio de pago">
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
<div class="col-md-9">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre de canchita</th>
                <th>Imagen</th>
                <th>Distrito</th>
                <th>Dirección</th>

                <!-- telefono, horario, tarifa_dia, tarifa_noche, medio_pago -->
                <th>Telefono</th>
                <th>Horario</th>
                <th>Tarifa dia</th>
                <th>Tarifa noche</th>
                <th>Medio pago</th>

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
                    <td><?php echo $libro['direccion']; ?></td>

                    <!-- telefono, horario, tarifa_dia, tarifa_noche, medio_pago -->
                    <td><?php echo $libro['telefono']; ?></td>
                    <td><?php echo $libro['horario']; ?></td>
                    <td><?php echo $libro['tarifa_dia']; ?></td>
                    <td><?php echo $libro['tarifa_noche']; ?></td>
                    <td><?php echo $libro['medio_pago']; ?></td>

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