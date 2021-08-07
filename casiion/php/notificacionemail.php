<?php

require "enviarcorreo.php";

function enviarcorreohabilitado($email,$nombre)
{
$subject="CASII-ON: Tu registro está habilitado para el pago";

ob_start();
include('emails/estadopendiente.php');
$body = ob_get_contents();
ob_end_clean();

return enviarcorreo($email,$nombre,$subject,$body);
}


function enviarcorreovalidado($email,$nombre)
{
    $subject="CASII-ON: Tu pago ha sido validado";

    ob_start();
    include('emails/estadovalido.php');
    $body = ob_get_contents();
    ob_end_clean();

    return enviarcorreo($email,$nombre,$subject,$body);
}


function enviarcorreorechazado($email,$nombre)
{
    $subject="CASII-ON: Tu comprobante ha sido rechazado";

    ob_start();
    include('emails/estadorechazado.php');
    $body = ob_get_contents();
    ob_end_clean();

    return enviarcorreo($email,$nombre,$subject,$body);
}



function notificarcambioestado($estadoanterior,$estado,$usuario)
{
    if($estadoanterior=="Lista Espera"&&$estado=="Pendiente")
    {
        return enviarcorreohabilitado($usuario['email'],$usuario['nombre']);
    }

    if($estadoanterior=="Pendiente"&&$estado=="Valido")
    {
        return enviarcorreovalidado($usuario['email'],$usuario['nombre']);
    }

    if($estadoanterior=="Pendiente"&&$estado=="Rechazado")
    {
        return enviarcorreorechazado($usuario['email'],$usuario['nombre']);
    }
}


function enviarcorreoevento1($email,$nombre)
{
    $subject="CASII-ON: Taller Lunes 29 Revolución Inteligente";

    ob_start();
    include('emails/evento1.php');
    $body = ob_get_contents();
    ob_end_clean();

    return enviarcorreo($email,$nombre,$subject,$body);
}

function enviarcorreoevento2($email,$nombre)
{
    $subject="CASII-ON: Taller Martes 30 de marzo Eficiencia Energética";

    ob_start();
    include('emails/evento2.php');
    $body = ob_get_contents();
    ob_end_clean();

    return enviarcorreo($email,$nombre,$subject,$body);
}

function enviarcorreoevento3($email,$nombre)
{
    $subject="CASII-ON: Taller Miércoles 31 de marzo Lean Manufacturing";

    ob_start();
    include('emails/evento3.php');
    $body = ob_get_contents();
    ob_end_clean();

    return enviarcorreo($email,$nombre,$subject,$body);
}

function enviarcorreoevento4($email,$nombre)
{
    $subject="CASII-ON: Taller Jueves 1 de abril Agroindustria";

    ob_start();
    include('emails/evento4.php');
    $body = ob_get_contents();
    ob_end_clean();

    return enviarcorreo($email,$nombre,$subject,$body);
}

function enviarcertificado($email,$nombre,$archivo,$codigo,$url)
{
    $subject="CASII-ON: Certificado";
    ob_start();
    include('emails/certificado.php');
    $body = ob_get_contents();
    ob_end_clean();

    enviarcorreoadjunto($email,$nombre,$subject,$body,$archivo);
}
