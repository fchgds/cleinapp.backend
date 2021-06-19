<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/_medoo.php";


function preguntastrivia($idactividad)
{
    global $database;
    if($idactividad==0)
    {
        $data=$database->select("preguntas",
            '*'
            ,[
                'idpregunta[>]'=>0
            ]
        );
        if(isset($data[0])) {
            return $data;
        }
        else
        {
            return NULL;
        }
    }
    else
    {
        $data=$database->select("preguntas",
            '*'
            ,[
                'idactividad'=>$idactividad
            ]
        );
        if(isset($data[0])) {
            return $data;
        }
        else
        {
            return NULL;
        }
    }
}

function preguntassatisfaccion()
{
    global $database;
    $data=$database->select("satisfaccion_preguntas",
        '*'
        ,[
            'idsatisfaccion_pregunta[>]'=>0
        ]
    );
    if(isset($data[0])) {
        return $data;
    }
    else
    {
        return NULL;
    }
}

function showpregunta($pregunta,$respuestas,$idpregunta)
{
    echo '
    <div class="form-group">
                  <p class="pregunta">'.$pregunta.'</p>';
    $arrayrespuestas =  explode ( ',' ,  $respuestas);
    optionsradio($idpregunta,$arrayrespuestas);
    echo '</div>';
}

function showpreguntasatisfaccion($pregunta,$respuestas,$idpregunta,$tipopregunta)
{
    echo '
    <div class="form-group">
                  <p class="pregunta">'.$pregunta.'</p>';
    if($tipopregunta=="opciones")
    {
        $arrayrespuestas =  explode ( ',' ,  $respuestas);
        optionsradio($idpregunta,$arrayrespuestas);
    }
    if($tipopregunta=="texto")
    {
        echo "<textarea class='form-control' id='$idpregunta' name='$idpregunta' rows='5' required></textarea>";
    }
    echo '</div>';
}


function optionsradio($name,$options,$respuestaguardada="")
{
    echo "
    <div class='form-group'>
    ";
    $i=1;
    foreach($options as $option)
    {
        $selected="";
        if($respuestaguardada==$option)
        {
            $selected="checked='checked'";
        }
        echo "<input type='radio' class='btn-check' name='$name' id='" . $name . $i . "' value='$option' autocomplete='off' required $selected>
           <label class='btn btn-outline-primary' for='" . $name . $i . "'>$option</label>";
        $i++;
    }
    echo "</div>";
}
