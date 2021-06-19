<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require ($_SERVER['DOCUMENT_ROOT'].'/vendor/autoload.php');
include($_SERVER['DOCUMENT_ROOT'] . "/_medoo.php");
include($_SERVER['DOCUMENT_ROOT'] . "/php/preguntas.php");


$preguntas = preguntassatisfaccion();

foreach ($preguntas as $pregunta)
{
    echo $pregunta['respuestas'].' ';
    $pregunta['respuestas']=str_replace ( "['" , '', $pregunta['respuestas']);
    $pregunta['respuestas']=str_replace ( "']" , '',$pregunta['respuestas']);
    $pregunta['respuestas']=str_replace ( "','" , ',', $pregunta['respuestas']);
    echo $pregunta['respuestas'];
    echo '<br>';

    global $database;
    $database->update("satisfaccion_preguntas",
    [
        "respuestas" => $pregunta['respuestas']
    ],
    [
        "idsatisfaccion_pregunta" => $pregunta['idsatisfaccion_pregunta']
    ]
);
}
