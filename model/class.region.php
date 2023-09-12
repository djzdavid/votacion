<?php

/**
 * Class Region
 * Define los metodos para el modelo Región
 * 
 * @author dbravo
 */

require_once __DIR__ . "/../model/class.database.php";

class Region
{

    //atributos
    private $id;
    private $name;

    public function __construct()
    {
        //
    }

    /**
     * Listado de regiones 
     * 
     * @return array regions
     */
    public function getRegions()
    {
        $result = [];
        $query = "SELECT id, name FROM regions";

        try {
            $db = new Database();
            $stm = $db->abrirConexion()->prepare($query);
            $stm->execute();
            $stm->bind_result($this->id, $this->name);
            while ($stm->fetch()) {
                $result[] = [
                    "id" => $this->id,
                    "name" => $this->name,
                ];
            }
            $stm->close();
            $db->cerrarConexion();
        } catch (Exception $e) {
            echo $e;
        }

        return $result;
    }
}