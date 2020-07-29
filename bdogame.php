<?php

require "gestor/modelo/Videojuego.php";
require "gestor/modelo/ListaVideojuegos.php";
require "gestor/modelo/Plataforma.php";
require "gestor/modelo/funciones.php";
require("gestor/modelo/Bd.php");

$videojuego = new Videojuego();
$formEdit = false;

session_start();
if (empty($_SESSION['nombre'])) {

    header('Location: index.php');

}

if(isset($_GET['id']) && !empty($_GET['id'])){

    $id = intval($_GET['id']);

    $videojuego->getById($id);

    $formEdit = true;

}

if(isset($_POST['desarrollador']) && !empty($_POST['desarrollador'])){

    if(!empty($_POST['id'])){ //editar videojuego existente

        $id = intval($_POST['id']);

        $videojuego->editarVideojuego($id, $_POST,$_FILES['caratula']);

    }else{ //insertar nuevo videojuego

        $videojuego->insertarVideojuego($_POST,$_FILES['caratula']);

    }


}

if(isset($_POST['compania']) && !empty($_POST['compania'])){

    $plataforma = new Plataforma();
    $plataforma->insertarPlataforma($_POST,$_FILES['icono']);

}

$nombreABuscar = "";

if(isset($_POST['buscar']) && !empty($_POST['buscar'])){ //busqueda

    $nombreABuscar = $_POST['buscar'];

}

//echo $nombreABuscar;


$listaPlat = new Plataforma();
$listaPlat->obtenerTodo();

$lista = new ListaVideojuegos();
$lista->obtenerBusqueda($nombreABuscar);

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
    <title>BDoGame</title>

</head>

<body onload="inicio(), thisLink(0)">

    <div class="container">

        <header>
            <a href="bdogame.php"><img src="img/BDoGameLogo2.png"></a>
            <label>Tu Base de Datos de Videojuegos</label>

        </header>

        <section>

            <div id="main">

            </div>

            <div id="coleccion"> <!-----------PORTADA/COLECCION------------>

                <p class="parrafo">COLECCIÓN DE VIDEOJUEGOS</p>

                <div class="busqueda">
                    <form id="formBuscar" action="bdogame.php" method="post">
                        <input class="buscar" type="search" id="buscar" name="buscar" placeholder="Nombre del Juego">
                        <input class="botBusqueda" type="button" value="Buscar" onclick="submitBusqueda()">
                    </form>
                </div>

                <div id="listaTotal">

                    <?php

                    echo $lista->imprimirEnBack();

                    ?>

                </div>

                <div id="resultados"></div>

            </div>


            <div id="creacion"> <!-----------INSERTAR------------>

                <p name="lol" class="parrafo">Introduce los datos del videojuego</p>

                <form id="formulario" class="inputs" name="videojuego" action="<?php echo $_SERVER['PHP_SELF']?>" method="post" enctype="multipart/form-data">

                    <div class="lineasInput"><label class="labeles">Nombre: </label><input class="campos" type="text" name="nombre" placeholder="Nombre del Juego" onchange="validacionTextInput(this)"></div>

                    <div class="lineasInput"><label class="labeles">Género: </label><input class="campos" type="text" name="genero" placeholder="Género" onchange="validacionTextInput(this)"></div>

                    <div class="lineasInput"><label class="labeles">Desarrollador: </label><input class="campos" type="text" name="desarrollador" placeholder="Nombre del desarrollador" onchange="validacionTextInput(this)"></div>

                    <div class="lineasInput"><label class="labeles">Distribuidor: </label><input class="campos" type="text" name="distribuidor" placeholder="Nombre del distribuidor" onchange="validacionTextInput(this)"></div>

                    <div class="lineasInput">
                        <label class="labeles">Plataforma: </label> <!--sacar estas opciones de la BD-->
                        <select class="plat" name="plataforma" onchange="validacionSelect(this)">
                            <option value="0">Plataforma</option>
                            <?php

                            echo $listaPlat->rellenarSelectPlat();

                            ?>
                        </select>

                        <input id="addPlat" type="button" value="Nueva Plataforma" onclick="abrirPlataforma()">

                    </div>

                    <div class="lineasInput">
                        <label class="labeles">Modalidad: </label>
                        <select class="select" name="jugadores" onchange="validacionSelect(this)">
                            <option value="0">Modalidad de juego</option>
                            <option value="Un Jugador">Un Jugador</option>
                            <option value="Multijugador Local">Multijugador Local</option>
                            <option value="Multijugador Online">Multijugador Online</option>
                        </select>
                    </div>

                    <div class="lineasInput">
                        <label class="labeles"> Carátula: </label>
                        <div class="inputfile-box">
                            <input type="file" id="file" class="inputfile" name="caratula" onchange='uploadFile(this), validacionFile(this,0)'>
                            <label for="file">
                                <span id="file-name" class="file-box"></span>
                                <span class="file-button">
                              <i class="fa fa-upload" aria-hidden="true"></i>
                                <img src="img/upload.png">Subir Archivo
                            </span>
                            </label>
                        </div>
                    </div>

                    <div class="lineasInput">
                        <label class="labeles"> Completado:</label>
                        <label class="containerCheck">
                            <input type="checkbox" name="completado" value="1">
                            <span class="checkmark"></span>
                        </label>

                    </div>

                    <div id="error"></div>

                    <div class="lineasInputButton"><button class="button" type="button" value="Enviar" onclick="validacion()">Insertar</button></div>

                </form>

            </div>

        </section>

        <div id="backEd"> <!-----------EDITAR------------>

            <div id="edicion" class="animate">

                <form id="formularioEditar"  name="videojuego" action="<?php echo $_SERVER['PHP_SELF']?>" method="post" enctype="multipart/form-data">

                    <div class="tituloEditar">

                        <a href="bdogame.php"><img class = "botonXEd" onclick="cerrarEditar()" src="img/x.png"></a>

                        <p name="lol" class="parrafo">Editar datos de videojuego</p>

                    </div>

                    <div class="mainEditar">

                        <div class="izquierda">

                            <input type="hidden" name="id" value="<?php echo $videojuego->getId() ?>">

                            <div class="lineasInput"><label class="labeles">Nombre: </label><input class="campos" type="text" name="nombre" placeholder="Nombre del Juego" value="<?php echo $videojuego->getNombre() ?>" onchange="validacionTextInput(this)"></div>

                            <div class="lineasInput"><label class="labeles">Género: </label><input class="campos" type="text" name="genero" placeholder="Género" value="<?php echo $videojuego->getGenero() ?>" onchange="validacionTextInput(this)"></div>

                            <div class="lineasInput"><label class="labeles">Desarrollador: </label><input class="campos" type="text" name="desarrollador" placeholder="Nombre del desarrollador" value="<?php echo $videojuego->getDesarrollador() ?>" onchange="validacionTextInput(this)"></div>

                            <div class="lineasInput"><label class="labeles">Distribuidor: </label><input class="campos" type="text" name="distribuidor" placeholder="Nombre del distribuidor" value="<?php echo $videojuego->getDistribuidor() ?>" onchange="validacionTextInput(this)"></div>

                            <div class="lineasInput">
                                <label class="labeles">Plataforma: </label> <!--sacar estas opciones de la BD-->
                                <select class="select" name="plataforma" onchange="validacionSelect(this)">
                                    <option value="<?php echo $videojuego->getPlataforma() ?>">
                                        <?php
                                            $plat = new Plataforma();
                                            $nomPlat = $plat->obtenerNombrePlataforma($videojuego->getPlataforma());
                                            echo $nomPlat;
                                        ?> (Actual)
                                    </option>
                                    <?php

                                    echo $listaPlat->rellenarSelectPlat();

                                    ?>
                                </select>

                            </div>

                            <div class="lineasInput">
                                <label class="labeles">Modalidad: </label>
                                <select class="select" name="jugadores" onchange="validacionSelect(this)">
                                    <option value="<?php echo $videojuego->getNumeroJugadores() ?>"><?php echo $videojuego->getNumeroJugadores() ?> (Actual)</option>
                                    <option value="Un Jugador">Un Jugador</option>
                                    <option value="Multijugador Local">Multijugador Local</option>
                                    <option value="Multijugador Online">Multijugador Online</option>
                                </select>
                            </div>

                        </div>

                        <div class="derecha">

                            <div id="infoCaratula">

                                <div id="caratulaEditar">

                                    <?php
                                        echo "<img src='" . $videojuego->getCarpeta() . $videojuego->getCaratula() . "' >";
                                    ?>

                                </div>

                                <?php
                                    echo "<a href='javascript: borrarCaratula(" . $videojuego->getId() . ")' class='bott'><label>Borrar Caratula</label> <div class='imgeditdel'><img src='img/delete.png'></div> </a>";
                                ?>

                            </div>

                            <div class="lineasInput">
                                <label class="labeles"> Carátula: </label>
                                <div class="inputfile-box">
                                    <input type="file" id="fileEd" class="inputfile" name="caratula" onchange='uploadEditar(this), validacionFile(this,1)'>
                                    <label for="fileEd">
                                        <span id="file-Editar" class="file-box"></span>
                                        <span class="file-button">
                                          <i class="fa fa-upload" aria-hidden="true"></i>
                                            <img src="img/upload.png">Subir Archivo
                                        </span>
                                    </label>
                                </div>
                            </div>

                            <?php

                            $check = "";

                            if($videojuego->getCompletado() == 1){

                                $check = "checked";

                            }

                            ?>

                            <div class="lineasInput">

                                <label class="labeles"> Completado:</label>
                                <label class="containerCheck">
                                    <input type="checkbox" name="completado" value="1" <?php echo $check ?>>
                                    <span class="checkmark"></span>
                                </label>

                            </div>

                            <div id="errorEd"></div>

                        </div>

                    </div>


                    <div class="lineasInputButton"><button class="button" type="button" value="Enviar" onclick="validacionEd()">Editar</button></div>


                </form>

            </div>

        </div>

        <div id="backPlat"> <!-----------PLATAFORMA------------>

            <div id="plataformaWin" class="animate">

                <form id="formularioPlataforma"  name="plataforma" action="<?php echo $_SERVER['PHP_SELF']?>" method="post" enctype="multipart/form-data">

                    <div class="tituloEditar">

                        <img class = "botonXEd" onclick="cerrarPlataforma()" src="img/x.png">

                        <p name="lol" class="parrafo">Insertar Nueva Plataforma</p>

                    </div>

                    <div class="lineasInput"><label class="labeles">Nombre: </label><input class="campos" type="text" name="nombre" placeholder="Nombre de la Plataforma" onchange="validacionTextInput(this)"></div>

                    <div class="lineasInput"><label class="labeles">Compañia: </label><input class="campos" type="text" name="compania" placeholder="Compañia" onchange="validacionTextInput(this)"></div>

                    <div class="lineasInput">
                        <label class="labeles">Tipo Plataforma: </label>
                        <select class="select" name="tipo" onchange="validacionSelect(this)">
                            <option value="0">Tipo de Plataforma</option>
                            <option value="Sobremesa">Sobremesa</option>
                            <option value="Portátil">Portátil</option>
                            <option value="Híbrida">Híbrida</option>
                        </select>
                    </div>

                    <div class="lineasInput">
                        <label class="labeles"> Icono: </label>
                        <div class="inputfile-box">
                            <input type="file" id="filePlat" class="inputfile" name="icono" onchange='uploadPlataforma(this), validacionFile(this,2)'>
                            <label for="filePlat">
                                <span id="file-Plat" class="file-box"></span>
                                <span class="file-button">
                                          <i class="fa fa-upload" aria-hidden="true"></i>
                                            <img src="img/upload.png">Subir Archivo
                                        </span>
                            </label>
                        </div>
                    </div>

                    <div id="errorPlat"></div>

                    <div class="lineasInputButton"><button class="button" type="button" value="Enviar" onclick="validacionPlat()">Insertar</button></div>


                </form>

            </div>

        </div>

        <aside>

            <div class="menu">

                <div class="boton" id="botonInicial" onmouseover="on(0)" onmouseout="off(0)" onclick="thisLink(0)"><img src="img/col2.png"> <div class="label">Colección</div> </div>

                <div class="boton" onmouseover="on(1)" onmouseout="off(1)"  onclick="thisLink(1)"><img src="img/plus2.png"> <div class="label">Insertar Juego</div></div>

            </div>

            <div class="usuario">

                <img src="img/user.png">

                <div class="user">

                    <div class="userText"><?php echo $_SESSION['nombre']; ?></div>
                    <div id="cerrarSesion" class="userText" onclick="location.href='logout.php';">Cerrar sesión</div>

                </div>

            </div>

        </aside>

    </div>

    <?php

    if($formEdit){

        echo "<script> abrirEditar() </script>";

    }

    include "includes/footer.php";

    ?>

</body>
</html>