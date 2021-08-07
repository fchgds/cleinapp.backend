<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once $_SERVER['DOCUMENT_ROOT'].'/vendor/autoload.php';

include("../_medoo.php");
include("../php/usuario.php");
require "adminsession.php";

if(isset($_GET['validar'])&&isset($_GET['idusuario']))
{
    $idusuario=htmlspecialchars($_GET['idusuario']);
    $estado=htmlspecialchars($_GET['validar']);
    updateestadousuario($idusuario,$estado);
}

if(isset($_GET['idusuario']))
{
    $idusuario=$_GET['idusuario'];
    $usuario=getusuario($idusuario);
}


?>
<?php
include "_head.php";
?>
<body style="background: gray;">
<div class="container" style="background: white;">
    <div class="row">
        <div class="col" >
            <h2><a href="<?php echo $_SESSION['url'];?>" > Volver </a></h2>
            <h2>Registro CASII-On</h2>
            <h3>Comprobante</h3>
            <div>
                <img src="../<?php echo $usuario['pago'];?>" style="height:600px;">
            </div>

            <p>Estado
                <a class="btn btn-primary btn-lg">
                <?php
                echo $usuario['estadopago'];
                ?></a>
            <hr />
                <a class="btn btn-primary btn-lg" href="validarpago.php?validar=Valido&idusuario=<?php echo $idusuario;?>">Válido</a>
                <a class="btn btn-primary btn-lg" href="validarpago.php?validar=Rechazado&idusuario=<?php echo $idusuario;?>">Rechazado</a>
                <a class="btn btn-primary btn-lg" href="validarpago.php?validar=Pendiente&idusuario=<?php echo $idusuario;?>">Pendiente</a>
                </p>
        </div>
    </div>
</div>
</body>
<?php
include "_footer.php";
?>
