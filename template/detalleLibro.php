<?php

include("../administrador/config/bd.php");


$idObtenido = $_POST['idLibrito'];
print_r($idObtenido);

$sentenciaSQL2 = $conexion->prepare("SELECT * FROM libros WHERE id=:id");
$sentenciaSQL2->bindParam(':id', $idObtenido);
$sentenciaSQL2->execute();
$libro2 = $sentenciaSQL2->fetch(PDO::FETCH_LAZY);

?>
<div class="col-md-3">
    <p><?php echo $libro2['nombre']; ?></p>
    <img class="card-img-top" src="../img/<?php echo $libro2['imagen']; ?>" alt="">
</div>
<?php

?>