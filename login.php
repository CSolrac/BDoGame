<?php

require("gestor/modelo/Bd.php");
require("gestor/modelo/Usuario.php");

$errorLogin = false;
$errorRegistro = false;
$registro = false;

//login
if(isset($_POST['LogiPass']) && !empty($_POST['LogiPass'])){

    $nombre = addslashes($_POST['nombre']);
    $password = addslashes($_POST['LogiPass']);

    $usuario = new Usuario();
    if($usuario->logearse($nombre,$password)){

        //el usuario existe
        session_start();
        $_SESSION['nombre'] = $usuario->getNombre();
        $_SESSION['permiso'] = $usuario->getPermiso();
        $_SESSION['id'] = $usuario->getId();

        header('Location: bdogame.php');

    }else{

        //el usuario no existe
        $errorLogin = true;

    }

}

//Registro
if(isset($_POST['email']) && !empty($_POST['email'])){

    $usuario = new Usuario();
    $conexion = new Bd();

    if($conexion->todoOk($_POST['nombre'],$_POST['email'])){

        $registro = true;
        $usuario->registrarse($_POST);

    }else{

        $errorRegistro = true;

    }

}

?>

<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="./img/BDoGameIcon.png">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <script type="text/javascript" src="js/script.js"></script>
    <title>BDoGame Login</title>
</head>
<body>

<div id="registro" class="animate">
    <div class="caja_registro">
        <div class="formRegistro" >
            <img class = "botonX" onclick="cerrarRegistro()" src="img/x.png">
            <h2>Crear Nuevo Usuario</h2>
            <form id = "formularioRegistro" action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
                <label>Nombre de usuario</label>
                <input type="text"name="nombre" placeholder="Usuario" onchange="validacionTextInput(this)">
                <label>Contraseña</label>
                <input type="password" name="password" placeholder="Contraseña" onchange="validacionTextInput(this)">
                <label>Email</label>
                <input type="email" name="email" placeholder="Correo Electronico" onchange="validacionMail(this)">
                <div class="botlog" onclick="validarRegistro()">Registrarse</div>
            </form>
        </div>
    </div>
</div>


<div id = "logueando">
    <div class="cabecera">
        <div class="loguito"> <img class = "logo" src="img/BDoGameLogo2.png"></div>
        <label>Tu Base de Datos de Videojuegos</label>
    </div>
    <div id = "containerLogin">
        <form id = "formularioLogin" action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
            <label>Nombre de usuario</label>
            <input class="username" type="text" placeholder="Nombre de usuario" name="nombre" required>
            <label>Contraseña</label>
            <input class="password" type="password" placeholder="Contraseña" name="LogiPass" required>
            <!--<input class="remember" type="checkbox" checked="checked" name="remember"> Recordar contraseña-->
            <button class="botlog" onclick="validarLogin()">Login</button>
        </form>
        <button class="botreg" onclick="abrirRegistro()">Nuevo Usuario</button>
    </div>
</div>

<div id="errorLogin">

    <div id="errLog" class="animate">

        <div class="tituloError">ERROR</div>
        <div class="mensajeErrorTexto">No existe esa combinación de Nombre de Usuario y Contraseña</div>
        <div class="mensajeErrorLogin"><button class="botreg" onclick="cerrarErrorLogin()">Aceptar</button></div>

    </div>

</div>

<div id="errorRegistro">

    <div id="errReg" class="animate">

        <div class="tituloError">ERROR</div>
        <div class="mensajeErrorTexto">Ese Nombre o Email ya está en uso o no es válido, pruebe uno diferente</div>
        <div class="mensajeErrorLogin"><button class="botreg" onclick="cerrarErrorRegistro()">Aceptar</button></div>

    </div>

</div>

<div id="registroCorrecto">

    <div id="errReg" class="animate">

        <div class="tituloError">ENHORABUENA</div>
        <div class="mensajeErrorTexto">¡Se ha registrado correctamente!</div>
        <div class="mensajeErrorLogin"><button class="botreg" onclick="cerrarRegistroCorrecto()">Aceptar</button></div>

    </div>

</div>

<?php

if($errorLogin){

    echo "<script> abrirErrorLogin() </script>";

    $errorLogin = false;

}

if($errorRegistro){

    echo "<script> abrirErrorRegistro() </script>";

    $errorRegistro = false;

}

if($registro){

    echo "<script> abrirRegistroCorrecto() </script>";

    $registro = false;

}

include "includes/footer.php";

?>

</body>
</html>