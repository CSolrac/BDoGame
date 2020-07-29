<?php

/**
 * Clase Base de Datos que contiene el constructor y los métodos de la misma
 *
 * Class Bd
 */
class Bd{
    /**
     * @var string Nombre del servidor
     */
    private $server = "localhost";
    /**
     * @var string Nombre del usuario
     */
    private $usuario = "root";
    /**
     * @var string Contraseña de acceso a la BD
     */
    private $pass = "";
    /**
     * @var string Nombre de la BD
     */
    private $basedatos = "bdogame";
    /**
     * @var mysqli Conexion a la BD
     */
    private $conexion;
    /**
     * @var Resultado de la consulta
     */
    private $resultado;

    /**
     * Constructor de la clase Bd, se usa para crear los objetos Bd
     *
     * Bd constructor.
     */
    public function __construct(){
        $this->conexion = new mysqli($this->server, $this->usuario, $this->pass , $this->basedatos);
        $this->conexion->select_db($this->basedatos);
        $this->conexion->query("SET NAMES 'utf8'");
    }

    /**
     * Método para añadir datos a la Base de Datos
     *
     * @param $tabla Tabla de la base de datos en la que se desea introducir los datos
     * @param $datos Conjunto de datos obtenidos del formulario mediante un POST, contiene los datos del elemento a introducir en la base de datos
     * @param $carpeta Carpeta en la que se introducirán las fotos a subir
     * @param $foto Foto a subir
     * @param $campoFoto Nombre de la columna en la base de datos que contiene el nombre de la foto
     * @return bool|mysqli_result retorna una variable booleana como resultado de la consulta
     */
    public function addBd($tabla, $datos, $carpeta, $foto, $campoFoto){
        $claves  = array();
        $valores = array();

        //Recojemos todas las claves y valores insertandolas en los arraylist de claves y valores
        foreach ($datos as $clave => $valor){

            $claves[].= $clave;
            $valores[].= "'".addslashes($valor)."'";

        }

        if($foto['name'] != ""){

            $ruta = subirFoto($foto,$carpeta);
            $claves[] = $campoFoto;
            $valores[] = "'".$ruta."'";

        }

        //Sentencia Sql de la insercion de datos.
        $sql = "INSERT INTO ".$tabla." (".implode(',', $claves).") VALUES  (".implode(',', $valores).")";

        //echo $sql;
        $this->resultado =   $this->conexion->query($sql);
        $res = $this->resultado;

        return $res;

    }

    /**
     * Método para actualizar campos en la base de datos
     *
     * @param $id ID de la base de datos de la entrada a modificar
     * @param $tabla Tabla de la base de datos donde se encuentra la entrada a modificar
     * @param $datos Conjunto de datos obtenidos del formulario mediante un POST, nuevos datos de la entrada a modificar
     * @param string $foto Foto a subir
     * @param $carpeta Carpeta en la que se introducirá las fotos a subir
     */
    public function updateBd($id, $tabla, $datos, $foto = "", $carpeta){

        $sentencias = array();

        foreach ($datos as $campo => $valor) {

            if ($campo != "id" && $campo != "x" && $campo != "y") {

                $sentencias[] = $campo . "='".addslashes($valor)."'";

            }
        }

        if(strlen($foto['name'])>0){

            $this->borrarFoto($id, $tabla, 'caratula', $carpeta);
            $ruta = subirFoto($foto, $carpeta);
            $sentencias[] = "caratula='".$ruta."'";

        }

        $campos = implode(",", $sentencias);

        $sql = "UPDATE " . $tabla . " SET " . $campos . " WHERE id=" . $id;

        $conexion = new Bd();

        //echo $sql;

        $conexion->consulta($sql);

    }

    /**
     * Método para borrar las fotos de la carpeta correpondiente
     *
     * @param $id ID del elemento de la base de datos donde se encuentra el nombre de la foto a borrar
     * @param $tabla Tabla de la base de datos en la que se encuentra el nombre de la foto a borrar
     * @param $campo Nombre del campo de la base de datos que tiene el nombre de la foto a borrar
     * @param $carpeta Carpeta donde se guardan las imagenes, en la que está la imagen a borrar
     */
    public function borrarFoto($id, $tabla, $campo, $carpeta){

        $sql = "SELECT " . $campo . " FROM " . $tabla . " WHERE id='" . $id . "'";

        $this->resultado = $this->conexion->query($sql);

        if($this->numeroElementos()>0) {

            $res = mysqli_fetch_assoc($this->resultado);

            $rutaAborrar = $res[$campo];

            if($rutaAborrar != null){ //evitar error cuando el videojuego carece de caratula

                unlink($carpeta.$rutaAborrar);

            }
        }
    }

    /**
     * Método para añadir un nuevo usuario a la base de datos al registrarse
     *
     * @param $tabla Tabla de la base de datos donde se guardarán los datos de los usuarios registrados
     * @param $datos Conjunto de datos obtenidos del formulario mediante un POST, contiene los datos del usuario a registrar
     * @return bool|mysqli_result retorna una variable booleana como resultado de la consulta
     */
    public function addUser($tabla, $datos){
        $claves  = array();
        $valores = array();

        //Recojemos todas las claves y valores insertandolas en los arraylist de claves y valores
        foreach ($datos as $clave => $valor){

            $claves[].= $clave;
            $valores[].= addslashes($valor);

        }

        $valores[1] = md5($valores[1]);

        for($i=0;$i<sizeof($valores);$i++){
            $valores[$i] = "'".$valores[$i]."'";
        }

        //Sentencia Sql de la insercion de datos.
        $sql = "INSERT INTO ".$tabla." (".implode(',', $claves).") VALUES  (".implode(',', $valores).")";

        //echo $sql;

        $this->resultado =   $this->conexion->query($sql);
        $res = $this->resultado;

        return $res;

    }

    /**
     * Método para realizar una consulta a la base de datos
     *
     * @param $consulta Contiene la consulta que se enviará a la base de datos
     * @return bool|mysqli_result retorna una variable booleana como resultado de la consulta
     */
    public function consulta($consulta){
        //echo $consulta;
        $this->resultado =   $this->conexion->query($consulta);
        $res = $this->resultado ;
        return $res;
    }

    /**
     * Método para realizar una consulta a la base de datos
     *
     * @param $consulta Contiene la consulta que se enviará a la base de datos
     * @return string[]|null retorna un array asociativo con los datos de la consulta
     */
    public function consultaOneRow($consulta){

        //echo $consulta;

        $this->resultado =   $this->conexion->query($consulta);
        $res = mysqli_fetch_assoc($this->resultado);

        return $res;

    }

    //---------LOGIN------------

    /**
     * Método que comprueba la existencia de datos exactos en la base de datos
     *
     * @param $campo Nombre de la columna de la base de datos donde se lleva a cabo la comprobación
     * @param $dato Contiene el nombre exacto que se comparará con el introducido en la base de datos
     * @return bool retorna una variable booleana que depende de si la consulta encuentra resultados o no
     */
    public function disponibilidad ($campo,$dato){
        $ok=false;

        $dato = "'".$dato."'";

        $sql = "SELECT id FROM usuarios where ".$campo." = ".$dato;
        $this->resultado = $this->conexion->query($sql);
        $res = $this->resultado;
        if($res != ""){
            if($res->num_rows == 0)
                $ok=true;
        }

        //echo $sql;

        return $ok;

    }

    /**
     * Método que comprueba el número de elementos determinados en la base de datos
     *
     * @return mixed retorna el número de elementos encontrados
     */
    public function numeroElementos(){

        $num = $this->resultado->num_rows;
        return $num;

    }

    /**
     * Método que comprueba que el mail y el nombre introducidos por el usuario al registrarse ya se encuentran en la base de datos
     *
     * @param $nombre Nombre introducido por el usuario
     * @param $email Mail introducido por el usuario
     * @return bool retorna una variable booleana dependiendo si el mail o el nombre ya se encuentran en la base de datos
     */
    public function todoOk ($nombre, $email){

        $ok = true;

        if(!$this->disponibilidad("nombre",$nombre)){
            $ok = false;
        }

        if(!$this->disponibilidad("email",$email)){
            $ok = false;
        }

        //echo $ok;

        return $ok;

    }

}