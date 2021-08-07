<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once ($_SERVER['DOCUMENT_ROOT'].'/vendor/autoload.php');

include("../_medoo.php");
include("../php/usuario.php");
require_once "adminsession.php";

echo build_table(listaganadores());


function listaganadores()
{
    global $database;
    $data=$database->select("ganadores",
        [
            "[>]usuarios" => "idusuario"
        ],[
            'ganadores.idganador',
            'usuarios.idusuario',
            'usuarios.nombre',
            'usuarios.apellido',
            'usuarios.email',
            'usuarios.pais',
            'ganadores.premio',
        ],[
            "ORDER" => ["created"=>'DESC']
        ]
    );
    return $data;
}


function build_table($array)
{
    // start table
    $html = '<table class="table table-striped">';
    // header row
    $html .= '<tr>';
    if(isset($array[0]))
    {
        $html .= '<th>#</th>';
        foreach ($array[0] as $key => $value) {
            $html .= '<th>' . htmlspecialchars($key) . '</th>';
        }
        $html .= '<th>Eliminar</th>';
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
        $html .= "<td>$i</td>";
        foreach ($value as $key2 => $value2) {
            if($key2 == "idganador")
            {
                $idganador=$value2;
            }
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
        $html .= "<td><a class ='btn btn-danger' href='guardarganador.php?eliminar=$idganador'>Eliminar</td>";
        $i++;
        $html .= '</tr>';
    }

    // finish table and return it

    $html .= '</table>';
    return $html;
}
