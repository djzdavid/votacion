<?php

/**
 * Controlador de votaciones
 * 
 * @author dbravo
 */

require_once __DIR__ . "/../model/class.region.php";
require_once __DIR__ . "/../model/class.commune.php";
require_once __DIR__ . "/../model/class.candidate.php";
require_once __DIR__ . "/../model/class.vote.php";

class CtrlVotaciones
{

    private $results;

    public function __construct()
    {
        //
    }

    /**
     * Listado de candidatos
     * 
     * @return json candidatos 
     */
    public function getListaCandidatos()
    {
        try {
            $objCandidate = new Candidate();
            $this->results = $objCandidate->getCandidates();
        } catch (\Exception $e) {
            echo $e;
        }

        return json_encode($this->results);
    }

    /**
     * Listado de regiones
     * 
     * @return json regiones 
     */
    public function getListaRegiones()
    {
        try {
            $objRegion = new Region();
            $this->results = $objRegion->getRegions();
        } catch (\Exception $e) {
            echo $e;
        }

        return json_encode($this->results);
    }

    /**
     * Listado de comunas por id de region
     * 
     * @param int region_id
     * 
     * @return json comunas 
     */
    public function getListaComunas($region_id)
    {
        try {
            $objComuna = new Commune();
            $this->results = $objComuna->getCommunesByRegionId($region_id);
        } catch (\Exception $e) {
            echo $e;
        }

        return json_encode($this->results);
    }

    /**
     * Validación de formato de Rut Chile
     * 
     * @param string rut
     * 
     * @return boolen 
     */
    public function validaRut($rut)
    {
        $rut = preg_replace('/[^k0-9]/i', '', $rut);
        $dv  = substr($rut, -1);
        $numero = substr($rut, 0, strlen($rut) - 1);
        $i = 2;
        $suma = 0;
        foreach (array_reverse(str_split($numero)) as $v) {
            if ($i == 8)
                $i = 2;

            $suma += $v * $i;
            ++$i;
        }

        $dvr = 11 - ($suma % 11);

        if ($dvr == 11)
            $dvr = 0;
        if ($dvr == 10)
            $dvr = 'K';

        if ($dvr == strtoupper($dv))
            return true;
        else
            return false;
    }

    /**
     * Inserta un registro (voto), en la base de datos
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
     * @return boolean 
     */
    public function saveVote($rut, $name, $alias, $email, $region_id, $commune_id, $candidate_id, $conocer){
        $objVote = new Vote();
        if(! $objVote->insertVote($rut, $name, $alias, $email, $region_id, $commune_id, $candidate_id, $conocer)){
            return false;
        }

        return true;
    }

    /**
     * Valida los votos registrados por un rut
     * 
     * @param string rut
     * 
     * @return boolean
     */
    public function validaVotosByRut($rut){
        $objVote = new Vote();
        if(!empty($objVote->getVotesByRut($rut))){
            return true;
        }else{
            return false;
        }
    }
}
