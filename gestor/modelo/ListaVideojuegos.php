<?php

/**
 * Clase ListaVideojuegos que contiene el constructor y los métodos de la misma
 * Estos objetos incluyen una lista de Videojuegos
 *
 * Class ListaVideojuegos
 */
class ListaVideojuegos
{

    /**
     * @var array Array con la lista de videojuegos
     */
    private $lista;
    /**
     * @var string Tabla a consultar en la BD
     */
    private $tabla;

    /**
     * Constructor de objetos tipo ListaVideojuegos
     *
     * ListaVideojuegos constructor.
     */
    public function __construct(){

        $this->lista = array();
        $this->tabla = "videojuegos";

    }

    /**
     *
     * Método que devuelve en una lista todos los elementos en la base de datos, en este caso Videojuegos
     *
     */
    public function obtenerTodo(){

        $sql = "SELECT * FROM " . $this->tabla . ";";

        $conexion = new Bd();
        $res = $conexion->consulta($sql);

        while( list($id, $nombre, $genero, $desarrollador, $distribuidor, $plataforma, $numeroJugadores, $caratula, $completado) = mysqli_fetch_array($res) ){

            $fila = new Videojuego($nombre, $genero, $desarrollador, $distribuidor, $plataforma, $numeroJugadores, $caratula, $completado, $id);

            array_push($this->lista,$fila);

        }

        //traza($this);

    }

    /**
     * Método que busca en la base de datos coincidencias que incluyan la palabra o letras introducidas
     *
     * @param $nombreABuscar Conjunto de caracteres a buscar
     */
    public function obtenerBusqueda($nombreABuscar){

        $nombreABuscar = preg_replace("#[^0-9a-z]#i","",$nombreABuscar);

        $sql = "SELECT * FROM " . $this->tabla . " WHERE nombre LIKE '%" . $nombreABuscar . "%';";
        /*SELECT * FROM videojuegos WHERE nombre REGEXP '(sonic)'*/

        $conexion = new Bd();
        $res = $conexion->consulta($sql);

        //echo $sql;

        while( list($id, $nombre, $genero, $desarrollador, $distribuidor, $plataforma, $numeroJugadores, $caratula, $completado) = mysqli_fetch_array($res) ){

            $fila = new Videojuego($nombre, $genero, $desarrollador, $distribuidor, $plataforma, $numeroJugadores, $caratula, $completado, $id);

            array_push($this->lista,$fila);

        }

        //traza($this);

    }

    /**
     * Método para crear código html que incluirá todos los Videojuegos de la Base de datos.
     *
     * @return string retorna el código html para imprimir la lista de videojuegos
     */
    public function imprimirEnBack(){

        $html = "<div id='listaCompleta'>";

        for($i=0;$i<sizeof($this->lista);$i++){

            $html .= $this->lista[$i]->impresion();

        }

        $html .= "</div>";

        return $html;
        
    }

}