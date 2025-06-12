<?php
function validarCadena($campo){
    $campo = trim($campo ?? '');
    $campo = strip_tags($campo);
    return htmlspecialchars($campo, ENT_QUOTES, 'UTF-8');
}
function validarContraseña($contrasena){
    $contrasena = validarCadena($contrasena);
    $patron = "/^[A-Z][a-z0-9.]{7,99}$/";
    return preg_match($patron,$contrasena) ? $contrasena:false;
}

?>