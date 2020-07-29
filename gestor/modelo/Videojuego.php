<?php

/**
 * Clase Videojuego que contiene el constructor y los métodos de la misma
 *
 * Class Videojuego
 */
class Videojuego
{

    /**
     * @var string ID del Videojuego
     */
    private $id;
    /**
     * @var string Nombre del Videojuego
     */
    private $nombre;
    /**
     * @var string Género del Videojuego
     */
    private $genero;
    /**
     * @var string Desarrollador del Videojuego
     */
    private $desarrollador;
    /**
     * @var string Distribuidor del Videojuego
     */
    private $distribuidor;
    /**
     * @var string Plataforma del Videojuego
     */
    private $plataforma;
    /**
     * @var string Modalidad de número de jugadores del Videojuego
     */
    private $numeroJugadores;
    /**
     * @var string Carátula o Imagen del Videojuego
     */
    private $caratula;
    /**
     * @var string Determina si se ha completado el videojuego o no
     */
    private $completado;
    /**
     * @var string Tabla donde realizar las consultas en la BD
     */
    private $tabla;
    /**
     * @var string Carpeta donde guardamos las carátulas de lis videojuegos
     */
    private $carpeta;

    /**
     * Constructor de objetos Videojuegos
     *
     * Videojuego constructor.
     * @param string $nombre Nombre del Videojuego
     * @param string $genero Género del Videojuego
     * @param string $desarrollador Desarrollador del Videojuego
     * @param string $distribuidor Distribuidor del Videojuego
     * @param string $plataforma Plataforma del Videojuego
     * @param string $numeroJugadores Modalidad de número de jugadores del Videojuego
     * @param string $caratula Carátula o imagen asociada al Videojuego
     * @param string $completado Variable booleana que marca si el Videojuego ha sido completado o no
     * @param string $id ID del Videojuego en la base de datos
     */
    public function __construct($nombre = "", $genero = "", $desarrollador = "", $distribuidor = "", $plataforma = "", $numeroJugadores = "", $caratula = "", $completado = "", $id = "")
    {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->genero = $genero;
        $this->desarrollador = $desarrollador;
        $this->distribuidor = $distribuidor;
        $this->plataforma = $plataforma;
        $this->numeroJugadores = $numeroJugadores;
        $this->caratula = $caratula;
        $this->completado = $completado;
        $this->tabla = "videojuegos";
        $this->carpeta = "caratulas/";
    }

    /**
     * Método para construir un objeto Videojuego con los datos correspondientes con la base de datos
     *
     * @param string $id ID del Videojuego en la base de datos
     * @param string $nombre Nombre del Videojuego
     * @param string $genero Género del Videojuego
     * @param string $desarrollador Desarrollador del Videojuego
     * @param string $distribuidor Distribuidor del Videojuego
     * @param string $plataforma Plataforma del Videojuego
     * @param string $numeroJugadores Modalidad de número de jugadores del Videojuego
     * @param string $caratula Carátula o imagen asociada al Videojuego
     * @param string $completado Variable booleana que marca si el Videojuego ha sido completado o no
     */
    private function llenarDeBd($id, $nombre, $genero, $desarrollador, $distribuidor, $plataforma, $numeroJugadores, $caratula, $completado)
    {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->genero = $genero;
        $this->desarrollador = $desarrollador;
        $this->distribuidor = $distribuidor;
        $this->plataforma = $plataforma;
        $this->numeroJugadores = $numeroJugadores;
        $this->caratula = $caratula;
        $this->completado = $completado;
    }

    /**
     * Método get para el ID de Videojuego
     *
     * @return string retorna el ID de la Videojuego
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Método set para el ID de Videojuego
     *
     * @param string $id ID para el objeto Videojuego
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * Método get para el nombre del Videojuego
     *
     * @return string retorna el nombre del Videojuego
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Método set para el nombre del Videojuego
     *
     * @param string $nombre Nombre para el objeto Videojuego
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    /**
     * Método get para el género del Videojuego
     *
     * @return string retorna el género del Videojuego
     */
    public function getGenero()
    {
        return $this->genero;
    }

    /**
     * Método set para el género del Videojuego
     *
     * @param string $genero Género para el objeto Videojuego
     */
    public function setGenero($genero)
    {
        $this->genero = $genero;
    }

    /**
     * Método get para el desarrollador del Videojuego
     *
     * @return string retorna el desarrollador del Videojuego
     */
    public function getDesarrollador()
    {
        return $this->desarrollador;
    }

    /**
     * Método set para el desarrollador del Videojuego
     *
     * @param string $desarrollador Desarrollador para el objeto Videojuego
     */
    public function setDesarrollador($desarrollador)
    {
        $this->desarrollador = $desarrollador;
    }

    /**
     * Método get para el distribuidor del Videojuego
     *
     * @return string retorna el distribuidor del Videojuego
     */
    public function getDistribuidor()
    {
        return $this->distribuidor;
    }

    /**
     * Método set para el distribuidor del Videojuego
     *
     * @param string $distribuidor Distribuidor para el objeto Videojuego
     */
    public function setDistribuidor($distribuidor)
    {
        $this->distribuidor = $distribuidor;
    }

    /**
     * Método get para la plataforma del Videojuego
     *
     * @return string retorna la plataforma del Videojuego
     */
    public function getPlataforma()
    {
        return $this->plataforma;
    }

    /**
     * Método set para la plataforma del Videojuego
     *
     * @param string $plataforma Plataforma para el objeto Videojuego
     */
    public function setPlataforma($plataforma)
    {
        $this->plataforma = $plataforma;
    }

    /**
     * Método get para la modalidad del número de jugadores del Videojuego
     *
     * @return string retorna la modalidad del número de jugadores del Videojuego
     */
    public function getNumeroJugadores()
    {
        return $this->numeroJugadores;
    }

    /**
     * Método set para la modalidad del número de jugadores del Videojuego
     *
     * @param string $numeroJugadores Modalidad del número de jugadores para el objeto Videojuego
     */
    public function setNumeroJugadores($numeroJugadores)
    {
        $this->numeroJugadores = $numeroJugadores;
    }

    /**
     * Método get para la caratula del Videojuego
     *
     * @return string retorna la caratula del Videojuego
     */
    public function getCaratula()
    {

        if(strlen($this->caratula)==0){

            $this->caratula = "noImage.png";

        }

        return $this->caratula;
    }

    /**
     * Método set para la caratula del Videojuego
     *
     * @param string $caratula Carátula o imagen para el objeto Videojuego
     */
    public function setCaratula($caratula)
    {
        $this->caratula = $caratula;
    }

    /**
     * Método get para la variable booleana 'completado' del Videojuego
     *
     * @return string retorna la variable booleana 'completado' del Videojuego
     */
    public function getCompletado()
    {
        return $this->completado;
    }

    /**
     * Método set para la variable booleana 'completado' del Videojuego
     *
     * @param string $completado Variable booleana 'completado' para el objeto Videojuego
     */
    public function setCompletado($completado)
    {
        $this->completado = $completado;
    }

    /**
     * Método get para la carpeta donde se guardaran la imagen del Videojuego
     *
     * @return string retorna la carpeta donde se guardaran la imagen del Videojuego
     */
    public function getCarpeta()
    {
        return $this->carpeta;
    }

    /**
     * Método set para la carpeta donde se guardaran la imagen del Videojuego
     *
     * @param string $carpeta Carpeta donde se guardaran la imagen para el objeto Videojuego
     */
    public function setCarpeta($carpeta)
    {
        $this->carpeta = $carpeta;
    }

    /**
     * Método para insertar videojuegos en la base de datos
     *
     * @param $datos Datos del formulario donde se introducen los datos del videojuego a insertar
     * @param $foto Imagen o carátula del videojuego
     */
    public function insertarVideojuego($datos,$foto){

        if(!isset($datos['completado'])){

            $datos['completado'] = 0;

        }

        $conexion = new Bd();

        $conexion->addBd($this->tabla,$datos,$this->carpeta,$foto, "caratula");

    }

    /**
     * Método para editar la entrada de un videojuego en la base de datos
     *
     * @param $id ID en la base de datos del videojuego a editar
     * @param $datos Datos del formulario de editar videojuego
     * @param $foto Imagen o caratula del videojuego
     */
    public function editarVideojuego($id,$datos,$foto){

        if(!isset($datos['completado'])){

            $datos['completado'] = 0;

        }

        $conexion = new Bd();

        $conexion->updateBd($id, $this->tabla, $datos, $foto, $this->carpeta);

    }

    /**
     * Método para eliminar la entrada de un videojuego de la base de datos
     *
     * @param $id ID en la base de datos del videojuego a eliminar
     */
    public function borrarVideojuego($id){

        $conexion = new Bd();

        $conexion->borrarFoto($id, $this->tabla, 'caratula', "../../".$this->carpeta.$this->caratula);

        $sql = "DELETE FROM " . $this->tabla . " WHERE id=" . $id;

        $conexion->consulta($sql);

    }

    /**
     * Método para eliminar la entrada de la imagen/carátula del videojuego en la base de datos
     *
     * @param $id ID en la base de datos del videojuego cuya imagen se va a eliminar
     */
    public function borrarFotoVideojuego($id){

        $conexion = new Bd();

        $conexion->borrarFoto($id, $this->tabla, 'caratula', "../../".$this->carpeta.$this->caratula);

        $sql = "UPDATE " . $this->tabla . " SET caratula='' WHERE id=" . $id;

        $conexion->consulta($sql);

    }

    /**
     * Método para obtener un videojuego determinado de la base de datos a través de su ID
     *
     * @param $id ID del videojuego a consultar
     */
    public function getById($id){

        $sql = "SELECT * from " . $this->tabla . " WHERE id=" . $id;

        $conexion = new Bd();

        $res = $conexion->consulta($sql);

        list($id, $nombre, $genero, $desarrollador, $distribuidor, $plataforma, $numeroJugadores, $caratula, $completado) = mysqli_fetch_array($res);

        $this->llenarDeBd($id, $nombre, $genero, $desarrollador, $distribuidor, $plataforma, $numeroJugadores, $caratula, $completado);

    }

    /**
     * Método para imprimir en html la estructura para mostrar la información de un videojuego de la base de datos
     *
     * @return string retorna el html con la estructura que contiene la información del videojuego
     */
    public function impresion(){

        $complete = "";
        $plat = new Plataforma();

        $nomPlat = $plat->obtenerNombrePlataforma($this->plataforma);
        $srcIconoPlat = $plat->obtenerIconoPlataforma($this->plataforma);

        if($this->completado == 0){

            $complete = "img/completeNO.png";

        }else{

            $complete = "img/completeYES.png";

        }

        if($this->caratula == null){

            $this->caratula = "noImage.png";

        }

        $html = "<div class='videogame'> 
                    <img class='caratula' src='" . $this->carpeta . $this->caratula . "'" . "> 
                    <div class='info1'> 
                        <div class='showtitulo'> " . $this->nombre . "<div class='showjug'>(" . $this->numeroJugadores . ")</div></div> 
                        
                        <label>Género: </label>" . $this->genero . " 
                        <div class='showplat'><img class='iconito' src='" . $srcIconoPlat . "'" . "><a>" . $nomPlat . "</a></div>
                    </div> 
                    <div class='info2'>
                        
                        <label>Desarrollador: </label>" .  $this->desarrollador . " 
                        <label>Distribuidor: </label>" .  $this->distribuidor . " 
                        <div class='complete'> <label>Completado:</label><img src='" . $complete . "'".   "></div> 
                    </div>
                    <div class='botones'> 
                        <a href='?id=".$this->id."'  class='bott'><label>Editar</label><div class='imgeditdel'><img src='img/edit.png'></div></a>
                        <a href='javascript: borrarVideojuego(" . $this->id . ")' class='bott'><label>Borrar</label> <div class='imgeditdel'><img src='img/delete.png'></div> </a> 
                    </div>
               </div>";

        return $html;
    }

}