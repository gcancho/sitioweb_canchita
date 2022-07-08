<?php include("template/cabecera.php") ?>

<div class="col-md-12 text-center">
    <div>
        <h1 class="display-3">Bienvenido <?php echo $nombreUsuario; ?></h1>
        <hr class="my-2">
        <img src="../imagenes/admin-canchita.png" width="300px" alt="">
        <p class="lead">Vamos a administrar nuestras canchitas en nuestro sitio web</p>
        <a class="btn btn-primary btn-lg" href="seccion/productos.php" role="button">Administrar canchitas</a>
    </div>
</div>

<?php include("template/pie.php") ?>