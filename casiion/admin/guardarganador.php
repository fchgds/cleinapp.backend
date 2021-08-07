<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once ($_SERVER['DOCUMENT_ROOT'].'/vendor/autoload.php');

include("../_medoo.php");
include("../php/usuario.php");

require_once "adminsession.php";

if(isset($_GET['idusuario']))
{
    $idusuario=$_GET['idusuario'];
    $idactividad=$_GET['idactividad'];
    $usuario=getusuario($idusuario);
}

if(isset($_GET['eliminar']))
{
    $idusuario=$_GET['eliminar'];
    $usuario=getusuario($idusuario);
    eliminarganador($idusuario);
    echo "Premio Eliminado";
}

if(isset($_POST['idusuario']))
{
    $idusuario=$_POST['idusuario'];
    $premio=$_POST['premio'];
    guardarganador($idusuario,$premio);
    echo "Premio Guardado";
}





include "_head.php";
?>
<body style="background: gray;">
<div class="container" style="background: white;">
    <div class="row">
        <div class="col" >
            <h2><a class="btn btn-info" href="sorteoporactividad.php?idactividad=<?php echo $idactividad;?>"> Volver </a></h2>
            <h2>Registro Ganadores</h2>
            <form id="formulario" method="post">
                <input class="form-control" type="hidden" id="idusuario" name="idusuario" value="<?php echo $usuario['idusuario'];?>" required>
                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <?php echo $usuario['nombre'].' '.$usuario['apellido']; ?>
                </div>
                <div class="form-group">
                    <label for="nombre">Premio</label>
                    <input class="form-control" id="premio" name="premio" value="" required>
                </div>
                <div id="buttonConfirmo" class="align-content-center">
                    <button class="btn btn-primary btn-lg" type="submit">Guardar Premio</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="container" style="background: white;">
    <div class="row">
        <div class="col" >
            <?php
            include "listaganadores.php";
            ?>
        </div>
    </div>
</div>
</body>
<?php
include "_footer.php";

function guardarganador($idusuario,$premio)
{
    global $database;
    $data=$database->insert("ganadores"
        ,[
            'idusuario'=>$idusuario,
            'premio'=>$premio
        ]
    );
}



function eliminarganador($idganador)
{
    global $database;
    $data=$database->delete("ganadores",
        [
            "idganador"=>$idganador
        ]
    );
    return $data;
}


