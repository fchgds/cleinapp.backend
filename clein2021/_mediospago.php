<?php
include "php/generacodigo.php";



$mediospago =
    [
        [
            "titulo"=>"Paypal",
            "instrucciones"=>'
                <p>Ingresar a la página de CLEIN Chile 2021 y realizar el pago a través del formulario de pago</p>
                <a class="btn btn-primary" href="https://clein.org/?page_id=1228">Pagos Paypal</a>'
        ]
    ];



function mostrarpago($titulo,$instrucciones)
{
    $id=generacodigo('hexdec',4);

    echo
    '<div class="card">
    <div class="card-header" id="heading'.$id.'">
      <h5 class="mb-0">
        <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapse'.$id.'" aria-expanded="false" aria-controls="collapse'.$id.'">
    '.$titulo.'
</button>
      </h5>
    </div>

    <div id="collapse'.$id.'" class="" aria-labelledby="heading'.$id.'" data-parent="#accordionpagos">
      <div class="card-body">
        '.$instrucciones.'
      </div>
    </div>
  </div>';


}
