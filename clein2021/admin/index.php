<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    require $_SERVER['DOCUMENT_ROOT'].'/vendor/autoload.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . "/_medoo.php";
    require $_SERVER['DOCUMENT_ROOT'] . "/php/session.php";


    if(isset($_POST['password'])&&isset($_POST['user']))
    {

        $pass=$_POST['password'];
        $user=$_POST['user'];

        $usuario=login($user,$pass);
        if($usuario)
        {
            echo "Usuario encontrado";
            $_SESSION['usuario']=$usuario;
            $_SESSION['idadmin']=$usuario['idadmin'];
            header("Location:".$usuario['home']);
            exit;
        }
        else{
            echo "Usuario no encontrado";
        }
    }



    function login($usuario,$pass)
    {
        global $database;
        $data=$database->select("admin",
            '*'
            ,[
                'user'=>$usuario,
                'password'=>$pass
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
        <div class="row justify-content-center">
            <div class="col-md-4 col-sm-8">
                <img class="" src="../img/logo.png" style="width: 100%;" />
            </div>
        </div>
        <div class="row">
            <div class="col" >
                <form id="formulario" method="post">
                    <div class="form-group">
                        <label for="user">Usuario
                        </label>
                        <input class="form-control" type="text" id="user" name="user" value="" required>
                    </div>

                    <div class="form-group">
                        <label for="password">Password
                        </label>
                        <input class="form-control" type="password" id="password" name="password" value="" required>
                    </div>
                    <div id="buttonConfirmo" class="align-content-center">
                        <button class="btn btn-primary btn-lg" type="submit">Login</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

</body>

<?php
include "_footer.php";
?>
