<?php

/**
 * Class Commune
 * Define los metodos para el modelo Comuna
 * 
 * @author dbravo
 */

require_once __DIR__ . "/../model/class.database.php";

class Commune
{

    //atributos
    private $id;
    private $name;
    private $region_id;

    public function __construct()
    {
        //
    }

    /**
     * Listado de comunas por id de región
     * 
     * @param int region_id
     * 
     * @return array communes
     */
    public function getCommunesByRegionId($region_id)
    {
        $this->region_id = $region_id;
        $result = [];
        $query = "SELECT id, name FROM communes where region_id = ?";

        try {
            $db = new Database();
            $stm = $db->abrirConexion()->prepare($query);
            $stm->bind_param("i", $this->region_id);
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