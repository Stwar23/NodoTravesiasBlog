<?php
session_start();
if ($_POST) {
    include("config/conexion.php");

    $usuario = (isset($_POST['usuario'])) ? $_POST['usuario'] : "";
    $contrasena = (isset($_POST['contrasena'])) ? $_POST['contrasena'] : "";

    $sentenciaCom = $conn->prepare("SELECT DOC_USUARIO,NOMBRE_USUARIO,ROL_USUARIO
    FROM USUARIO
    WHERE DOC_USUARIO = :doc_int AND CONTRASENA_USUARIO = :con_int;");

    $sentenciaCom->bindParam(':doc_int', $usuario);
    $sentenciaCom->bindParam(':con_int', $contrasena);
    $sentenciaCom->execute();
    $validacion = $sentenciaCom->fetch(PDO::FETCH_LAZY);

    if ($validacion != null) {
        $_SESSION['NOM_USER'] = $validacion['NOMBRE_USUARIO'];
        $_SESSION['ROL'] = $validacion['ROL_USUARIO'];
        header('Location:vistas/Blog.php');
    } else {
        $mensaje = "Error: usuario o contraseña invalidos";
    }
}
?>

<!doctype html>
<html lang="es">

<head>
    <title>Login</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="vistas/Login.css"> 
    <link rel="icon" href="vistas/Images/logo.png">
</head>
</body>
<div class="container">
    <div class="row">
        <div class="col-md-4">
        </div>
        <div class="col-md-4">
            <br><br><br>
            <div class="card">
                <div class="card-header text-center">
                    <img src="vistas/Images/logo.png" alt="" width="65" height="auto">
                    <br>
                    Iniciar sesión
                </div>
                <div class="card-body ">
                    <?php if (isset($mensaje)) { ?>
                        <div class="alert alert-danger" role="alert">
                            <strong><?php echo $mensaje; ?></strong>
                        </div>
                    <?php } ?>
                    <form method="POST">
                        <div class="form-group">
                            <label>Usuario</label>
                            <input type="text" class="form-control" name="usuario" id="usuario" placeholder="Escribe tu usuario">
                        </div>
                        <br>
                        <div class="form-group">
                            <label>Contraseña</label>
                            <input type="password" class="form-control" name="contrasena" id="contrasena" placeholder="Escribe tu contraseña">
                        </div>
                        <br>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary ">Ingresar</button>
                        </div>
                        <label for="">¿No tienes usuario?</label>
                        <a href="vistas/Registro.php">
                                <span></span> Crea uno
                        </a>
                    </form>    
                </div>
               
            </div>
            <div class="col-md-4">
            </div>
            
        </div>
    </div>
    </body>

</html>