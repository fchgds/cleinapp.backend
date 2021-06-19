<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once  $_SERVER['DOCUMENT_ROOT'].'/vendor/autoload.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/php/usuario.php';

if(isset($_GET['pais']))
{
$pais=$_GET['pais'];
$data=getusuariosfiltropais($_GET['pais']);
}
else
{
    $data=getusuarios();
    $pais="";
}


$fileName = "inscripciones_".$pais."_". date("Y-m-d H.i.s") . ".xlsx";


downloadxlsx($fileName, $data);

function downloadxlsx($fileName, $data)
{
    $header[0]= array_keys($data[0]);
    $dataWithHeader=array_merge($header,$data);

    SimpleXLSXGen::fromArray( $dataWithHeader )->downloadAs($fileName);
}
