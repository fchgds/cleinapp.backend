<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once $_SERVER['DOCUMENT_ROOT'].'/vendor/autoload.php';
require_once $_SERVER['DOCUMENT_ROOT']."/_medoo.php";
require_once $_SERVER['DOCUMENT_ROOT']."/php/session.php";



function registrarasistencia($idusuario,$codigo)
{
    global $database;

    $data=$database->select("actividad",
        '*'
        ,[
            "OR" =>
            [
                'codigoingreso'=>$codigo,
                'codigosalida'=>$codigo
            ]
        ]
    );

    if(isset($data[0])) {
        $actividad=$data[0];
        if($actividad['codigoingreso']==$codigo)
        {
            guardarasistencia($actividad['idactividad'],$idusuario,true,false);
            return '<head>
                <meta http-equiv="Refresh" content="1; URL=evento.php">
            </head><h2>Ingreso Registrado</h2>';
        }

        if($actividad['codigosalida']==$codigo)
        {
            guardarasistencia($actividad['idactividad'],$idusuario,false,true);
            $_SESSION['idactividad']=$actividad['idactividad'];
            return '
            <head>
                <meta http-equiv="Refresh" content="1; URL=preguntastrivia.php">'.
            '</head>
            <h2>Asistencia registrada</h2>';
        }




    }
    else
    {
        return "<h2>Código inválido</h2>";
    }
}

function guardarasistencia($idactividad,$idusuario,$ingreso="",$salida="")
{
    global $database;

    $data=$database->select("asistencia",
        '*'
        ,[
            "AND" =>
                [
                    'idactividad'=>$idactividad,
                    'idusuario'=>$idusuario
                ]
        ]
    );

    if(isset($data[0])) {
        if($ingreso)
        {
            $database->update("asistencia",[
                "ingreso" => date('Y-m-d H:i:s'),
                ],[
            "AND" =>
                [
                    'idactividad'=>$idactividad,
                    'idusuario'=>$idusuario
                ]
        ]);
        }
        if($salida)
        {
            $database->update("asistencia",[
                "salida" => date('Y-m-d H:i:s'),
            ],[
                "AND" =>
                    [
                        'idactividad'=>$idactividad,
                        'idusuario'=>$idusuario
                    ]
            ]);
        }
    }
    else
    {
        if($ingreso)
        {
            $database->insert("asistencia",[
                "ingreso" => date('Y-m-d H:i:s'),
                        'idactividad'=>$idactividad,
                        'idusuario'=>$idusuario
            ]);
        }
        if($salida)
        {
            $database->insert("asistencia",[
                "salida" => date('Y-m-d H:i:s'),
                        'idactividad'=>$idactividad,
                        'idusuario'=>$idusuario
            ]);
        }
    }


}
