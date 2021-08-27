<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require '../vendor/autoload.php';
require_once "_medoo.php";
require "php/session.php";

if(isset($_POST['pass'])&&isset($_POST['email']))
{

    $pass=$_POST['pass'];
    $email=$_POST['email'];

    $usuario=login($email,$pass);
    if($usuario)
    {
        $_SESSION['usuario']=$usuario;
        $_SESSION['idusuario']=$usuario['idusuario'];
        header("Location:evento.php");
    exit;
    }
    else{
        echo "Usuario no encontrado";
    }
}



function login($usuario,$pass)
{
    global $database;
    $data=$database->select("usuarios",
        '*'
        ,[
            'email'=>$usuario,
            'documento'=>$pass
        ]
    );
    if(isset($data[0])) {
        return $data[0];
    }else
    {
        return false;
    }

}

include "_head.php";

?>
<body>
<div class="container" style="background-color: #dddddd;">
    <nav class="nav nav-pills nav-justified">
        <a class="nav-link" aria-current="page" href="index.php"><img src="img/CHILE2021.png" ></a>
        <a class="nav-link active" aria-current="page" href="formularioregistro.php">Registro</a>
        <a class="nav-link" href="formulariocomprobante.php">Pago</a>
        <a class="nav-link" href="evento.php">Evento</a>
    </nav>
    <div class="row">
        <div class="col" >
<form id="formulario" method="post">
    <div class="form-group">
      <label for="email">Correo Electrónico
    </label>
      <input class="form-control" type="text" id="email" name="email" value="" required>
    </div>

    <div class="form-group">
    <label for="pass">Documento
    </label>
    <input class="form-control" type="password" id="pass" name="pass" value="" required>
    </div>
    <div id="buttonConfirmo" class="align-content-center">
        <button class="btn btn-primary btn-lg" type="submit">Login</button>
    </div>
</form>
        </div>
    </div>
</div>

<?php
include "_footer.php";

?>
