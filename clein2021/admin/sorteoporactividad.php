<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require ($_SERVER['DOCUMENT_ROOT'].'/vendor/autoload.php');

include($_SERVER['DOCUMENT_ROOT'] . "/clein2021/_medoo.php");
include($_SERVER['DOCUMENT_ROOT'] . "/clein2021/php/usuario.php");
include ("nroinscritos.php");
require "adminsession.php";

$idactividad=$_GET['idactividad'];

global $database;

$query = "SELECT `usuarios`.`idusuario`,`usuarios`.`nombre`,`usuarios`.`apellido`,`usuarios`.`email`,`usuarios`.`pais`,`asistencia`.`ingreso`,`asistencia`.`salida`,`asistencia`.`respuestascorrectas` FROM `asistencia` LEFT JOIN `usuarios` USING (`idusuario`) 
WHERE ((`respuestascorrectas` LIKE '%4%' OR `respuestascorrectas` LIKE '%3%') AND `idactividad` = '1' AND idusuario NOT IN (SELECT idusuario FROM ganadores))";

$asistencia=$database->query($query)->fetchAll();
echo "<br><br>";






if(isset($_GET['download']))
{
    $fileName = "asistencia_"."_". date("Y-m-d H.i.s") . ".xlsx";


    downloadxlsx($fileName, $asistencia);



}

function downloadxlsx($fileName, $data)
{
    $header[0]= array_keys($data[0]);
    $dataWithHeader=array_merge($header,$data);

    SimpleXLSXGen::fromArray( $dataWithHeader )->downloadAs($fileName);
}

?>
<?php
include "_head.php";
?>
    <body>

    <div class="container-fluid" style="background-color: #dddddd;">
        <div class="row" id="lista">
        <?php
        listado($asistencia,$idactividad);
        ?>
        </div>

        <?php

//        echo build_table($asistencia);

        echo '<a class="btn btn-primary" href="#" onclick="sorteo()">Realizar Sorteo<span class="badge bg-success">'.count($asistencia).'</span></a>';

        ?>
    </div>
    <script src="../vendor/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
<script>
    <?php
    echo "array=[";
    foreach ($asistencia as $asistente) {
        echo $asistente['idusuario'] . ',';
    }
    echo "]";
    ?>

    function sorteo()
    {
        if(array.length>1)
        {
            ejecutarsorteo();
        }
        else
        {
            location.reload();
        }

    }
    function ejecutarsorteo()
    {

        var i = array.length-1
        animatesorteo(i);

    }

    function animatesorteo(i)
    {
        if(i>=1)
        {
            item=Math.floor(Math.random()*array.length);
            id=array[item];
            array.splice(item, 1);
            $( "#"+id).fadeOut();
            console.log(array);
            i--;
            setTimeout(function() { animatesorteo(i); }, 100);
        }
    }
</script>

<?php
include "_footer.php";
?>



<?php


function listado($asistencia,$idactividad)
{
    foreach ($asistencia as $asistente)
    {
        $nombre = $asistente['nombre']. ' '. $asistente['apellido'];
        $pais=$asistente['pais'];
        echo '<div class="card" id="'.$asistente['idusuario'].'" style="width: 18rem;">
                <a class="lista" href="guardarganador.php?idusuario='.$asistente['idusuario'].'&idactividad='.$idactividad.'" >
                <div class="card-body">
                    <h5 class="card-title">'.$nombre.'</h5>
                    <p>'.$pais.'</p>
                </div>
                </a>
            </div>';
    }
}


function filtropais($filtro)
{
    echo '
    <nav class="nav nav-pills nav-justified">
        <a class="nav-link" href="listadoinscritos.php">Todos<span class="badge bg-secondary">'.count(getusuarios()).'</span></a>';
    $filtrospaises = ["Clein","Argentina","Bolivia","Perú"];
    $nroinscritos=nroinscritos($filtrospaises);
    foreach($filtrospaises as $paises)
    {
        $active = "";
        if($filtro==$paises)
        {
            $active = "active";
        }

        echo '<a class="nav-link '.$active.'" href="listadoinscritos.php?filtropais='.$paises.'">'.$paises.'<span class="badge bg-secondary">'.$nroinscritos[$paises].'</span></a>';
    }

    echo '
        <a class="nav-link" href="logout.php">Logout</a>
        </nav>';
}






function build_table($array)
{
    // start table
    $html = '<table class="table table-striped">';
    // header row
    $html .= '<tr>';
    if(isset($array[0]))
    {
        foreach ($array[0] as $key => $value) {
            $html .= '<th>' . htmlspecialchars($key) . '</th>';
        }
    }
    else
    {
        $html .= '<td>' . "No hay registros" . '</td>';
        $html .= '</tr>';
        $html .= '</table>';
        return $html;
    }
    $html .= '</tr>';

    // data rows

    $previous="";
    $i=1;

    foreach ($array as $key => $value) {
        $html .= '<tr>';
        foreach ($value as $key2 => $value2) {
            if($key2 == "idusuario")
            {
                $html .= '<td><a class="btn btn-primary" href="editar.php?idusuario=' . htmlspecialchars($value2) . '">'. htmlspecialchars($value2).'</a></td>';
//                $html .= '<td>' . htmlspecialchars($value2) . '</td>';
                $idusuario=$value2;
            }else if($key2 == "pago")
            {
                $html .= '<td><a href="validarpago.php?idusuario=' . htmlspecialchars($idusuario) . '">'. htmlspecialchars($value2).'</a></td>';
            }
            else
            {
                $html .= '<td>' . htmlspecialchars($value2) . '</td>';
            }
        }
        $html .= '</tr>';
    }

    // finish table and return it

    $html .= '</table>';
    return $html;
}
