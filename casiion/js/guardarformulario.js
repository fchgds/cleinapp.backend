function guardarformulario()
{

    // if($('#formulario').checkValidity())
    // {
        $("#buttonConfirmo").enabled=false;
        $.ajax({
            type: "POST",
            url: "api/nuevoregistro.php",
            data: $('#formulario').serialize(),
            success: function(data) {
                $("#alertGuardado").fadeIn().delay(5000);
                $("#buttonConfirmo").fadeOut();
            }
        });
    // }
}

$(document).ready(function() {

    $("#formulario").submit(function(e) {
        e.preventDefault();
        $("#buttonConfirmo").enabled=false;
        $.ajax({
            type: "POST",
            url: "api/nuevoregistro.php",
            data: $('#formulario').serialize(),
            success: function(data) {
                $("#alertGuardado").fadeIn().delay(5000);
                $("#buttonConfirmo").fadeOut();
            }
        });
        // e.preventDefault();
    });
});
