<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require '../vendor/autoload.php';
require_once "_medoo.php";
require_once "_mediospago.php";
require_once "php/session.php";
require_once "php/usuario.php";

if(isset($_SESSION['idusuario']))
{
    $idusuario=$_SESSION['idusuario'];
    $usuario=getusuario($idusuario);
}
else
{
    header("Location:formularioregistro.php");
}



?>
<?php
include "_head.php";
?>
<body>
<div class="container" style="background-color: #dddddd;">
    <nav class="nav nav-pills nav-justified">
        <a class="nav-link" aria-current="page" href="../index.php"><img src="img/favicon-32x32.png" ></a>
        <a class="nav-link " aria-current="page" href="formularioregistro.php">Registro</a>
        <a class="nav-link active" href="formulariocomprobante.php">Pago</a>
        <a class="nav-link " href="evento.php">Evento</a>
        <a class="nav-link" href="asistencia.php">Asistencia</a>
    </nav>
    <div class="row">
        <div class="col" >
            <h2>Registro CASII-On</h2>
            <p><?php echo $usuario['nombre'].' '.$usuario['apellido'];?>  </p>
    <?php
    if($usuario['pago'] != "" )
    {
    ?>
    <h3>Comprobante</h3>
    <div>
        <img src="<?php echo $usuario['pago'];?>" style="max-height: 600px">
    </div>

    <p>Estado <a class="btn btn-primary">
        <?php
        echo $usuario['estadopago'];
        ?></a></p>
    <?php
    }
    ?>
    <?php
    if($usuario['estadopago'] != "Lista Espera" )
    {
    ?>
        <h3>Métodos de Pago</h3>

        <p>Realiza el pago mediante uno de los siguientes métodos:</p>
        <div class="accordion" id="accordionpagos">
            <?php
            global $mediospago;
            foreach($mediospago as $mediodepago)
            {
                mostrarpago($mediodepago['titulo'],$mediodepago['instrucciones']);
            }
            ?>
        </div>

        <h3>y sube a continuación el comprobante</h3>

        <form id="formulario" method="post" enctype="multipart/form-data" action="enviocomprobante.php">
            <input type="hidden" id="idusuario" name="idusuario" value="<?php echo $idusuario; ?>">
            <div class="form-row">
                <label for="fotoComprobante">Foto Comprobante</label>
                <input type="file" name="fotoComprobante" id="fotoComprobante" required>
            </div>

            <br>
            <div id="alertGuardado" class="alert alert-success collapse" role="alert" >
                <p>Datos Registrados</p>
            </div>
            <div id="buttonConfirmo" class="align-content-center">
                <button class="btn btn-primary btn-lg" type="submit">Enviar Comprobante</button>
            </div>

        </form>
        <?php
    }else
    {
        echo'<p>Estado <a class="btn btn-primary">'
        .$usuario['estadopago'].
        '</a></p>
           <p>En estado de Lista Espera, debes esperar a que se libere un cupo para poder realizar el pago.</p>
           <p>Tu estado cambiará a Pendiente y cuando esté disponible tu cupo y podrás ver los medios de pago.</p>
           <p>Revisa tu correo, que te enviaremos un mensaje cuando este tu cupo disponible.</p>';
    }
    ?>

</div>
    </div>
</div>
        <?php
      include "_footer.php";
      ?></body>

<script src="../vendor/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
<script>
    // function guardarformulario()
    // {
    //     $("#buttonConfirmo").enabled=false;
    //     $.ajax({
    //         type: "POST",
    //         url: "api/guardarimagenes.php",
    //         data: $('#formulario').serializeArray(),
    //         success: function(data) {
    //             $("#alertGuardado").fadeIn().delay(5000);
    //             $("#buttonConfirmo").fadeOut();
    //         }
    //     });
    //
    // }
</script>
</html>
