<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once 'vendor/autoload.php';
include ($_SERVER['DOCUMENT_ROOT']."/_medoo.php");
include ($_SERVER['DOCUMENT_ROOT']."/php/usuario.php");
include ($_SERVER['DOCUMENT_ROOT']."/php/certificados.php");

if(isset($_GET['c'])&&strlen($_GET['c'])>0)
{
    $certificado=getcertificadocodigo($_GET['c']);
    $url=str_replace("/home/aleiiafc/","https://",$certificado['archivo']);
    header("Location:".$url);
}
else
    {
    echo "Codigo no encontrado";
}
