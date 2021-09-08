<?php



function nroinscritos($filtrospaises)
{
    $nroinscritos = Array();
    foreach($filtrospaises as $filtro)
    {
        $nroinscritos[$filtro]=getnroinscritospais($filtro);
    }
    return $nroinscritos;
}

function nroinscritosvalidos($filtrospaises)
{
    $nroinscritos = Array();
    foreach($filtrospaises as $filtro)
    {
        $nroinscritos[$filtro]=getnroinscritosvalidospais($filtro);
    }
    return $nroinscritos;
}

function getnroinscritospais($filtro)
{
    global $database;
    if($filtro=='Clein')
    {
        $data=$database->select("usuarios",
            '*'
            ,[
                "AND"
                =>[
//                    'pais[!~]'=>["AND" =>["Argentina","Bolivia","Perú"]],
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
                "AND"
                =>[
                    'pais[~]'=>$filtro,
                    'estadopago[~]'=>["Pendiente","Valido"]
                ]
            ]
        );
    }
    return count($data);
}



function getnroinscritosvalidospais($filtro)
{
    global $database;
    if($filtro=='Clein')
    {
        $data=$database->select("usuarios",
            '*'
            ,[
                "AND"
                =>[
//                    'pais[!~]'=>["AND" =>["Argentina","Bolivia","Perú"]],
                    'estadopago[~]'=>["Valido"]
                ]
            ]
        );
    }
    else
    {
        $data=$database->select("usuarios",
            '*'
            ,[
                "AND"
                =>[
                    'pais[~]'=>$filtro,
                    'estadopago[~]'=>["Valido"]
                ]
            ]
        );
    }
    return count($data);
}
