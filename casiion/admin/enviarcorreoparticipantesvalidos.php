<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require ($_SERVER['DOCUMENT_ROOT'].'/vendor/autoload.php');

include("../_medoo.php");
include("../php/usuario.php");
include("../php/certificados.php");
include("../php/generacodigo.php");
include("../php/notificacionemail.php");

$usuarios = getusuariosvalidos();

foreach ($usuarios as $usuario)
{
    $email = $usuario['email'];
    $nombre = $usuario['nombre']. ' '. $usuario['apellido'];
    echo $email.' '. $nombre . ' '. $usuario['estadopago'].'<br>';
    enviarcorreoevento4($email,$nombre);
}
