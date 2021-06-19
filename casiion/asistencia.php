<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require '../vendor/autoload.php';
require_once "_medoo.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/php/session.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/php/usuario.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/php/asistencia.php";

if(isset($_SESSION['idusuario']))
{
    $idusuario=$_SESSION['idusuario'];
    $usuario=getusuario($idusuario);
}
else
{
    header("Location:formularioregistro.php");
}


if(isset($_POST['idusuario'])&&isset($_POST['codigo']))
{
    $idusuario=htmlspecialchars($_POST['idusuario']);
    $codigo=htmlspecialchars($_POST['codigo']);

    $result = registrarasistencia($idusuario,$codigo);

    echo $result;
    exit;
}



?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Registro CASII-On</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-160227993-1"></script>
<!--    <script async src="js/gtag.js"></script>-->
    <script src="../vendor/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>

</head>
<body>
<div class="container" style="background-color: #dddddd;">
    <nav class="nav nav-pills nav-justified">
        <a class="nav-link" aria-current="page" href="../index.php"><img src="img/favicon-32x32.png" ></a>
        <a class="nav-link" aria-current="page" href="formularioregistro.php">Registro</a>
        <a class="nav-link" href="formulariocomprobante.php">Pago</a>
        <a class="nav-link" href="evento.php">Evento</a>
        <a class="nav-link active" href="asistencia.php">Asistencia</a>
    </nav>
    <div class="row">
        <div class="col" >
            <h2>Asistencia CASII-On</h2>
            <p><?php echo $usuario['nombre'].' '.$usuario['apellido'].' - '.$usuario['pais'];?>  </p>

            <form id="formulario" method="post">
                <input type="hidden" class="form-control" id="idusuario" name="idusuario" value="<?php echo $idusuario; ?>">
                <br>
                <div class="form-group">
                    <label for="codigo">Código</label>
                    <input class="form-control" id="codigo" name="codigo" value="" required>
                </div>
                <br>
                <div id="buttonConfirmo" class="align-content-center">
                    <button class="btn btn-primary btn-lg" type="submit">Registrar mi asistencia</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php
include "_footer.php";
?></body>
