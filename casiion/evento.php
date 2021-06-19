<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require '../vendor/autoload.php';
require_once "_medoo.php";
require_once "php/session.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/php/usuario.php";

if(isset($_SESSION['idusuario']))
{
    $idusuario=$_SESSION['idusuario'];
    $usuario=getusuario($idusuario);
    if($usuario['estadopago']=='Valido')
    {

    }
    else
    {
        header("Location:formularioregistro.php");
    }
}
else
{
    header("Location:formularioregistro.php");
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

</head>
<body>
<div class="container" style="background-color: #dddddd;">
    <nav class="nav nav-pills nav-justified">
        <a class="nav-link" aria-current="page" href="../index.php"><img src="img/favicon-32x32.png" ></a>
        <a class="nav-link " aria-current="page" href="formularioregistro.php">Registro</a>
        <a class="nav-link" href="formulariocomprobante.php">Pago</a>
        <a class="nav-link active" href="evento.php">Evento</a>
        <a class="nav-link" href="asistencia.php">Asistencia</a>
    </nav>
    <div class="row">
        <div class="col" >
            <h2>CASII-On</h2>
            <p><?php echo $usuario['nombre'].' '.$usuario['apellido'].' - '.$usuario['pais'];?>  </p>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-3" >
            <div class="card" style="">
                <img class="card-img-top" src="img/taller1.jpg" alt="Taller1" style="width: 100%">
                <div class="card-body">
                    <h5 class="card-title">Lunes 29 de marzo Revolución Inteligente</h5>
                    <p class="card-text"></p>
                    <a href="https://reuna.zoom.us/j/87492577637?pwd=ZEtLRlRSOVhiSzAzODQ3MzBndzRwdz09" class="btn btn-success">Ingresa a Zoom</a>
                    <a href="https://app.sli.do/event/6ggpamkg/live/questions" class="btn btn-success">Sli.do</a>
                    <a href="asistencia.php" class="btn btn-success">Registra tu asistencia</a>
                </div>
            </div>
        </div>
        <div class="col-sm-3" >

            <div class="card" style="">
                <img class="card-img-top" src="img/taller2.jpg" alt="Taller1" style="width: 100%">
                <div class="card-body">
                    <h5 class="card-title">Martes 30 de marzo Eficiencia Energética</h5>
                    <p class="card-text"></p>
                    <a href="https://reuna.zoom.us/j/82603966653?pwd=aXpMZkg5d2hiaU5ab1JqSlhnUWpHZz09" class="btn btn-success">Ingresa a Zoom</a>
                    <a href="https://app.sli.do/event/cpgcbort/live/questions" class="btn btn-success">Sli.do</a>
                    <a href="asistencia.php" class="btn btn-success">Registra tu asistencia</a>
                </div>
            </div>

        </div>
        <div class="col-sm-3" >

            <div class="card" style="">
                <img class="card-img-top" src="img/taller3.jpg" alt="Taller1" style="width: 100%">
                <div class="card-body">
                    <h5 class="card-title">Miércoles 31 de marzo Lean Manufacturing</h5>
                    <p class="card-text"></p>
                    <a href="https://reuna.zoom.us/j/85625035430?pwd=WTYxTUZYdGc4cjJoUFQ3MDB6TS93UT09" class="btn btn-success">Ingresa a Zoom</a>
                    <a href="https://app.sli.do/event/qk7mg3lr/live/questions" class="btn btn-success">Sli.do</a>
                    <a href="asistencia.php" class="btn btn-success">Registra tu asistencia</a>
                </div>
            </div>

        </div>
        <div class="col-sm-3" >

            <div class="card" style="">
                <img class="card-img-top" src="img/taller4.jpg" alt="Taller1" style="width: 100%">
                <div class="card-body">
                    <h5 class="card-title">Jueves 1 de abril Agroindustria</h5>
                    <p class="card-text"></p>
                    <a href="https://reuna.zoom.us/j/81590172648?pwd=L01nNVUyM2taSlBIcUkrdC9wOW5TZz09" class="btn btn-success">Ingresa a Zoom</a>
                    <a href="https://app.sli.do/event/cshj9jos/live/questions" class="btn btn-success">Sli.do</a>
                    <a href="asistencia.php" class="btn btn-success">Registra tu asistencia</a>
                </div>
            </div>
        </div>

    </div>


</div>
<?php
include "_footer.php";
?></body>

<script src="../vendor/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
<script src="js/guardarformulario.js"></script>
<script>
    function next()
    {
        // window.location.replace("inversionistas.php");
    }

    $(document).ready(function() {
        $("#enterasteotrodiv").fadeOut();
        $("#enteraste").change(function(e) {
            e.preventDefault();
            if($("#enteraste option:selected").text()==="Otro")
            {
                $("#enterasteotrodiv").fadeIn();
            }
            else
            {
                $("#enterasteotrodiv").fadeOut();
            }
            // $.ajax({
            //     type: "POST",
            //     url: "guardarformulario.php",
            //     data: $('#formulario').serialize(),
            //     success: function(data) {
            //         next();
            //     }
            // });
            // e.preventDefault();
        });
    });

    function next()
    {
        // window.location.replace("inversionistas.php");
    }
</script>
</script>
</html>

<?php
function selectoptions($options,$selectedoption="")
{
    $match=false;
    foreach($options as $option)
    {
        if($selectedoption===$option)
        {
            $match=true;
            echo "<option value='$option' selected>$option</option>";
        }else
        {
            echo "<option value='$option' >$option</option>";
        }
    }
    if(!$match)
    {
        echo "<option selected hidden></option>";
    }

}
?>
