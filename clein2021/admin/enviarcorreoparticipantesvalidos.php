<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require ($_SERVER['DOCUMENT_ROOT'].'/vendor/autoload.php');

require_once($_SERVER['DOCUMENT_ROOT'] . "/_medoo.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/php/usuario.php");

require_once($_SERVER['DOCUMENT_ROOT'] . "/php/notificacionemail.php");

$usuarios = getusuariosvalidos();

foreach ($usuarios as $usuario)
{
    $email = $usuario['email'];
    $nombre = $usuario['nombre']. ' '. $usuario['apellido'];
    echo $email.' '. $nombre . ' '. $usuario['estadopago'].'<br>';
    enviarcorreoevento4($email,$nombre);
}
