<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require '../vendor/autoload.php';
require_once "_medoo.php";
require "php/session.php";
require_once "php/usuario.php";

if(isset($_SESSION['usuario']))
{
    $usuario=$_SESSION['usuario'];
}
else
{
    $usuario=newusuario();
}




include('_head.php');
?>

<body>
<div class="container" style="background-color: #dddddd;">
    <nav class="nav nav-pills nav-justified">
        <a class="nav-link" aria-current="page" href="index.php"><img src="img/favicon-32x32.png" ></a>
        <a class="nav-link active" aria-current="page" href="formularioregistro.php">Registro</a>
        <a class="nav-link" href="formulariocomprobante.php">Pago</a>
        <a class="nav-link" href="evento.php">Evento</a>
    </nav>
    <div class="row">
<div class="col" >
              <h2>Registro</h2>
              <form id="formulario" method="post">
                  <div class="form-group">
                      <label for="nombre">Nombre(s)</label>
                      <input class="form-control" id="nombre" name="nombre" value="<?php echo $usuario['nombre'];?>" required>
                  </div>

                  <div class="form-group">
                      <label for="apellido">Apellido(s)</label>
                      <input class="form-control" id="apellido" name="apellido" value="<?php echo $usuario['apellido'];?>" required>
                  </div>
                  <p>Ingresa el nombre y apellido completos, tal como saldrá en el certificado.</p>

                  <div class="form-group">
                      <label for="documento">Número de Documento (DNI/RUN/CI/Pasaporte)
                      </label>
                      <input class="form-control" type="text" id="documento" name="documento" value="<?php echo $usuario['documento'];?>" required>
                  </div>

                  <div class="form-group">
                      <label for="edad">Edad
                      </label>
                      <input class="form-control" type="text" id="edad" name="edad" value="<?php echo $usuario['edad'];?>" required>
                  </div>

                  <div class="form-group">
                      <label for="email">Correo Electrónico
                      </label>
                      <input class="form-control" type="text" id="email" name="email" value="<?php echo $usuario['email'];?>" required>
                  </div>

                  <div class="form-group">
                      <label for="telefono">Teléfono/Whatsapp</label>
                      <input class="form-control" type="text" id="telefono" name="telefono" value="<?php echo $usuario['telefono'];?>" required>
                  </div>

                  <div class="form-group">
                      <label for="pais">País
                      </label>
                      <select class="form-control form-select form-select-lg mb-3" id="pais" name="pais" aria-label="pais" required>
                      <?php
                      $options = ["Argentina",
                          "Bolivia",
                          "Brasil",
                          "Chile",
                          "Colombia",
                          "Costa Rica",
                          "Cuba",
                          "Ecuador",
                          "El Salvador",
                          "Guatemala",
                          "Honduras",
                          "México",
                          "Nicaragua",
                          "Panamá",
                          "Paraguay",
                          "Perú",
                          "Puerto Rico",
                          "República Dominicana",
                          "Uruguay",
                          "Venezuela",
                          "Otro"];
                      selectoptions($options, $usuario['pais']);?>
                      </select>
                  </div>

                  <div class="form-group">
                      <label for="universidad">Universidad/Empresa/Otro</label>
                      <input class="form-control" type="text" id="universidad" name="universidad" value="<?php echo $usuario['universidad'];?>">
                  </div>

                  <div class="form-group">
                      <label for="enteraste">¿Cómo te enteraste del CLEIN 2021? </label>
                      <select class="form-control form-select form-select-lg mb-3" id="enteraste" name="enteraste" aria-label="enteraste" required>
                          <?php
                          $options = ["Facebook/Instagram ALEIIAF",
                                      "Facebook/Instagram CLEIN",
                                      "Delegado ALEIIAF de mi país",
                                      "Mi Universidad",
                                      "Otro"];
                          selectoptions($options,$usuario['enteraste']);
                          ?>
                      </select>
                      <div id="enterasteotrodiv">
                          <label for="enterasteotro">Otro: </label>
                           <input class="form-control" type="text" id="enterasteotro" name="enterasteotro" value="" />
                      </div>
                  </div>

                  <div class="form-group">
                      <label for="enteraste">¿Participarás de manera Presencial o Virtual? </label>
                      <select class="form-control form-select form-select-lg mb-3" id="enteraste" name="enteraste" aria-label="enteraste" required>
                          <?php
                          $options = ["Presencial",
                              "Virtual"];
                          selectoptions($options,$usuario['presencial']);
                          ?>
                      </select>
                  </div>

                  <div class="form-group">
                      <label for="enteraste">¿Estudiante o Profesional? </label>
                      <select class="form-control form-select form-select-lg mb-3" id="enteraste" name="enteraste" aria-label="enteraste" required>
                          <?php
                          $options = ["Estudiante",
                              "Profesional"];
                          selectoptions($options,$usuario['presencial']);
                          ?>
                      </select>

                      <div id="enterasteotrodiv">
                          <label for="enterasteotro">Si elegiste estudiante, necesitarás registrar tu documento de estudiante: </label>
                          <input class="form-control" type="file" id="enterasteotro" name="enterasteotro" value="" />
                      </div>
                  </div>



                  <br>
                  <div id="alertGuardado" class="alert alert-success collapse" role="alert" >
                      <p>Datos Registrados</p>
                      <p>El siguiente paso es el <a href="formulariocomprobante.php"> envío del comprobante</a></p>
                  </div>
                  <div id="buttonConfirmo" class="align-content-center">
                      <button class="btn btn-primary btn-lg" type="submit">Registrarme</button>
                  </div>

              </form>


          </div>
      </div>
  </div>
        <?php
      include "_footer.php";
      ?></body>

<script src="js/guardarformulario.js"></script>
<script>
    $(document).ready(function() {
        $("#enterasteotrodiv").fadeOut();
        $("#enteraste").change(function(e) {
            e.preventDefault();
            if($("#enteraste option:selected").text()==="Otro")
            {
                $("#enterasteotrodiv").fadeIn();
            }
            else
            {
                $("#enterasteotrodiv").fadeOut();
            }
        });
    });
</script>
</html>

<?php
function selectoptions($options,$selectedoption="")
{
    $match=false;
    foreach($options as $option)
    {
        if($selectedoption===$option)
        {
            $match=true;
            echo "<option value='$option' selected>$option</option>";
        }else
        {
            echo "<option value='$option' >$option</option>";
        }
    }
    if(!$match)
    {
        echo "<option selected hidden></option>";
    }

}
?>
