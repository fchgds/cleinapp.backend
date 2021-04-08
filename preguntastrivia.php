<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require 'vendor/autoload.php';
require_once "_medoo.php";
require_once $_SERVER['DOCUMENT_ROOT']."/php/usuario.php";
require_once $_SERVER['DOCUMENT_ROOT']."/php/session.php";
require_once $_SERVER['DOCUMENT_ROOT']."/php/preguntas.php";
require_once $_SERVER['DOCUMENT_ROOT']."/php/respuestas.php";

if(isset($_SESSION['idusuario']))
{
    $idusuario=$_SESSION['idusuario'];
    $idactividad=$_SESSION['idactividad'];
    $usuario=getusuario($idusuario);
}
else
{
    header("Location:formularioregistro.php");
}


if(isset($_POST['idusuario']))
{
    $idusuario=$_POST['idusuario'];
    $idactividad=$_POST['idactividad'];
    $preguntas = preguntastrivia($idactividad);
    $correctas=0;
    foreach($preguntas as $pregunta)
    {
        $idpregunta=$pregunta['idpregunta'];
        $respuesta=$_POST[$pregunta['idpregunta']];

        if($respuesta==$pregunta['respuestacorrecta'])
        {
            $correcta=1;
        }
        else
        {
            $correcta=0;
        }
        guardarrespuestatrivia($idactividad,$idpregunta,$idusuario,$respuesta,$correcta);
        $correctas+=$correcta;
    }

    guardarresultadotrivia($idusuario,$idactividad,$correctas);


    header("Location:preguntassatisfaccion.php");
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
    <title>Preguntas Trivia CASII-On</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-160227993-1"></script>
<!--    <script async src="js/gtag.js"></script>-->
    <script src="vendor/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>

</head>
<body>
<div class="container" style="background-color: #dddddd;">
    <nav class="nav nav-pills nav-justified">
        <a class="nav-link" aria-current="page" href="index.php"><img src="img/favicon-32x32.png" ></a>
        <a class="nav-link" aria-current="page" href="formularioregistro.php">Registro</a>
        <a class="nav-link" href="formulariocomprobante.php">Pago</a>
        <a class="nav-link" href="evento.php">Evento</a>
        <a class="nav-link" href="asistencia.php">Asistencia</a>
        <a class="nav-link active" href="preguntastrivia.php">Trivia</a>
        <a class="nav-link" href="preguntassatisfaccion.php">Satisfacción</a>
    </nav>
    <div class="row">
        <div class="col" >
            <h2>Preguntas Trivia CASII-On</h2>
            <form id="formulario" method="post">
                <input type="hidden" class="form-control" id="idusuario" name="idusuario" value="<?php echo $idusuario; ?>">
                <input type="hidden" class="form-control" id="idactividad" name="idactividad" value="<?php echo $idactividad; ?>">

                <?php
                $preguntas = preguntastrivia($idactividad);

                foreach($preguntas as $pregunta)
                {

                    showpregunta($pregunta['pregunta'],$pregunta['respuestas'],$pregunta['idpregunta']);

                }

                ?>




                <div id="buttonConfirmo" class="align-content-center">
                    <button class="btn btn-primary btn-lg" type="submit">Responder</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php
include "_footer.php";
?></body>


<?php

