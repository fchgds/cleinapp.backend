<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require $_SERVER['DOCUMENT_ROOT'].'/vendor/autoload.php';
include $_SERVER['DOCUMENT_ROOT']."/_medoo.php";
include $_SERVER['DOCUMENT_ROOT']."/php/usuario.php";
require_once $_SERVER['DOCUMENT_ROOT']."/php/session.php";

global $database;

$cupos=count(getusuarios());

if($cupos>296)
{
    $estadopago = 'Lista Espera';
}
else{
    $estadopago = 'Pendiente';
}



$data=$database->insert("usuarios",
    [
        "nombre" => $_POST['nombre'],
        "apellido" => $_POST['apellido'],
        "documento" => $_POST['documento'],
        "edad" => $_POST['edad'],
        "pais" => $_POST['pais'],
        "universidad" => $_POST['universidad'],
        "email" => $_POST['email'],
        "telefono" => $_POST['telefono'],
        "enteraste" => $_POST['enteraste']." ".$_POST['enterasteotro'],
        "fecharegistro" => date('Y-m-d H:i:s'),
        "estadopago" => $estadopago
    ]);
$_SESSION['idusuario']=$database->id();
$_SESSION['usuario']=getusuario($_SESSION['idusuario']);
