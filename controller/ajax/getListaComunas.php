<?php

/**
 * Responde a las llamadas ajax desde la vista
 * 
 * @author dbravo
 */

require_once __DIR__ . "/../ctrl.votaciones.php";

if (isset($_GET['region_id'])) {
    if (!empty($_GET['region_id'])) {
        $objCtrVotaciones = new CtrlVotaciones();
        echo $objCtrVotaciones->getListaComunas($_GET['region_id']);
    }
}
