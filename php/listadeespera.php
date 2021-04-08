<?php
require_once  'usuario.php';

$paises = ["Clein","Argentina","Bolivia","Perú"];
$cupos = [74,74,74,74];

$i=0;
$usuarioscambiados = [];
foreach ($paises as $pais)
{
    $j=1;
    $cuposutilizados[$pais]=getnrousuariosregistradospais($pais);
    $cuposdisponibles[$pais]=$cupos[$i]-getnrousuariosregistradospais($pais);

    if($cuposdisponibles[$pais]>0)
    {
        $listaespera=getusuariosestadopais('Lista Espera',$pais);
        foreach ($listaespera as $usuario) {
            if($cuposdisponibles[$pais]>0)
            {

            $usuario['cambiopais']=$j;
            $usuarioscambiados[]=$usuario;

            $cuposdisponibles[$pais]--;
            $j++;
            }
        }
    }
    $i++;
}


global $notificar;
foreach ($usuarioscambiados as $usuarioscambiado) {
    $estado="Pendiente";
    updateestadousuario($usuarioscambiado['idusuario'],$estado);
    echo $notificar;
    echo $usuarioscambiado['cambiopais'].' - '.$usuarioscambiado['idusuario']." ". $usuarioscambiado['nombre']." ".$usuarioscambiado['apellido'].' '.$usuarioscambiado['pais'].' '.$usuarioscambiado['estadopago'].'<br><hr>';
}





