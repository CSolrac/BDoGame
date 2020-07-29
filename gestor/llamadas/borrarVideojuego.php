<?php

require "../modelo/ListaVideojuegos.php";
require "../modelo/Videojuego.php";
require "../modelo/Plataforma.php";
require "../modelo/Bd.php";


$id = intval($_GET['id']);

//borrar elemento de la BD y su foto de la carpeta correspondiente
$videojuego = new Videojuego();
$videojuego->borrarVideojuego($id);

//renovamos la lista
$lista = new ListaVideojuegos();
$lista->obtenerTodo();

echo $lista->imprimirEnBack();