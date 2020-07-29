<?php

/**
 * Clase Usuario que contiene el constructor y los métodos de la misma
 *
 * Class Usuario
 */
class Usuario
{
    /**
     * @var string ID del usuario
     */
    private $id;
    /**
     * @var string Nombre del usuario
     */
    private $nombre;
    /**
     * @var string Contraseña del usuario
     */
    private $password;
    /**
     * @var string Email del usuario
     */
    private $email;
    /**
     * @var string Permisos del usuario
     */
    private $permiso;
    /**
     * @var string Tabla donde realizar la consulta en la BD
     */
    private $tabla;

    /**
     * Constructor de objetos Usuario
     *
     * Usuario constructor.
     * @param string $nombre Nombre del usuario
     * @param string $password Contraseña del usuario
     * @param string $email Email del usuario
     * @param string $permiso Permiso del usuario
     * @param string $id ID del Usuario en la Base de datos
     */
    public function __construct($nombre="", $password="",$email="",$permiso="", $id="")
    {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->password = $password;
        $this->email = $email;
        $this->permiso = $permiso;
        $this->tabla = "usuarios";

    }

    /**
     * Método get para el ID de Usuario
     *
     * @return string retorna el ID de la Usuario
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Método set para el ID de Usuario
     *
     * @param string $id ID para el objeto Usuario
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * Método get para el nombre del Usuario
     *
     * @return string retorna el nombre del Usuario
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Método set para el nombre del Usuario
     *
     * @param string $nombre Nombre para el objeto Usuario
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    /**
     * Método get para la contraseña del Usuario
     *
     * @return string retorna la contraseña del Usuario
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Método set para la contraseña del Usuario
     *
     * @param mixed $password Contraseña para el objeto Usuario
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * Método get para el email del Usuario
     *
     * @return string retorna el email del Usuario
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Método set para el email del Usuario
     *
     * @param mixed $email Email para el objeto Usuario
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * Método get para el permiso del Usuario
     *
     * @return string retorna el permiso del Usuario
     */
    public function getPermiso()
    {
        return $this->permiso;
    }

    /**
     * Método set para el permiso del Usuario
     *
     * @param mixed $permiso Permiso asociado al usuario
     */
    public function setPermiso($permiso)
    {
        $this->permiso = $permiso;
    }

    /**
     * Método para que un usuario pueda loguearse
     *
     * @param $nombre Nombre del usuario
     * @param $password Contraseña del usuario
     * @return bool retorna una variable booleana dependiendo si hay coincidencia nombre-mail en la base de datos
     */
    public function logearse($nombre, $password){

        $ok =false;

        $sql = "SELECT id, nombre, permiso FROM " . $this->tabla . " 
                WHERE nombre='" . $nombre . "' AND password='" . md5($password) . "'";

        $conexion = new Bd();
        $res = $conexion->consultaOneRow($sql);
        if($conexion->numeroElementos()>0){

            $ok = true;

            $this->id = $res['id'];
            $this->nombre = $res['nombre'];
            $this->permiso = $res['permiso'];

        }else{

            $ok = false;
        }

        return $ok;

    }

    /**
     * Método para registrar en la base de datos a un nuevo usuario
     *
     * @param $datos Datos del formulario de registro
     */
    public function registrarse($datos){


        $conexion = new Bd();

        $conexion->addUser("usuarios",$datos);

    }

}