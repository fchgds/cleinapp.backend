<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/_medoo.php";

function guardarrespuestatrivia($idactividad,$idpregunta,$idusuario,$respuesta,$correcta)
{
    global $database;
    $data=$database->insert("respuestas"
            ,[
            'idactividad'=>$idactividad,
            'idpregunta'=>$idpregunta,
            'idusuario'=>$idusuario,
            'respuesta'=>$respuesta,
            'correcta'=>$correcta,
            ]
        );
}

function guardarresultadotrivia($idusuario,$idactividad,$correctas)
{
    global $database;
    $data=$database->update("asistencia"
        ,[
            'respuestascorrectas'=>$correctas,
        ],[
            'idactividad'=>$idactividad,
            'idusuario'=>$idusuario
        ]
    );
}

function guardarrespuestasatisfaccion($idactividad,$idpregunta,$idusuario,$respuesta)
{
    global $database;
    $data=$database->insert("satisfaccion_respuestas"
        ,[
            'idactividad'=>$idactividad,
            'idpregunta'=>$idpregunta,
            'idusuario'=>$idusuario,
            'respuesta'=>$respuesta,
        ]
    );
}
