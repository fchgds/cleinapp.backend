<?php
require_once "php/session.php";
include "_head.php";

logout();


?>
<body>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4 col-sm-8">
            <img class="" src="img/LogoCLEIN2021.png" style="width: 100%;" />
        </div>
    </div>

    <br>

    <div class="row">
        <div id="buttonConfirmo" class="align-content-center" style="text-align:center;">
            <a class="btn btn-primary btn-lg" href="formularioregistro.php">Nuevo Registro</a>
            <a class="btn btn-primary btn-lg" href="login.php">Registro Existente</a>
        </div>
    </div>
</div>



<?php
include "_footer.php";
?>
