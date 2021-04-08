<?php
include "php/generacodigo.php";



$mediospago =
    [
        [
            "titulo"=>"Transferencia Bancaria Chile",
            "instrucciones"=>"<p>Transferencia Bancaria Chile ($3.750 CLP = 5 USD):</p>
        <p>PAULINA ALEJANDRA ORMENO PARRA</p>
        <p>16.794.405-1</p>
        <p>Cuenta Corriente</p>
        <p>Nº 0-000-72-36043-5</p>
        <p>Banco Santander</p>
        <p>PAU.ORME@GMAIL.COM</p>"
        ],
        [
        "titulo"=>"Transferencia Bancaria Perú",
        "instrucciones"=>"<p>Transferencia Bancaria para Perú ($18 soles = 5 USD)</p>
        <p>Puedes realizar tu inversión con el siguiente número de cuenta:</p>
        <p>Banco de Crédito (BCP)</p>
        <p>Cuenta bancaria 215-95366286-0-76</p>
        <p>Código interbancario 00221519536628607625</p>
        <p>Número de celular (yape) +51991848907</p>
        <p>Cuenta de Pamela Paredes Cabana</p>
        <p>correo apeiioficial@gmail.com</p>
        <p>-	Si realizas la operación por ventanilla o agente agregar comisión.</p>
        <p>-	Si realizas la operación por banca móvil, se exonera de cualquier comisión.</p>"
    ],
        [
            "titulo"=>"Mercado Pago Argentina",
            "instrucciones"=>'
        <p>Mercado Pago Argentina ($750 = 5 USD)</p>
        <p>Mediante el siguiente link se acreditará la inscripción a la cuenta de Mercado Pago de la asociación.</p> 
        <p>El pago puede ser realizado mediante:</p>
        <p>●	Dinero disponible en mercado pago</p>
        <p>●	Tarjeta de credito o debito</p>
        <p>Link de pago:  <a href="https://mpago.la/1tB3dip" target="_blank">https://mpago.la/1tB3dip</a></p>
        <p>Mail de contacto: inscripciones@aareii.org.ar</p>
        <p>Aclaración del comprobante de pago: enviar adjunta captura de pantalla del mail de confirmación de pago, tener en cuenta que sea visible el número de operación.</p>'
        ],
        [
            "titulo"=>"Transferencia Bancaria Bolivia",
            "instrucciones"=>'
        <p>Transferencia Bancaria (34.8 Bs = 5 USD)
        <p>JULIO CESAR ACEBÉ FLORES</p>
        <p>CI:10651341Tja</p>
        <p>Cuenta De Ahorros</p>
        <p>Nº 7500499332</p>
        <p>Banco Nacional De Bolivia</p>
        <p>julioacebef@gmail.com</p>
        <p>Cell: (+591) 78225142</p>'
        ],
        [
            "titulo"=>"Paypal",
            "instrucciones"=>'
                <p>Ingresar a la página de CLEIN Chile 2021 y realizar el pago a través del formulario de pago</p>
                <a href="https://clein.org/?page_id=1228">Pagos Paypal</a>'
        ],
    ];



function mostrarpago($titulo,$instrucciones)
{
    $id=generacodigo('hexdec',4);

    echo
    '<div class="card">
    <div class="card-header" id="heading'.$id.'">
      <h5 class="mb-0">
        <button class="btn btn-primary collapsed" type="button" data-toggle="collapse" data-target="#collapse'.$id.'" aria-expanded="false" aria-controls="collapse'.$id.'">
    '.$titulo.'
</button>
      </h5>
    </div>

    <div id="collapse'.$id.'" class="collapse" aria-labelledby="heading'.$id.'" data-parent="#accordionpagos">
      <div class="card-body">
        '.$instrucciones.'
      </div>
    </div>
  </div>';


}
