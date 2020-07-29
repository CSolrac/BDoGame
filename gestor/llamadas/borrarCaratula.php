<?php

require "../modelo/ListaVideojuegos.php";
require "../modelo/Videojuego.php";
require "../modelo/Plataforma.php";
require "../modelo/Bd.php";

$id = intval($_GET['id']);

//borrar caratula de la BD y del servidor
$videojuego = new Videojuego();
$videojuego->borrarFotoVideojuego($id);

echo "<img src='img/noImage.png'>";