<?php

/**
 * Class Vote
 * Define los metodos para el modelo Voto
 * 
 * @author dbravo
 */

require_once __DIR__ . "/../model/class.database.php";

class Vote
{

    //atributos
    private $rut;
    private $name;
    private $alias;
    private $email;
    private $region_id;
    private $commune_id;
    private $candidate_id;
    private $conocer;

    public function __construct()
    {
        //
    }

    /**
     * Insertar registro de votación
     * 
     * @param string rut
     * @param string name
     * @param string alias
     * @param string email
     * @param int region_id
     * @param int commune_id
     * @param int candidate_id
     * @param json conocer
     * 
     * @return bool error or success
     */
    public function insertVote($rut, $name, $alias, $email, $region_id, $commune_id, $candidate_id, $conocer)
    {
        $this->rut = $rut;
        $this->name = $name;
        $this->alias = $alias;
        $this->email = $email;
        $this->region_id = $region_id;
        $this->commune_id = $commune_id;
        $this->candidate_id = $candidate_id;
        $this->conocer = $conocer;

        $query = "INSERT INTO votes 
            (rut, name, alias, email, region_id, commune_id, candidate_id, conocer) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

        try {
            $db = new Database();
            $stm = $db->abrirConexion()->prepare($query);
            $stm->bind_param(
                'ssssiiis',
                $this->rut,
                $this->name,
                $this->alias,
                $this->email,
                $this->region_id,
                $this->commune_id,
                $this->candidate_id,
                $this->conocer
            );
            $stm->execute();
            $stm->close();
            $db->cerrarConexion();
        } catch (Exception $e) {
            echo $e;
            return false;
        }

        return true;
    }

    /**
     * Listado de votos por rut
     * 
     * @param string rut
     * 
     * @return array votos
     */
    public function getVotesByRut($rut)
    {
        $this->rut = $rut;
        $result = [];
        $query = "SELECT rut, name, alias, email, region_id, commune_id, candidate_id, conocer FROM votes where rut = ?";

        try {
            $db = new Database();
            $stm = $db->abrirConexion()->prepare($query);
            $stm->bind_param("s", $this->rut);
            $stm->execute();
            $stm->bind_result($this->rut,
            $this->name,
            $this->alias,
            $this->email,
            $this->region_id,
            $this->commune_id,
            $this->candidate_id,
            $this->conocer);
            while ($stm->fetch()) {
                $result[] = [
                    'rut' => $this->rut,
                    'name' => $this->name,
                    'alias' => $this->alias,
                    'email' => $this->email,
                    'region_id' => $this->region_id,
                    'commune_id' => $this->commune_id,
                    'candidate_id' => $this->candidate_id,
                    'conocer' => $this->conocer
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