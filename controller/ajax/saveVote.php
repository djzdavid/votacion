<?php

/**
 * Controlador que da servicios a la/las vistas
 * 
 * @author dbravo
 */

require_once __DIR__ . "/../ctrl.votaciones.php";

$objCtrVotaciones = new CtrlVotaciones();

$errors = [];
$data = [];

/**
 * Validaciones
 */

if (empty($_POST['ipt_nombre'])) {
    $errors['nombre'] = 'Nombre y Apellido es requerido.';
}

if (empty($_POST['ipt_alias'])) {
    $errors['alias'] = 'Alias es requerido.';
} else {
    if (strlen($_POST['ipt_alias']) <= 5) {
        $errors['alias'] = 'La cantidad de caracteres debe ser mayor a 5.';
    }
    if (!preg_match("/^[a-zA-Z0-9]+$/", $_POST['ipt_alias'])) {
        $errors['alias'] = 'Debe contener letras y números.';
    }
}

if (empty($_POST['ipt_rut'])) {
    $errors['rut'] = 'Rut es requerido.';
} else {
    if (!$objCtrVotaciones->validaRut($_POST['ipt_rut'])) {
        $errors['rut'] = 'Formato de rut incorrecto.';
    }
    if($objCtrVotaciones->validaVotosByRut($_POST['ipt_rut'])){
        $errors['rut'] = 'Rut ya cuenta con una votación registrada.';
    }

    $chars = array(".", ",", "_", "-");
    $_POST['ipt_rut'] = str_replace($chars, "", $_POST['ipt_rut']);
    $_POST['ipt_rut'] = substr($_POST['ipt_rut'], 0, -1) . '-'. substr($_POST['ipt_rut'], -1);
}

if (empty($_POST['ipt_correo'])) {
    $errors['correo'] = 'Correo es requerido.';
} else {
    if (!filter_var($_POST['ipt_correo'], FILTER_VALIDATE_EMAIL)) {
        $errors['correo'] = 'Formato de correo incorrecto.';
    }
}

if (empty($_POST['ipt_region'])) {
    $errors['region'] = 'Región es requerida.';
}

if (empty($_POST['ipt_comuna'])) {
    $errors['comuna'] = 'Comuna es requerida.';
}

if (empty($_POST['ipt_conocer']) or count($_POST['ipt_conocer']) < 2) {
    $errors['conocer'] = 'Debe seleccionar al menos 2 opciones.';
}

if (!empty($errors)) {
    $data['success'] = false;
    $data['errors'] = $errors;
} else {
    /**
     * Inserta registro en la base de datos
     */
    if ($objCtrVotaciones->saveVote(
        $_POST['ipt_rut'],
        $_POST['ipt_nombre'],
        $_POST['ipt_alias'],
        $_POST['ipt_correo'],
        $_POST['ipt_region'],
        $_POST['ipt_comuna'],
        $_POST['ipt_candidato'],
        json_encode($_POST['ipt_conocer'])
    )) {
        $data['success'] = true;
        $data['message'] = '¡Voto guardado correctamente!';
    } else {
        $data['success'] = false;
        $data['message'] = '¡Error al momento de guardar la votación!';
    }
}

echo json_encode($data);
