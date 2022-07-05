<?php include("template/cabecera.php") ?>
<?php include("administrador/config/bd.php");

$sentenciaSQL = $conexion->prepare("SELECT * FROM libros");
$sentenciaSQL->execute();
$listaLibros = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

// $sentenciaSQL2 = $conexion->prepare("SELECT imagen FROM libros WHERE id=:id");
// $sentenciaSQL2->bindParam(':id', $txtID);
// $sentenciaSQL2->execute();
// $libro2 = $sentenciaSQL->fetch(PDO::FETCH_LAZY);

?>

<?php foreach ($listaLibros as $libro) { ?>
    <div class="col-md-3">
        <div class="card">
            <img class="card-img-top" src="./img/<?php echo $libro['imagen']; ?>" alt="">
            <p><?php echo $libro['id']; ?></p>
            <div class="card-body">
                <h4 class="card-title"><?php echo $libro['nombre']; ?></h4>
                <form action="template/detalleLibro.php" method="post">
                    <!-- <a name="" id="" class="btn btn-primary" href="template/detalleLibro.php" role="button">Ver mas</a> -->
                    <input type="hidden" value="<?php echo $libro['id']; ?>" name="idLibrito">
                    <input class="btn btn-primary" type="submit" value="Ver más">
                </form>
            </div>
        </div>
    </div>
<?php } ?>


<?php include("template/pie.php") ?>