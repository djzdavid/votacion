<?php

/**
 * Class Database
 * Define la conexion a base de datos Mysql
 * 
 * @author dbravo
 */

class Database
{
    // atributos
    protected $conn;
    private $host = "localhost";
    private $user = "root";
    private $pass = "";
    private $name = "votaciones";

    function __construct()
    {
        //
    }

    /**
     * Abrir conexion a base de datos
     *
     * @return $conn
     */
    public function abrirConexion()
    {
        try {
            $this->conn = new mysqli($this->host, $this->user, $this->pass, $this->name);

            // set charset
            $this->conn->query("SET CHARACTER SET utf8");
            $this->conn->set_charset("utf8");
        } catch (\Exception $e) {
            echo $e;
        }

        return $this->conn;
    }

    /**
     * Cerrar conexion a base de datos
     * 
     * @return boolean
     */
    public function cerrarConexion()
    {
        try {
            $this->conn->close();
        } catch (\Exception $e) {
            echo $e;
        }

        return true;
    }
}