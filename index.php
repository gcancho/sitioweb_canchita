<?php
include("template/cabecera.php");
include("administrador/config/bd.php");

$sentenciaSQL = $conexion->prepare("SELECT * FROM libros");
$sentenciaSQL->execute();
$listaLibros = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

$sentenciaSQL2 = $conexion->prepare("SELECT DISTINCT distrito FROM libros ORDER BY distrito");
$sentenciaSQL2->execute();
$listaLibros2 = $sentenciaSQL2->fetchAll(PDO::FETCH_ASSOC);

?>

<div class="container-fluid px-0">
    <div class="row">
        <div class="col-6 col-sm-6 col-md-3 border">
            <div class="container-dropdown border px-2 py-4 h-250">
                <div class="dropdown">
                    <label class="mx-2">Buscar por distrito:</label>
                    <select class="form-select my-3" name="lista" id="lista-distritos" onchange="changeFunc();">
                        <option value="Todos">Todos los distritos</option>
                        <option value="Lima">Cercado de Lima</option>
                        <option value="Breña">Breña</option>
                        <option value="SJL">SJL</option>
                        <option value="Miguel">San Miguel</option>
                        <option value="Borja">San Borja</option>
                        <option value="Olivos">Los Olivos</option>
                    </select>
                    <?php  ?>
                </div>
            </div>


            <div class="apoyo-desarrollador text-center">
                <h5>Apoyanos con una donación para el mantenimiento de la página 🙏</h5>
                <img width="80" src="imagenes/logo.png" alt="" />
                <img class="apoyo-desarrollador__img" src="imagenes/qr_gio.jpg" alt="" />
            </div>

            <div style="margin-top: 220px;">
                <h3 class="my-2">¿Si soy dueño de una cancha de fútbol como lo incluyo en el repositorio de "Chapa tu cancha"?</h3>
                <p>Para incluirlo debes comunicarte con nosotros por medio del correo chapatucancha@gmail.com o dandole click al icono de "Valida tu registro aquí".</p>
                <a href="https://wa.me/51955427033?text=Quiero%20publicitar%20mi%20cancha" target="_blank"><img style="display: block;margin: 0 auto;" src="imagenes/validar-registro.png" alt=""></a>
            </div>

        </div>
        <div class="col-6 col-sm-6 col-md-9 border">

            <div class="row canchitas py-4 border border-primary">
                <?php foreach ($listaLibros as $libro) { ?>
                    <!-- Inicio Canchita -->
                    <div class="row col-md-6 col-lg-4 canchita-item py-2 <?php echo $libro["distrito"] ?>" id="<?php echo $libro["distrito"] ?>">
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
                            <p class="my-1" style="font-weight: 500;">Canchita : <?php echo $libro["nombre"]; ?></p>
                            <form class="my-2" action="detalleLibro.php" method="post">
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