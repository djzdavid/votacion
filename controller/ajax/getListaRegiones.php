<?php

/**
 * Responde a las llamadas ajax desde la vista
 * 
 * @author dbravo
 */

require_once __DIR__ . "/../ctrl.votaciones.php";

$objCtrVotaciones = new CtrlVotaciones();
echo $objCtrVotaciones->getListaRegiones();