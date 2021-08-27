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
$asistencia=$database->select("asistencia",[
    "[>]usuarios" => "idusuario",
],[
        'usuarios.idusuario',
        'usuarios.nombre',
        'usuarios.apellido',
        'usuarios.email',
        'asistencia.ingreso',
        'asistencia.salida',
        'asistencia.respuestascorrectas'
    ]
    ,[
        'idactividad'=>$idactividad
    ]
);

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
        <?php
        echo build_table($asistencia);
        echo '<a class="btn btn-primary" href="asistenciaporactividad.php?download=xlsx&idactividad='.$idactividad.'">Descargar en Excel</a>';
        echo '<a class="btn btn-primary" href="resultadossatisfaccion.php?idactividad='.$idactividad.'">Resultados Satisfacción</a>';
        echo '<a class="btn btn-primary" href="sorteoporactividad.php?idactividad='.$idactividad.'">Sorteo</a>';
        ?>
    </div>
<?php
include "_footer.php";
?>



<?php

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
