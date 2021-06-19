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
//    header("Location:formularioregistro.php");
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
<?php
include "_head.php";
?>
<body>
<div class="container" style="background-color: #dddddd;">
    <nav class="nav nav-pills nav-justified">
        <a class="nav-link" aria-current="page" href="index.php"><img src="img/favicon-32x32.png" ></a>
        <a class="nav-link" aria-current="page" href="formularioregistro.php">Registro</a>
        <a class="nav-link" href="formulariocomprobante.php">Pago</a>
        <a class="nav-link" href="evento.php">Evento</a>
        <a class="nav-link active" href="asistencia.php">Asistencia</a>
    </nav>
    <div class="row">
        <div class="col" >
            <h2>Asistencia</h2>
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
