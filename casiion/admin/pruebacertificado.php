<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once '../vendor/autoload.php';
require_once '../php/certificados.php';

$nombre="Fernando Chávez Gomes da Silva";
$codigo='fysa6813';
//generarcertificadopantalla($nombre,$codigo);
$archivo="Fernando.pdf";
$path="../certificados/casiion/";
//$path="certificados/cassion/";
generarcertificadoarchivo($nombre,$codigo,$path.$archivo);
