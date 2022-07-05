<?php
// Ocultar errores
error_reporting(0);


if ($_POST) {
    session_start();
    include("config/bd.php");
    $u = $_POST["usuario"];
    $c = $_POST["contrasenia"];

    // $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sentenciaSQL = $conexion->prepare("SELECT * FROM persona WHERE nombre=:u AND contrasenia=:c");
    $sentenciaSQL->bindParam(":u", $u);
    $sentenciaSQL->bindParam(":c", $c);
    $sentenciaSQL->execute();
    $usuario = $sentenciaSQL->fetch(PDO::FETCH_ASSOC);

    if (($_POST['usuario'] == $usuario["nombre"]) && ($_POST['contrasenia'] == $usuario["contrasenia"])) {
        $_SESSION['usuario'] = "ok";
        $_SESSION['nombreUsuario'] = $usuario["nombre"];
        header("Location:inicio.php");
    } else {
        $mensaje = "Error: El usuario y/o contraseña son incorrectos";
        // echo "a";
        // header("Location:index.php");
    }
}


?>

<!doctype html>
<html lang="en">

<head>
    <title>Administrador</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-md-4">
            </div>
            <div class="col-md-4">
                <br><br><br>
                <div class="card">
                    <div class="card-header">
                        Login
                    </div>
                    <div class="card-body">

                        <?php if (isset($mensaje)) { ?>
                            <div class="alert alert-danger" role="alert">
                                <?php echo $mensaje; ?>
                            </div>
                        <?php } ?>
                        <form method="post">
                            <div class="form-group">
                                <label>Usuario</label>
                                <input type="text" class="form-control" name="usuario" aria-describedby="emailHelp" placeholder="Escribe tu usuario">
                            </div>
                            <div class="form-group">
                                <label>Contraseña:</label>
                                <input type="password" class="form-control" name="contrasenia" placeholder="Escribe tu contraseña">
                            </div>
                            <button type="submit" class="btn btn-primary">Entrar al administrador</button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>

</body>

</html>