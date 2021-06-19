<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once '../vendor/autoload.php';
include($_SERVER['DOCUMENT_ROOT'] . "/_medoo.php");
include($_SERVER['DOCUMENT_ROOT'] . "/php/usuario.php");
include($_SERVER['DOCUMENT_ROOT'] . "/php/certificados.php");
include($_SERVER['DOCUMENT_ROOT'] . "/php/generacodigo.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/php/notificacionemail.php");

if(isset($_GET['idcertificado']))
{
    $idcertificado=$_GET['idcertificado'];
    enviarcertificadoporid($idcertificado);
}


function enviarcertificadoporid($idcertificado)
{
    $certificado=getcertificado($idcertificado);
    $nombrecompleto = $certificado['nombrecompleto'];
    $idusuario=$certificado['idusuario'];
    $email=$certificado['email'];
    $codigo=$certificado['codigo'];
    $url=$certificado['url'];
    $path="../certificados/casiion/";
    $archivo=$certificado['archivo'];
    enviarcertificado($email,$nombrecompleto,$archivo,$codigo,$url);
    guardarcertificadoenviado($idusuario);
    echo "<p>Certificado ".$nombrecompleto." enviado";
    echo "<a href='#' onclick='location.replace(document.referrer)'>Volver</a>";
}


function enviartodosloscertficados()
{
    $certificados=getcertificados();

    foreach ($certificados as $certificado)
    {
        $nombrecompleto = $certificado['nombrecompleto'];
        $idusuario=$certificado['idusuario'];
        $email=$certificado['email'];
        $codigo=$certificado['codigo'];
        $url=$certificado['url'];
        $path="../certificados/casiion/";
        $archivo=$certificado['archivo'];
        enviarcertificado($email,$nombrecompleto,$archivo,$codigo,$url);
        guardarcertificadoenviado($idusuario);
        echo "<p>Certificado ".$nombrecompleto." enviado";
    }
}




//print_r($certificados);
// $certificado=$certificados[0];
//
//    $nombrecompleto = $certificado['nombrecompleto'];
//    $idusuario=$certificado['idusuario'];
//    $codigo=$certificado['codigo'];
//    $url=$certificado['url'];
//    $email="fernandochavezgomesdasilva@gmail.com";
//    $path="../certificados/casiion/";
//    $archivo=$certificado['archivo'];
//    enviarcertificado($email,$nombrecompleto,$archivo,$codigo,$url);
//    guardarcertificadoenviado($idusuario);
//    echo "<p>Certificado ".$nombrecompleto." enviado";

