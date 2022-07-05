<?php
include("template/cabecera.php");
include("administrador/config/bd.php");

$sentenciaSQL = $conexion->prepare("SELECT * FROM libros");
$sentenciaSQL->execute();
$listaLibros = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="container-fluid px-0">
    <div class="row">
        <div class="col-6 col-sm-6 col-md-3 border">
            <div class="container-dropdown border px-2 py-4 h-250">
                <div class="dropdown">
                    <label class="mx-2">Buscar por :</label>
                    <button class="btn btn-dark dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                        Distritos
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        <li><a class="dropdown-item" href="#">Lima</a></li>
                        <li><a class="dropdown-item" href="#">Magdalena</a></li>
                        <li>
                            <a class="dropdown-item" href="#">San Juan de Lurigancho</a>
                        </li>
                        <li><a class="dropdown-item" href="#">San Borja</a></li>
                    </ul>
                </div>
            </div>
            <div class="apoyo-desarrollador text-center">
                <h5>Apoyanos con una donación para el mantenimiento de la página 🙏</h5>
                <img class="apoyo-desarrollador__img" src="imagenes/yape-qr-1.png" alt="" />

            </div>
        </div>
        <div class="col-6 col-sm-6 col-md-9 border">

            <div class="row canchitas py-4 border border-primary">
                <?php foreach ($listaLibros as $libro) { ?>
                    <!-- Inicio Canchita -->
                    <div class="row col-md-6 col-lg-4 canchita-item">
                        <div class="col-10 container-img-canchita">
                            <div class="canchita-item__distrito"><?php echo $libro["distrito"] ?></div>
                            <img class="img-fluid" src="img/<?php echo $libro['imagen']; ?> ?>" alt="" />
                        </div>
                        <div class="col-2 flex-column">
                            <i class="fa-solid fa-heart"></i>
                            <i class="fa-solid fa-heart"></i>
                            <i class="fa-solid fa-heart"></i>
                            <i class="fa-solid fa-heart"></i>
                            <i class="fa-regular fa-heart"></i>
                        </div>
                        <div>
                            <p><?php echo $libro["nombre"]; ?></p>
                            <form action="detalleLibro.php" method="post">
                                <input type="hidden" value="<?php echo $libro['id']; ?>" name="idLibrito">
                                <input class="btn btn-primary" type="submit" value="Ver más">
                            </form>
                        </div>
                    </div>
                    <!-- Fin canchita -->
                <?php } ?>
            </div>

        </div>
    </div>
    <div class="contacto-cancha text-center">
        <h3>¿Quieres publicitar tu cancha?</h3>
        <a class="btn btn-primary btn-lg px-4 my-4" href="https://wa.me/51955427033?text=Quiero%20publicitar%20mi%20cancha" target="_blank"> Contactar</a>
    </div>

</div>

<!-- Optional JavaScript; choose one of the two! -->

<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

<!-- Option 2: Separate Popper and Bootstrap JS -->
<!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
</body>

</html>

<?php include("template/pie.php") ?>