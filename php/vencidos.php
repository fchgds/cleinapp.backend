<?php
error_reporting(E_ALL);
require_once  $_SERVER['DOCUMENT_ROOT'].'/vendor/autoload.php';
require_once  $_SERVER['DOCUMENT_ROOT']."/_medoo.php";

vencidos();

function vencidos()
{
    global $database;
//    $database->query("UPDATE `usuarios` SET `estadopago`='Vencido' WHERE `estadopago` = 'Pendiente'");
}



