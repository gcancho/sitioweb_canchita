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
$txtImagen2 = (isset($_FILES['txtImagen2']['name'])) ? $_FILES['txtImagen2']['name'] : "";
$txtImagen3 = (isset($_FILES['txtImagen3']['name'])) ? $_FILES['txtImagen3']['name'] : "";
$txtImagenQR = (isset($_FILES['txtImagenQR']['name'])) ? $_FILES['txtImagenQR']['name'] : "";
$txtImagenTienda = (isset($_FILES['txtImagenTienda']['name'])) ? $_FILES['txtImagenTienda']['name'] : "";

$accion = (isset($_POST['accion'])) ? $_POST['accion'] : "";

include("../config/bd.php");

// Los parametros que tienen dos puntos (:) son los nombres de los campos de la bd
switch ($accion) {
    case "Agregar":
        //telefono, horario, tarifa_dia, tarifa_noche, medio_pago
        $sentenciaSQL = $conexion->prepare("INSERT INTO libros (nombre, imagen, distrito, direccion, telefono, horario, tarifa_dia, tarifa_noche, medio_pago, imagen2, imagen3, imagen_qr,imagen_tienda) VALUES (:nombre, :imagen, :distrito, :direccion, :telefono, :horario, :tarifa_dia, :tarifa_noche, :medio_pago, :imagen2, :imagen3, :imagen_qr, :imagen_tienda );");
        $sentenciaSQL->bindParam(':nombre', $txtNombre);

        $fecha = new DateTime();
        $nombreArchivo = ($txtImagen != "") ? $fecha->getTimestamp() . "_" . $_FILES["txtImagen"]["name"] : "imagen.jpg";
        $fecha2 = new DateTime();
        $nombreArchivo2 = ($txtImagen2 != "") ? $fecha2->getTimestamp() . "_" . $_FILES["txtImagen2"]["name"] : "imagen2.jpg";
        $fecha3 = new DateTime();
        $nombreArchivo3 = ($txtImagen3 != "") ? $fecha3->getTimestamp() . "_" . $_FILES["txtImagen3"]["name"] : "imagen3.jpg";
        $fecha4 = new DateTime();
        $nombreArchivo4 = ($txtImagenQR != "") ? $fecha4->getTimestamp() . "_" . $_FILES["txtImagenQR"]["name"] : "imagenQR.jpg";
        $fecha5 = new DateTime();
        $nombreArchivo5 = ($txtImagenTienda != "") ? $fecha5->getTimestamp() . "_" . $_FILES["txtImagenTienda"]["name"] : "imagenTienda.jpg";


        $tmpImagen = $_FILES["txtImagen"]["tmp_name"];
        $tmpImagen2 = $_FILES["txtImagen2"]["tmp_name"];
        $tmpImagen3 = $_FILES["txtImagen3"]["tmp_name"];
        $tmpImagenQR = $_FILES["txtImagenQR"]["tmp_name"];
        $tmpImagenTienda = $_FILES["txtImagenTienda"]["tmp_name"];

        if ($tmpImagen != "") {
            move_uploaded_file($tmpImagen, "../../img/" . $nombreArchivo);
        }
        if ($tmpImagen2 != "") {
            move_uploaded_file($tmpImagen2, "../../img2/" . $nombreArchivo2);
        }
        if ($tmpImagen3 != "") {
            move_uploaded_file($tmpImagen3, "../../img3/" . $nombreArchivo3);
        }
        if ($tmpImagenQR != "") {
            move_uploaded_file($tmpImagenQR, "../../imgQR/" . $nombreArchivo4);
        }
        if ($tmpImagenTienda != "") {
            move_uploaded_file($tmpImagenTienda, "../../imgTienda/" . $nombreArchivo5);
        }


        $sentenciaSQL->bindParam(':imagen', $nombreArchivo);
        $sentenciaSQL->bindParam(':distrito', $txtDistrito);
        $sentenciaSQL->bindParam(':direccion', $txtDireccion);

        $sentenciaSQL->bindParam(':telefono', $txtTelefono); //telefono, horario, tarifa_dia, tarifa_noche, medio_pago
        $sentenciaSQL->bindParam(':horario', $txtHorario);
        $sentenciaSQL->bindParam(':tarifa_dia', $txtTarifaDia);
        $sentenciaSQL->bindParam(':tarifa_noche', $txtTarifaNoche);
        $sentenciaSQL->bindParam(':medio_pago', $txtMedioPago);
        $sentenciaSQL->bindParam(':imagen2', $nombreArchivo2);
        $sentenciaSQL->bindParam(':imagen3', $nombreArchivo3);
        $sentenciaSQL->bindParam(':imagen_qr', $nombreArchivo4);
        $sentenciaSQL->bindParam(':imagen_tienda', $nombreArchivo5);

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

        // Bug: Si agrega bien, pero no funciona el modificar fotos ya que se queda tal como esta
        if ($txtImagen != "") {
            $fecha = new DateTime();
            $nombreArchivo = ($txtImagen != "") ? $fecha->getTimestamp() . "_" . $_FILES["txtImagen"]["name"] : "imagen.jpg";
            $tmpImagen = $_FILES["txtImagen"]["tmp_name"];
            move_uploaded_file($tmpImagen, "../../img/" . $nombreArchivo);

            // $fecha2 = new DateTime();
            // $nombreArchivo2 = ($txtImagen2 != "") ? $fecha2->getTimestamp() . "_" . $_FILES["txtImagen2"]["name"] : "imagen2.jpg";
            // $tmpImagen2 = $_FILES["txtImagen2"]["tmp_name"];
            // move_uploaded_file($tmpImagen2, "../../img2/" . $nombreArchivo2);

            // $fecha3 = new DateTime();
            // $nombreArchivo3 = ($txtImagen3 != "") ? $fecha3->getTimestamp() . "_" . $_FILES["txtImagen3"]["name"] : "imagen3.jpg";
            // $tmpImagen3 = $_FILES["txtImagen3"]["tmp_name"];
            // move_uploaded_file($tmpImagen3, "../../img3/" . $nombreArchivo3);

            // $fecha4 = new DateTime();
            // $nombreArchivo4 = ($txtImagenQR != "") ? $fecha4->getTimestamp() . "_" . $_FILES["txtImagenQR"]["name"] : "imagenQR.jpg";
            // $tmpImagenQR = $_FILES["txtImagenQR"]["tmp_name"];
            // move_uploaded_file($tmpImagenQR, "../../imgQR/" . $nombreArchivo4);

            $sentenciaSQL = $conexion->prepare("SELECT imagen FROM libros WHERE id=:id");
            $sentenciaSQL->bindParam(':id', $txtID);
            $sentenciaSQL->execute();
            $libro = $sentenciaSQL->fetch(PDO::FETCH_LAZY);


            if (isset($libro["imagen"]) && ($libro["imagen"] != "imagen.jpg")) {
                if (file_exists("../../img/" . $libro["imagen"])) {
                    unlink("../../img/" . $libro["imagen"]);
                }
            }
            // if (isset($libro["imagen2"]) && ($libro["imagen2"] != "imagen2.jpg")) {
            //     if (file_exists("../../img2/" . $libro["imagen2"])) {
            //         unlink("../../img2/" . $libro["imagen2"]);
            //     }
            // }
            // if (isset($libro["imagen3"]) && ($libro["imagen3"] != "imagen3.jpg")) {
            //     if (file_exists("../../img3/" . $libro["imagen3"])) {
            //         unlink("../../img3/" . $libro["imagen3"]);
            //     }
            // }
            // if (isset($libro["imagen_qr"]) && ($libro["imagen_qr"] != "imagenQR.jpg")) {
            //     if (file_exists("../../imgQR/" . $libro["imagen_qr"])) {
            //         unlink("../../imgQR/" . $libro["imagen_qr"]);
            //     }
            // }

            $sentenciaSQL = $conexion->prepare("UPDATE libros SET imagen=:imagen,distrito=:distrito,direccion=:direccion,telefono=:telefono,horario=:horario,tarifa_dia=:tarifa_dia,tarifa_noche=:tarifa_noche,medio_pago=:medio_pago WHERE id=:id");
            $sentenciaSQL->bindParam(':imagen', $nombreArchivo);
            $sentenciaSQL->bindParam(':distrito', $txtDistrito);
            $sentenciaSQL->bindParam(':direccion', $txtDireccion);

            $sentenciaSQL->bindParam(':telefono', $txtTelefono); //telefono, horario, tarifa_dia, tarifa_noche, medio_pago
            $sentenciaSQL->bindParam(':horario', $txtHorario);
            $sentenciaSQL->bindParam(':tarifa_dia', $txtTarifaDia);
            $sentenciaSQL->bindParam(':tarifa_noche', $txtTarifaNoche);
            $sentenciaSQL->bindParam(':medio_pago', $txtMedioPago);

            // $sentenciaSQL->bindParam(':imagen2', $nombreArchivo2);
            // $sentenciaSQL->bindParam(':imagen3', $nombreArchivo3);
            // $sentenciaSQL->bindParam(':imagen_qr', $nombreArchivo4);

            $sentenciaSQL->bindParam(':id', $txtID);
            $sentenciaSQL->execute();
        }

        if ($txtImagen2 != "") {

            $fecha2 = new DateTime();
            $nombreArchivo2 = ($txtImagen2 != "") ? $fecha2->getTimestamp() . "_" . $_FILES["txtImagen2"]["name"] : "imagen2.jpg";
            $tmpImagen2 = $_FILES["txtImagen2"]["tmp_name"];
            move_uploaded_file($tmpImagen2, "../../img2/" . $nombreArchivo2);

            $sentenciaSQL = $conexion->prepare("SELECT imagen2 FROM libros WHERE id=:id");
            $sentenciaSQL->bindParam(':id', $txtID);
            $sentenciaSQL->execute();
            $libro = $sentenciaSQL->fetch(PDO::FETCH_LAZY);

            if (isset($libro["imagen2"]) && ($libro["imagen2"] != "imagen2.jpg")) {
                if (file_exists("../../img2/" . $libro["imagen2"])) {
                    unlink("../../img2/" . $libro["imagen2"]);
                }
            }

            $sentenciaSQL = $conexion->prepare("UPDATE libros SET imagen2=:imagen2,distrito=:distrito,direccion=:direccion,telefono=:telefono,horario=:horario,tarifa_dia=:tarifa_dia,tarifa_noche=:tarifa_noche,medio_pago=:medio_pago,imagen2=:imagen2 WHERE id=:id");
            $sentenciaSQL->bindParam(':imagen2', $nombreArchivo2);
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

        if ($txtImagen3 != "") {

            $fecha3 = new DateTime();
            $nombreArchivo3 = ($txtImagen3 != "") ? $fecha3->getTimestamp() . "_" . $_FILES["txtImagen3"]["name"] : "imagen3.jpg";
            $tmpImagen3 = $_FILES["txtImagen3"]["tmp_name"];
            move_uploaded_file($tmpImagen3, "../../img3/" . $nombreArchivo3);

            $sentenciaSQL = $conexion->prepare("SELECT imagen3 FROM libros WHERE id=:id");
            $sentenciaSQL->bindParam(':id', $txtID);
            $sentenciaSQL->execute();
            $libro = $sentenciaSQL->fetch(PDO::FETCH_LAZY);

            if (isset($libro["imagen3"]) && ($libro["imagen3"] != "imagen3.jpg")) {
                if (file_exists("../../img3/" . $libro["imagen3"])) {
                    unlink("../../img3/" . $libro["imagen3"]);
                }
            }

            $sentenciaSQL = $conexion->prepare("UPDATE libros SET imagen3=:imagen3,distrito=:distrito,direccion=:direccion,telefono=:telefono,horario=:horario,tarifa_dia=:tarifa_dia,tarifa_noche=:tarifa_noche,medio_pago=:medio_pago WHERE id=:id");
            $sentenciaSQL->bindParam(':imagen3', $nombreArchivo3);
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

        if ($txtImagenQR != "") {
            $fecha4 = new DateTime();
            $nombreArchivo4 = ($txtImagenQR != "") ? $fecha4->getTimestamp() . "_" . $_FILES["txtImagenQR"]["name"] : "imagenQR.jpg";
            $tmpImagenQR = $_FILES["txtImagenQR"]["tmp_name"];
            move_uploaded_file($tmpImagenQR, "../../imgQR/" . $nombreArchivo4);

            $sentenciaSQL = $conexion->prepare("SELECT imagen_qr FROM libros WHERE id=:id");
            $sentenciaSQL->bindParam(':id', $txtID);
            $sentenciaSQL->execute();
            $libro = $sentenciaSQL->fetch(PDO::FETCH_LAZY);

            if (isset($libro["imagen_qr"]) && ($libro["imagen_qr"] != "imagenQR.jpg")) {
                if (file_exists("../../imgQR/" . $libro["imagen_qr"])) {
                    unlink("../../imgQR/" . $libro["imagen_qr"]);
                }
            }

            $sentenciaSQL = $conexion->prepare("UPDATE libros SET imagen_qr=:imagen_qr,distrito=:distrito,direccion=:direccion,telefono=:telefono,horario=:horario,tarifa_dia=:tarifa_dia,tarifa_noche=:tarifa_noche,medio_pago=:medio_pago WHERE id=:id");
            $sentenciaSQL->bindParam(':imagen_qr', $nombreArchivo4);
            $sentenciaSQL->bindParam(':distrito', $txtDistrito);
            $sentenciaSQL->bindParam(':direccion', $txtDireccion);

            $sentenciaSQL->bindParam(':telefono', $txtTelefono); //telefono, horario, tarifa_dia, tarifa_noche, medio_pago
            $sentenciaSQL->bindParam(':horario', $txtHorario);
            $sentenciaSQL->bindParam(':tarifa_dia', $txtTarifaDia);
            $sentenciaSQL->bindParam(':tarifa_noche', $txtTarifaNoche);
            $sentenciaSQL->bindParam(':medio_pago', $txtMedioPago);

            // $sentenciaSQL->bindParam(':imagen2', $nombreArchivo2);
            // $sentenciaSQL->bindParam(':imagen3', $nombreArchivo3);
            // $sentenciaSQL->bindParam(':imagen_qr', $nombreArchivo4);

            $sentenciaSQL->bindParam(':id', $txtID);
            $sentenciaSQL->execute();
        }
        if ($txtImagenTienda != "") {
            $fecha5 = new DateTime();
            $nombreArchivo5 = ($txtImagenTienda != "") ? $fecha5->getTimestamp() . "_" . $_FILES["txtImagenTienda"]["name"] : "imagenTienda.jpg";
            $tmpImagenTienda = $_FILES["txtImagenTienda"]["tmp_name"];
            move_uploaded_file($tmpImagenTienda, "../../imgTienda/" . $nombreArchivo5);

            $sentenciaSQL = $conexion->prepare("SELECT imagen_tienda FROM libros WHERE id=:id");
            $sentenciaSQL->bindParam(':id', $txtID);
            $sentenciaSQL->execute();
            $libro = $sentenciaSQL->fetch(PDO::FETCH_LAZY);

            if (isset($libro["imagen_tienda"]) && ($libro["imagen_tienda"] != "imagenTienda.jpg")) {
                if (file_exists("../../imgTienda/" . $libro["imagen_tienda"])) {
                    unlink("../../imgTienda/" . $libro["imagen_tienda"]);
                }
            }

            $sentenciaSQL = $conexion->prepare("UPDATE libros SET imagen_tienda=:imagen_tienda,distrito=:distrito,direccion=:direccion,telefono=:telefono,horario=:horario,tarifa_dia=:tarifa_dia,tarifa_noche=:tarifa_noche,medio_pago=:medio_pago WHERE id=:id");
            $sentenciaSQL->bindParam(':imagen_tienda', $nombreArchivo5);
            $sentenciaSQL->bindParam(':distrito', $txtDistrito);
            $sentenciaSQL->bindParam(':direccion', $txtDireccion);

            $sentenciaSQL->bindParam(':telefono', $txtTelefono); //telefono, horario, tarifa_dia, tarifa_noche, medio_pago
            $sentenciaSQL->bindParam(':horario', $txtHorario);
            $sentenciaSQL->bindParam(':tarifa_dia', $txtTarifaDia);
            $sentenciaSQL->bindParam(':tarifa_noche', $txtTarifaNoche);
            $sentenciaSQL->bindParam(':medio_pago', $txtMedioPago);

            // $sentenciaSQL->bindParam(':imagen2', $nombreArchivo2);
            // $sentenciaSQL->bindParam(':imagen3', $nombreArchivo3);
            // $sentenciaSQL->bindParam(':imagen_qr', $nombreArchivo4);

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

        $txtImagen2 = $libro['imagen2'];
        $txtImagen3 = $libro['imagen3'];
        $txtImagenQR = $libro['imagen_qr'];
        $txtImagenTienda = $libro['imagen_tienda'];

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

        if (isset($libro["imagen2"]) && ($libro["imagen2"] != "imagen2.jpg")) {
            if (file_exists("../../img2/" . $libro["imagen2"])) {
                unlink("../../img2/" . $libro["imagen2"]);
            }
        }

        if (isset($libro["imagen3"]) && ($libro["imagen3"] != "imagen3.jpg")) {
            if (file_exists("../../img3/" . $libro["imagen3"])) {
                unlink("../../img3/" . $libro["imagen3"]);
            }
        }

        if (isset($libro["imagen_qr"]) && ($libro["imagen_qr"] != "imagenQR.jpg")) {
            if (file_exists("../../imgQR/" . $libro["imagen_qr"])) {
                unlink("../../imgQR/" . $libro["imagen_qr"]);
            }
        }
        if (isset($libro["imagen_tienda"]) && ($libro["imagen_tienda"] != "imagenTienda.jpg")) {
            if (file_exists("../../imgTienda/" . $libro["imagen_tienda"])) {
                unlink("../../imgTienda/" . $libro["imagen_tienda"]);
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


<div class="col-md-12">

    <div class="card">
        <div class="card-header bg-success text-white">
            Datos de Libro
        </div>
        <div class="card-body">
            <form class="d-flex" method="post" enctype="multipart/form-data">

                <div class="col-3">
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
                </div>
                <div class="col-3">


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
                        <label for="txtDireccion">Tarifa Día en soles:</label>
                        <input type="text" class="form-control" value="<?php echo $txtTarifaDia; ?>" name="txtTarifaDia" id="txtTarifaDia" placeholder="Ingrese tarifa dia">
                    </div>
                </div>
                <div class="col-3">

                    <div class="form-group">
                        <label for="txtDireccion">Tarifa Noche en soles:</label>
                        <input type="text" class="form-control" value="<?php echo $txtTarifaNoche; ?>" name="txtTarifaNoche" id="txtTarifaNoche" placeholder="Ingrese tarifa noche">
                    </div>

                    <div class="form-group">
                        <label for="txtDireccion">Medio de pago:</label>
                        <input type="text" class="form-control" value="<?php echo $txtMedioPago; ?>" name="txtMedioPago" id="txtMedioPago" placeholder="Ingrese medio de pago">
                    </div>

                    <div class="form-group">
                        <label for="txtImagen2">Imagen2:</label>

                        <br>
                        <?php if ($txtImagen2 != "") { ?>
                            <img class="img-thumbnail rounded" src="../../img2/<?php echo $txtImagen2; ?>" width="50" alt="">
                        <?php } ?>

                        <input type="file" class="form-control" name="txtImagen2" id="txtImagen2" placeholder="Nombre del libro 2">
                    </div>
                    <div class="form-group">
                        <label for="txtImagen2">Imagen3:</label>

                        <br>
                        <?php if ($txtImagen3 != "") { ?>
                            <img class="img-thumbnail rounded" src="../../img3/<?php echo $txtImagen3; ?>" width="50" alt="">
                        <?php } ?>

                        <input type="file" class="form-control" name="txtImagen3" id="txtImagen3" placeholder="Nombre del libro 3">
                    </div>
                </div>
                <div class="col-3">
                    <div class="form-group">
                        <label for="txtImagen2">ImagenQR:</label>

                        <br>
                        <?php if ($txtImagenQR != "") { ?>
                            <img class="img-thumbnail rounded" src="../../imgQR/<?php echo $txtImagenQR; ?>" width="50" alt="">
                        <?php } ?>

                        <input type="file" class="form-control" name="txtImagenQR" id="txtImagenQR" placeholder="Nombre del libro QR">
                    </div>
                    <div class="form-group">
                        <label for="txtImagenTienda">Imagen Tienda:</label>

                        <br>
                        <?php if ($txtImagenTienda != "") { ?>
                            <img class="img-thumbnail rounded" src="../../imgTienda/<?php echo $txtImagenTienda; ?>" width="50" alt="">
                        <?php } ?>

                        <input type="file" class="form-control" name="txtImagenTienda" id="txtImagenTienda" placeholder="Nombre del libro Tienda">
                    </div>

                    <!-- Activar desactivar botones -->

                    <div class="btn-group" role="group" aria-label="">
                        <button type="submit" name="accion" <?php echo ($accion == "Seleccionar") ? "disabled" : ""; ?> value="Agregar" class="btn btn-success mx-2">Agregar</button>
                        <button type="submit" name="accion" <?php echo ($accion != "Seleccionar") ? "disabled" : ""; ?> value="Modificar" class="btn btn-warning mx-2">Modificar</button>
                        <button type="submit" name="accion" <?php echo ($accion != "Seleccionar") ? "disabled" : ""; ?> value="Cancelar" class="btn btn-info mx-2">Cancelar</button>
                    </div>
                </div>


            </form>
        </div>
    </div>




</div>
<!-- TABLAAAAAAAAA -->
<div class="col-md-12 mt-2">
    <table class="table table-bordered">
        <thead class="bg-success text-white">
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
                <th>Imagen 2</th>
                <th>Imagen 3</th>
                <th>Imagen QR</th>
                <th>Imagen Tienda</th>


                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($listaLibros as $libro) { ?>
                <tr>
                    <!-- Estos datos deben coincidir con los nomrbres de los campos de la bd -->
                    <td><?php echo $libro['id']; ?></td>
                    <td><?php echo $libro['nombre']; ?></td>
                    <td><img class="img-thumbnail rounded" src="../../img/<?php echo $libro['imagen']; ?>" width="150" alt=""></td>
                    <td><?php echo $libro['distrito']; ?></td>
                    <td><?php echo $libro['direccion']; ?></td>

                    <!-- telefono, horario, tarifa_dia, tarifa_noche, medio_pago -->
                    <td><?php echo $libro['telefono']; ?></td>
                    <td><?php echo $libro['horario']; ?></td>
                    <td><?php echo $libro['tarifa_dia']; ?></td>
                    <td><?php echo $libro['tarifa_noche']; ?></td>
                    <td><?php echo $libro['medio_pago']; ?></td>
                    <td><img class="img-thumbnail rounded" src="../../img2/<?php echo $libro['imagen2']; ?>" width="150" alt=""></td>
                    <td><img class="img-thumbnail rounded" src="../../img3/<?php echo $libro['imagen3']; ?>" width="150" alt=""></td>
                    <td><img class="img-thumbnail rounded" src="../../imgQR/<?php echo $libro['imagen_qr']; ?>" width="150" alt=""></td>
                    <td><img class="img-thumbnail rounded" src="../../imgTienda/<?php echo $libro['imagen_tienda']; ?>" width="150" alt=""></td>


                    <td>

                        <form method="post">

                            <input type="hidden" name="txtID" id="txtUD" value="<?php echo $libro['id']; ?>">
                            <input type="submit" name="accion" value="Seleccionar" class="btn btn-primary my-1">
                            <input type="submit" name="accion" value="Borrar" class="btn btn-danger my-1">

                        </form>

                    </td>
                </tr>
            <?php }  ?>
        </tbody>
    </table>
</div>

<?php include("../template/pie.php") ?>