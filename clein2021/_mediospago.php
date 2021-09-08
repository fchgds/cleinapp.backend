<?php
include "php/generacodigo.php";



$mediospago =
    [
        [
            "titulo"=>"Paypal",
            "instrucciones"=>'
<div id="smart-button-container">
      <div style="text-align: center;">
        <div id="paypal-button-container"></div>
      </div>
    </div>
  <script src="https://www.paypal.com/sdk/js?client-id=
AV_HtVa0ssI5sf4fQCw2LAUIlaMPgU3c1iKjFT7UcdgrhNOmEOrK4eivkA4ebXrcnea7cUtVxHAjVr3y
&enable-funding=venmo&currency=USD" data-sdk-integration-source="button-factory"></script>
  <script>
    function initPayPalButton() {
      paypal.Buttons({
        style: {
          shape: "rect",
          color: "gold",
          layout: "vertical",
          label: "paypal",
          
        },

        createOrder: function(data, actions) {
          return actions.order.create({
            purchase_units: [{"amount":{"currency_code":"USD","value":1}}]
          });
        },

        onApprove: function(data, actions) {
          return actions.order.capture().then(function(orderData) {
            
            // Full available details
            console.log("Capture result", orderData, JSON.stringify(orderData, null, 2));

            // Show a success message within this page, e.g.
            const element = document.getElementById("paypal-button-container");
            element.innerHTML = "";
            element.innerHTML = "<h3>Thank you for your payment!</h3>";

            // Or go to another URL:  actions.redirect("thank_you.html");
            
          });
        },

        onError: function(err) {
          console.log(err);
        }
      }).render("#paypal-button-container");
    }
    initPayPalButton();
  </script>'
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
