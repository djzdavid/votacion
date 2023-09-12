<?php

/**
 * Class Candidate
 * Define los metodos para el modelo Candidato
 * 
 * @author dbravo
 */

require_once __DIR__ . "/../model/class.database.php";

class Candidate
{

    //atributos
    private $id;
    private $name;

    public function __construct()
    {
        //
    }

    /**
     * Listado de candidatos 
     * 
     * @return array candidates
     */
    public function getCandidates()
    {
        $result = [];
        $query = "SELECT id, name FROM candidates ORDER BY name ASC";

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