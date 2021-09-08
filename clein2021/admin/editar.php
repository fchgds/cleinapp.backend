<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once $_SERVER['DOCUMENT_ROOT'].'/vendor/autoload.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/clein2021/_medoo.php";
require_once $_SERVER['DOCUMENT_ROOT'] . '/clein2021/php/usuario.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/clein2021/php/guardarimagenes.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/clein2021/php/certificados.php';
require "adminsession.php";

if(isset($_POST['nombre']))
{
    updateestadousuario($_POST['idusuario'],$_POST['estadopago']);
    global $database;
    $database->update("usuarios",
        [
            "nombre" => $_POST['nombre'],
            "apellido" => $_POST['apellido'],
            "documento" => $_POST['documento'],
            "edad" => $_POST['edad'],
            "pais" => $_POST['pais'],
            "universidad" => $_POST['universidad'],
            "email" => $_POST['email'],
            "modalidad" => $_POST['modalidad'],
            "profesional" => $_POST['profesional'],
            "rol" => $_POST['rol'],
            "telefono" => $_POST['telefono'],
            "estadopago" => $_POST['estadopago']
        ],[
                "idusuario" => $_POST['idusuario']
        ]);
}

if(isset($_GET['idusuario']))
{
    $idusuario=$_GET['idusuario'];
    if(isset($_GET['eliminar']))
    {
        $idusuario=$_GET['idusuario'];
        eliminarusuario($idusuario);
        echo "<h1>Usuario eliminado</h1>";
//        exit;
    }

    if(isset($_GET['eliminarpago']))
    {
        $idusuario=$_GET['idusuario'];
        eliminarpago($idusuario);
        echo "<h1>Comprobante eliminado</h1>";
//        exit;
    }
    $usuario=getusuario($idusuario);
}
else
{
    echo "Usuario no encontrado";
//    exit;
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
            <h2>Registro</h2>
            <form id="formulario" method="post" enctype="multipart/form-data">
                <input class="form-control" type="hidden" id="idusuario" name="idusuario" value="<?php echo $usuario['idusuario'];?>" required>
                <div class="form-group">
                    <label for="nombre">Nombre(s)</label>
                    <input class="form-control" id="nombre" name="nombre" value="<?php echo $usuario['nombre'];?>" required>
                </div>

                <div class="form-group">
                    <label for="apellido">Apellido(s)</label>
                    <input class="form-control" id="apellido" name="apellido" value="<?php echo $usuario['apellido'];?>" required>
                </div>

                <div class="form-group">
                    <label for="documento">Número de Documento (DNI/RUN/CI/Pasaporte)
                    </label>
                    <input class="form-control" type="text" id="documento" name="documento" value="<?php echo $usuario['documento'];?>" required>
                </div>

                <div class="form-group">
                    <label for="edad">Edad
                    </label>
                    <input class="form-control" type="text" id="edad" name="edad" value="<?php echo $usuario['edad'];?>" required>
                </div>

                <div class="form-group">
                    <label for="email">Correo Electrónico
                    </label>
                    <input class="form-control" type="text" id="email" name="email" value="<?php echo $usuario['email'];?>" required>
                </div>

                <div class="form-group">
                    <label for="telefono">Teléfono/Whatsapp</label>
                    <input class="form-control" type="text" id="telefono" name="telefono" value="<?php echo $usuario['telefono'];?>" required>
                </div>

                <div class="form-group">
                    <label for="pais">País
                    </label>
                    <select class="form-control form-select form-select-lg mb-3" id="pais" name="pais" aria-label="pais" required>
                        <?php
                        $options = ["Argentina",
                            "Bolivia",
                            "Chile",
                            "Perú",
                            "Brasil",
                            "Colombia",
                            "Costa Rica",
                            "Cuba",
                            "Ecuador",
                            "El Salvador",
                            "Guatemala",
                            "Honduras",
                            "México",
                            "Nicaragua",
                            "Panamá",
                            "Paraguay",
                            "Puerto Rico",
                            "República Dominicana",
                            "Uruguay",
                            "Venezuela",
                            "Otro"];
                        selectoptions($options, $usuario['pais']);?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="universidad">Universidad/Empresa/Otro</label>
                    <input class="form-control" type="text" id="universidad" name="universidad" value="<?php echo $usuario['universidad'];?>">
                </div>

                <div class="form-group">
                    <label for="modalidad">Modalidad </label>
                    <select class="form-control form-select form-select-lg mb-3" id="modalidad" name="modalidad" aria-label="modalidad" required>
                        <?php
                        $options = ["Presencial",
                            "Online"];
                        selectoptions($options,$usuario['modalidad']);
                        ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="profesional">¿Estudiante o Profesional? </label>
                    <select class="form-control form-select form-select-lg mb-3" id="profesional" name="profesional" aria-label="profesional" required>
                        <?php
                        $options = ["Estudiante",
                            "Profesional"];
                        selectoptions($options,$usuario['profesional']);
                        ?>
                    </select>

                    <div class="form-group">
                        <label for="rol">En calidad de </label>
                        <select class="form-control form-select form-select-lg mb-3" id="rol" name="rol" aria-label="rol" required>
                            <?php
                            $options = ["Participante",
                                "Expositor",
                                "Comité Organizador",
                                "ALEIIAF"];
                            selectoptions($options,$usuario['rol']);
                            ?>
                        </select>
                    </div>


                <div>
                    <?php
                    if($usuario['pago']=="")
                    {
                        echo '<h3>Comprobante no subido</h3>
                        <div class="form-row">
                            <label for="fotoComprobante">Subir Comprobante</label>
                            <input type="file" name="fotoComprobante" id="fotoComprobante">
                        </div>';
                    }
                    else
                    {
                        echo '<h3>Comprobante</h3>
                                <img alt="Comprobante" src="../'.$usuario['pago'].'" style="height:600px;">
                                <a class="btn btn-danger btn-lg" href="editar.php?eliminarpago=eliminar&idusuario='.$idusuario.'">Eliminar Comprobante</a>';
                    }
                    ?>


                </div>

                <div class="form-group">
                    <label for="pais">Estado
                    </label>
                    <select class="form-control form-select form-select-lg mb-3" id="pais" name="estadopago" aria-label="estadopago" required>
                        <?php
                        $options = ["Pendiente",
                            "Espera del Pago",
                            "Valido",
                            "Rechazado",
                            ];
                        selectoptions($options, $usuario['estadopago']);?>
                    </select>
                </div>

                <br>
                <div id="buttonConfirmo" class="align-content-center">
                    <button class="btn btn-primary btn-lg" type="submit">Guardar Cambios</button>

                    <?php
                    if(!getcertificadousuario($idusuario))
//                        {
//                            echo '<a class="btn btn-primary" href="generarcertificados.php?idusuario=' . $idusuario . '">Generar Certificado</a>';
//                        }
//                    else
//                        {
//                           $certificado = getcertificadousuario($idusuario);
//                           $idcertificado = $certificado['idcertificado'];
//                            echo '<a class="btn btn-primary" target="blank" href="' . $certificado['url'] . '">Ver Certificado</a>';
//                            echo '<a class="btn btn-primary" href="generarcertificados.php?eliminar=true&idcertificado=' . $idcertificado . '">Eliminar Certificado</a>';
//                           echo '<a class="btn btn-primary" href="enviarcertificados.php?idcertificado=' . $idcertificado . '">Enviar Certificado</a>';
//                        }
                    ?>
                    <a class="btn btn-danger btn-lg" href="editar.php?eliminar=eliminar&idusuario=<?php echo $idusuario;?>">Eliminar</a>
                </div>
            </form>


        </div>
    </div>
</div>
</body>
<?php
include "_footer.php";

function selectoptions($options, $selectedoption = "")
{
    $match = false;
    foreach ($options as $option) {
        if ($selectedoption === $option) {
            $match = true;
            echo "<option value='$option' selected>$option</option>";
        } else {
            echo "<option value='$option' >$option</option>";
        }
    }
    if (!$match) {
        echo "<option selected hidden></option>";
    }

}
?>
