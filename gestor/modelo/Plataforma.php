<?php

/**
 * Clase Plataforma que contiene el constructor y los métodos de la misma
 *
 * Class Plataforma
 */
class Plataforma
{

    /**
     * @var string ID de la plataforma
     */
    private $id;
    /**
     * @var string Nombre de la plataforma
     */
    private $nombre;
    /**
     * @var string Compñia creadora de la plataforma
     */
    private $compania;
    /**
     * @var string Tipo de plataforma
     */
    private $tipo;
    /**
     * @var string Icono de la plataforma
     */
    private $icono;
    /**
     * @var string Tabla donde se consultan los datos en la BD
     */
    private $tabla;
    /**
     * @var string Carpeta donde se guardan los iconos de las plataformas
     */
    private $carpeta;
    /**
     * @var array Array con una lista de plataformas
     */
    private $lista;

    /**
     * Constructor de objetos Plataforma
     * @param string $nombre Nombre de la plataforma
     * @param string $compania Compañia de la Plataforma
     * @param string $tipo Tipo de Plataforma
     * @param string $icono Icono de la Platforma
     * @param string $id ID de la base de datos de la Plataforma
     */
    public function __construct($nombre ="", $compania ="", $tipo ="", $icono ="", $id ="")
    {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->compania = $compania;
        $this->tipo = $tipo;
        $this->icono = $icono;
        $this->tabla = "plataforma";
        $this->carpeta = "iconosPlataformas/";
        $this->lista = array();
    }

    /**
     * Método get para el ID de Plataforma
     *
     * @return string retorna el ID de la plataforma
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Método set para el ID de Plataforma
     *
     * @param string $id ID para el objeto Plataforma
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * Método get para el nombre de la Plataforma
     *
     * @return string retorna el nombre de la plataforma
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Método set para el nombre de la Plataforma
     *
     * @param string $nombre Nombre para el objeto Plataforma
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    /**
     * Método get para la compañia de la Plataforma
     *
     * @return string retorna la compañia de la plataforma
     */
    public function getCompania()
    {
        return $this->compania;
    }

    /**
     * Método set para la compañia de la Plataforma
     *
     * @param string $compania Compañia para el objeto Plataforma
     */
    public function setCompania($compania)
    {
        $this->compania = $compania;
    }

    /**
     * Método get para el tipo de la Plataforma
     *
     * @return string retorna el tipo de la plataforma
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * Método set para el tipo de la Plataforma
     *
     * @param string $tipo Tipo del objeto Plataforma
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;
    }

    /**
     * Método get para el icono de la Plataforma
     *
     * @return string retorna el icono de la plataforma
     */
    public function getIcono()
    {

        if(strlen($this->icono)==0){

            $this->icono = "noImage.png";

        }

        return $this->icono;

    }

    /**
     * Método set para el icono de la Plataforma
     *
     * @param string $icono Icono de la objeto Plataforma
     */
    public function setIcono($icono)
    {
        $this->icono = $icono;
    }

    /**
     * Método get para el nombre de la tabla de la Base de datos de la Plataforma
     *
     * @return string retorna el nombre de la tabla de la base de datos de la plataforma
     */
    public function getTabla()
    {
        return $this->tabla;
    }

    /**
     * Método set para el nombre de la tabla de la Base de datos de la Plataforma
     *
     * @param string $tabla Nombre de la tabla de la Base de datos de la Plataforma
     */
    public function setTabla($tabla)
    {
        $this->tabla = $tabla;
    }

    /**
     * Método get para la carpeta donde se guardaran los iconos de la Plataforma
     *
     * @return string retorna la carpeta donde se guardaran los iconos de la Plataforma
     */
    public function getCarpeta()
    {
        return $this->carpeta;
    }

    /**
     * Método set para la carpeta donde se guardaran los iconos de la Plataforma
     *
     * @param string $carpeta Carpeta donde se guardaran los iconos de la Plataforma
     */
    public function setCarpeta($carpeta)
    {
        $this->carpeta = $carpeta;
    }

    /**
     *
     * Método que devuelve en una lista todos los elementos en la base de datos, en este caso Plataformas
     *
     */
    public function obtenerTodo(){

        $sql = "SELECT * FROM " . $this->tabla . ";";

        $conexion = new Bd();
        $res = $conexion->consulta($sql);

        while( list($id, $nombre, $compania, $tipo, $icono) = mysqli_fetch_array($res) ){

            $fila = new Plataforma($nombre, $compania, $tipo, $icono, $id);

            array_push($this->lista,$fila);

        }

        //traza($this);

    }

    /**
     * Método que devuelve un código html que completa un select con una opción por cada plataforma en la base de datos
     *
     * @return string retorna el código html que completa un select con una opción por cada plataforma en la base de datos
     */
    public function rellenarSelectPlat()
    {

        $html="";

        for ($i = 0; $i < sizeof($this->lista); $i++) {
            $html .= $this->lista[$i]->imprimrPlatOption();
        }

        return $html;
    }

    /**
     * Método que escribe una linea de opción de un select que contiene una Plataforma
     *
     * @return string retorna el html con la opción del select con los datos de un Plataforma
     */
    public function imprimrPlatOption()
    {
        $html ="<option value='".$this->id."'>".$this->nombre."</option>";

        return $html;

    }

    /**
     * Método para obtener a través de un id el nombre de una plataforma de la base de datos
     *
     * @param $n ID de la Plataforma a consultar
     * @return mixed retorna el nombre de la plataforma
     */
    public function obtenerNombrePlataforma($n){

        $sql = "SELECT nombre FROM " . $this->tabla . " WHERE id=". $n . ";";

        $conexion = new Bd();
        $res = $conexion->consulta($sql);

        $row = mysqli_fetch_array($res);

        $plat = $row['nombre'];

        return $plat;

    }

    /**
     * Método para obtener a través de un id el icono de una plataforma de la base de datos
     *
     * @param $n ID de la Plataforma a consultar
     * @return string retorna la ruta del icono de la Plataforma
     */
    public function obtenerIconoPlataforma($n){

        $sql = "SELECT icono FROM " . $this->tabla . " WHERE id=". $n . ";";

        $conexion = new Bd();
        $res = $conexion->consulta($sql);

        $row = mysqli_fetch_array($res);

        if(strlen($row['icono'])==0){

            $icon = "img/noImage.png";

        }else{

            $icon = $this->carpeta . $row['icono'];

        }

        return $icon;

    }

    /**
     * Método para insertar una Plataforma en la Base de datos
     *
     * @param $datos Datos del formulario que contiene los datos para la nueva Plataforma
     * @param $foto Icono asociado a la nueva Plataforma
     */
    public function insertarPlataforma($datos,$foto){

        $conexion = new Bd();

        $conexion->addBd($this->tabla,$datos,$this->carpeta,$foto,"icono");

    }


}