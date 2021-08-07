<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require ($_SERVER['DOCUMENT_ROOT'].'/vendor/autoload.php');

include("../_medoo.php");
include("../php/usuario.php");
include("../php/certificados.php");
include ("nroinscritos.php");
//require "adminsession.php";



if(isset($_GET['filtropais']))
{
    $filtro=$_GET['filtropais'];
    $invitados=getusuariosfiltropais($filtro);

}
else
{
    $filtro="";
    $invitados=getusuarios();
}

$_SESSION['url']=$_SERVER['REQUEST_URI'];

?>
<?php
include "_head.php";
?>
    <body>
    <?php

    echo filtropais($filtro);
    ?>
    <div class="container-fluid" style="background-color: #dddddd;">
        <?php
        $listadoasistencias=getcertificadosasistencia();
        echo build_table($listadoasistencias);
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
        <a class="nav-link" href="listadoinscritos.php">Todos<span class="badge bg-secondary">'.count(getusuarios()).'</span><span class="badge bg-success">'.count(getusuariosvalidos()).'</span></a>';
    $filtrospaises = ["Clein","Argentina","Bolivia","Perú"];
    $nroinscritos=nroinscritos($filtrospaises);
    $nroinscritosvalidos=nroinscritosvalidos($filtrospaises);
    foreach($filtrospaises as $paises)
    {
        $active = "";
        if($filtro==$paises)
        {
            $active = "active";
        }

        echo '<a class="nav-link '.$active.'" href="listadoinscritos.php?filtropais='.$paises.'">'.$paises.'<span class="badge bg-secondary">'.$nroinscritos[$paises].'</span><span class="badge bg-success">'.$nroinscritosvalidos[$paises].'</span></a>';
    }

    echo '
        <a class="nav-link" href="listadoasistencia.php">Asistencias</a>
        <a class="nav-link" href="listadocertificados.php">Certificados</a>
        <a class="nav-link" href="actividades.php">Actividades</a>
        <a class="nav-link" href="logout.php">Logout</a>
        
        </nav>';
}



function build_table($array)
{
    // start table
    $html = '<table class="table table-striped">';
    // header row
    $html .= '<tr>';
    $html .= '<th>Cupo</th>';
    if(isset($array[0]))
    {
        foreach ($array[0] as $key => $value) {
            $html .= '<th>' . htmlspecialchars($key) . '</th>';
        }
        $html .= '<th>Acciones</th>';
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
        $html .= '<td>' . $i . '</td>';
            $i++;
        foreach ($value as $key2 => $value2) {
            if($key2 == "idusuario")
            {
                $html .= '<td><a class="btn btn-primary" href="editar.php?idusuario=' . htmlspecialchars($value2) . '">'. htmlspecialchars($value2).'</a></td>';
//                $html .= '<td>' . htmlspecialchars($value2) . '</td>';
                $idusuario=$value2;
            }else if($key2 == "codigo")
            {
                $html .= '<td><a href="../certificado.php?c=' . $value2 . '">'. $value2.'</a></td>';
            }
            else
            {
                $html .= '<td>' . htmlspecialchars($value2) . '</td>';
            }
        }
        $html .= '<td><a class="btn btn-primary" href="generarcertificados.php?idusuario=' . $idusuario . '">Generar Certificado</a></td>';
        $html .= '</tr>';
    }

    // finish table and return it

    $html .= '</table>';
    return $html;
}
?>



