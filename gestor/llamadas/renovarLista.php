<?php

require "../modelo/ListaVideojuegos.php";
require "../modelo/Videojuego.php";
require "../modelo/Plataforma.php";
require "../modelo/Bd.php";

//renovamos la lista
$lista = new ListaVideojuegos();
$lista->obtenerTodo();

echo $lista->imprimirEnBack();