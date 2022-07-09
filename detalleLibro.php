<?php

include("template/cabecera.php");
include("administrador/config/bd.php");


$idObtenido = $_POST['idLibrito'];
// print_r($idObtenido);

$sentenciaSQL = $conexion->prepare("SELECT * FROM libros WHERE id=:id");
$sentenciaSQL->bindParam(':id', $idObtenido);
$sentenciaSQL->execute();
$libro = $sentenciaSQL->fetch(PDO::FETCH_LAZY);

?>

<section class="detalle-cancha py-2 mt-4 border border-dark">
    <div class="row col-12 mx-auto my-2 text-center">
        <h2>Canchita : <?php echo $libro['nombre']; ?></h2>
        <div class="col-12 col-md-6 my-2">
            <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                </div>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="img/<?php echo $libro['imagen']; ?>" class=" d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="img2/<?php echo $libro['imagen2']; ?>" class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="img3/<?php echo $libro['imagen3']; ?>" class="d-block w-100" alt="...">
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
            <!-- <p class="my-2"> Lorem ipsum dolor sit amet consectetur adipisicing elit. Error quia non dolor, voluptates quasi iure. Enim voluptas rem ipsa asperiores quasi, voluptatibus nemo magni animi dolorem a et exercitationem possimus!</p> -->
        </div>
        <div class="col-12 col-md-6 d-flex">
            <div class="col-6 detalle-cancha__datos p-2 ">
                <div><b>Dirección : </b><?php echo $libro['direccion']; ?></div>
                <div><b>Teléfono: </b> <?php echo $libro['telefono']; ?></div>
                <div><b>Horario de atención :</b>
                    <p><?php echo $libro['horario']; ?></p>
                </div>
                <div><b>Precio de alquiler por día : </b>
                    <p>S/ <?php echo $libro['tarifa_dia']; ?></p>
                </div>
                <div><b>Precio de alquiler por noche : </b>
                    <p>S/ <?php echo $libro['tarifa_noche']; ?></p>
                </div>
                <div>
                    <p><b>Estacionamiento</b> : <i class="fa-solid fa-car mx-2"></i><i class="fa-solid fa-motorcycle mx-2"></i><i class="fa-solid fa-person-biking mx-2"></i></p>
                </div>
                <div>
                    <p><b>Servicios</b> : <i class="fa-solid fa-restroom mx-2"></i><i class="fa-solid fa-shower mx-2"></i></i></p>
                </div>
                <div>
                    <!-- <b>Información adicional : </b>
                    <p>Estacionamiento : <i class="fa-solid fa-car mx-2"></i><i class="fa-solid fa-motorcycle mx-2"></i><i class="fa-solid fa-person-biking mx-2"></i></p>
                    <p>Servicios : <i class="fa-solid fa-restroom mx-2"></i><i class="fa-solid fa-shower mx-2"></i></i></p> -->
                    <div class="btn-group">

                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Ver ubicación <i class="fa-solid fa-location-dot"></i></button>
                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Mapa de ubicación</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3901.0843600409403!2d-77.00776848562514!3d-12.106377191427635!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x9105c7de1c70d043%3A0x7331c8024c9a7db2!2sCancha%20El%20Centenario%20de%20San%20Borja!5e0!3m2!1ses-419!2spe!4v1654327936928!5m2!1ses-419!2spe" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal2">Ver tienda<i class="fa-solid fa-shop"></i></button>
                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel2" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel2">Tienda</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <img src="imagenes/tienda-futbol.png" width="600px" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <a href="https://wa.me/51955427033?text=Quiero%20alquilar%20cancha" type="button" class="btn btn-primary mt-2" target="_blank">Ir a Whatsapp<i class="fa-brands fa-whatsapp"></i></a>

                    </div>
                </div>
            </div>
            <div class="col-6">
                <img class="d-block" style="margin:0 auto" width="100px" src="imagenes/logo.png" alt="">
                <img src="imgQR/<?php echo $libro['imagen_qr']; ?>" width="350" alt="">
            </div>
        </div>
    </div>
    <div class="row col-12 comentarios">
        <h3>Comentarios</h3>
        <!-- Comentarios -->
        <div id="fb-root"></div>
        <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v14.0" nonce="qV9VzB3T"></script>
    </div>
    <div class="fb-comments" data-href="http://127.0.0.1:5500/detalle-cancha.html" data-width="" data-numposts="5">
    </div>
    <?php include("template/pie.php"); ?>
</section>
<?php

?>


<!-- width="2048" height="1536"  -->