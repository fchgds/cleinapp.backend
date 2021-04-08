<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once $_SERVER['DOCUMENT_ROOT'].'/vendor/autoload.php';
require_once $_SERVER['DOCUMENT_ROOT']."/php/notificacionemail.php";
require_once $_SERVER['DOCUMENT_ROOT']."/_medoo.php";



function newusuario()
{
    $usuario= [
        "nombre" => "",
        "apellido" => "",
        "documento" => "",
        "edad" => "",
        "pais" => "",
        "universidad" => "",
        "email" => "",
        "telefono" => "",
        "enteraste" => ""
    ];
    return $usuario;
}


function getusuario($idusuario)
{
    global $database;
    $data=$database->select("usuarios",
        '*'
        ,[
            'idusuario'=>$idusuario
        ]
    );
    if(isset($data[0])) {
        return $data[0];
    }
    else
    {
        return NULL;
    }
}

function eliminarusuario($idusuario)
{
    global $database;
    $database->delete("usuarios"
        ,[
            'idusuario'=>$idusuario
        ]
    );
}


function getusuarios()
{
    global $database;
    return $database->select("usuarios","*",
        [
            'estadopago[~]'=>["Pendiente","Valido"]
        ]);
}

function getusuariosvalidos()
{
    global $database;
    return $database->select("usuarios","*",
        [
            'estadopago[~]'=>["Valido"]
        ]);
}

function getusuariosfiltropais($filtro)
{
    global $database;
    if($filtro=='Clein')
    {
        $data=$database->select("usuarios",
            '*'
            ,[
                'pais[!~]'=>["AND" =>["Argentina","Bolivia","Perú"]]
            ]
        );
    }
    else
    {
        $data=$database->select("usuarios",
            '*'
            ,[
                'pais[~]'=>$filtro
            ]
        );
    }
    return $data;
}

function getusuariosestadopais($estado,$pais)
{
    global $database;
    if($pais=='Clein')
    {
        $data=$database->select("usuarios",
            '*'
            ,[
                "AND" =>
                [
                    'estadopago' => $estado,
                    'pais[!~]'=>["AND" =>["Argentina","Bolivia","Perú"]]
                ]
            ]
        );
    }
    else
    {
        $data=$database->select("usuarios",
            '*'
            ,[
                'estadopago' => $estado,
                'pais[~]'=>$pais
            ]
        );
    }
    return $data;
}


function getnrousuariosregistradospais($pais)
{
    global $database;
    if($pais=='Clein')
    {
        $data=$database->select("usuarios",
            '*'
            ,[
                "AND" => [
                    'pais[!~]'=>["AND" =>["Argentina","Bolivia","Perú"]],
                    'estadopago[~]'=>["Pendiente","Valido"]
                ]
            ]
        );
    }
    else
    {
        $data=$database->select("usuarios",
            '*'
            ,[
                "AND" => [
                    'pais[~]'=>$pais,
                    'estadopago[~]'=>["Pendiente","Valido"]
                ]
            ]
        );
    }
    return count($data);
}

function getestadousuario($idusuario)
{
    global $database;
    $usuario=$database->select("usuarios",
        [
            "estadopago"
        ],
        [
            "idusuario" => $idusuario
        ]
    );

    return $usuario[0]['estadopago'];
}


function updateestadousuario($idusuario,$estado)
{
    global $database;
    global $notificar;

    $estadoanterior = getestadousuario($idusuario);

    $database->update("usuarios",
        [
            "estadopago" => $estado,
             "fechapago" => date('Y-m-d H:i:s')
        ],
        [
            "idusuario" => $idusuario
        ]
    );

    echo notificarcambioestado($estadoanterior,$estado,getusuario($idusuario));
}

function guardarpago($idusuario,$locationComprobante)
{
    global $database;
    $database->update("usuarios",
        [
            "pago" => $locationComprobante,
        ],
        [
            "idusuario" => $idusuario
        ]);
}

function eliminarpago($idusuario)
{
    guardarpago($idusuario,"");
}
