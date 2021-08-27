<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once '../vendor/autoload.php';
include($_SERVER['DOCUMENT_ROOT'] . "/clein2021/_medoo.php");
include($_SERVER['DOCUMENT_ROOT'] . "/clein2021/php/usuario.php");
include($_SERVER['DOCUMENT_ROOT'] . "/clein2021/php/certificados.php");
include($_SERVER['DOCUMENT_ROOT'] . "/clein2021/php/generacodigo.php");

if(isset($_GET['idusuario']))
{
    $idusuario=$_GET['idusuario'];
    generarcertificado($idusuario);
}

if(isset($_GET['eliminar'])&&isset($_GET['idcertificado']))
{
    $idcertificado = $_GET['idcertificado'];
    eliminarcertificado($idcertificado);
    echo "Certificado Eliminado";
    echo "<a href='#' onclick='location.replace(document.referrer)'>Volver</a>";
}

function generarcertificado($idusuario)
{
    $listadoasistencia=getusuario($idusuario);
    $nombrecompleto = $listadoasistencia['nombre'] .' '.$listadoasistencia['apellido'];
    $idusuario=$listadoasistencia['idusuario'];
    $email=$listadoasistencia['email'];
    $path2="/home/aleiiafc/app.clein.org/certificados/casiion/";
    $path="../certificados/casiion/";
    $archivo="CASII-On_".str_replace(' ', '', $nombrecompleto).".pdf";
    $codigo=generacodigo();
    $url="https://app.clein.org/certificado.php?c=".$codigo;
    generarcertificadoarchivo($nombrecompleto,$codigo,$path.$archivo);
    guardarcertificado($idusuario,$nombrecompleto,$email,$url,$codigo,$path2.$archivo);
    echo "<p>Certificado ".$nombrecompleto." generado";
    echo "<a href='#' onclick='location.replace(document.referrer)'>Volver</a>";
}



function generartodosloscertificados()
{
$listadoasistencias=getcertificadosasistencia();

foreach ($listadoasistencias as $listadoasistencia)
{
    $nombrecompleto = $listadoasistencia['nombre'] .' '.$listadoasistencia['apellido'];
    $idusuario=$listadoasistencia['idusuario'];
    $email=$listadoasistencia['email'];
    $path2="/home/aleiiafc/app.clein.org/certificados/casiion/";
    $path="../certificados/casiion/";
    $archivo="CASII-On_".str_replace(' ', '', $nombrecompleto).".pdf";
    $codigo=generacodigo();
    $url="https://app.clein.org/certificado.php?c=".$codigo;
    generarcertificadoarchivo($nombrecompleto,$codigo,$path.$archivo);
    guardarcertificado($idusuario,$nombrecompleto,$email,$url,$codigo,$path2.$archivo);
    echo "<p>Certificado ".$nombrecompleto." generado";
}
}
