<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require '../vendor/autoload.php';
require_once "_medoo.php";
require 'php/usuario.php';
require 'php/session.php';
$idusuario=$_SESSION['idusuario'];
$usuario=getusuario($idusuario);

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
    </nav>
    <div class="row">
        <div class="col" >
            <h2>Registro CASII-On</h2>
            <p><?php echo $usuario['nombre'].' '.$usuario['apellido'];?>  </p>
            <h3>Comprobante</h3>
            <div>
                <img src="<?php echo $usuario['pago'];?>" style="max-height: 600px">
            </div>

            <p>Estado <?php
                echo $idusuario;
                ?>: <div class="btn btn-primary">
                <?php
                echo $usuario['estadopago'];
                ?></div></p>
        </div>
    </div>
</div>
<?php
include "_footer.php";
?></body>

<script src="../vendor/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
</html>

