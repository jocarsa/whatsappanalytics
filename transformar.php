<?php


function procesaLinea($entrada){
    $patron = "/\[(\d{1,2}\/\d{1,2}\/\d{2}), (\d{1,2}:\d{2}:\d{2})\] (.+?): (.+)/";
    if (preg_match($patron, $entrada, $coincidencias)) {
        $fecha = $coincidencias[1];
        $hora = $coincidencias[2];
        $persona = $coincidencias[3];
        $mensaje = $coincidencias[4];
        list($d, $m, $y) = explode('/', $fecha);
        list($H, $i, $s) = explode(':', $hora);
        $result = [
            'Y' => $y,
            'm' => $m,
            'd' => $d,
            'H' => $H,
            'i' => $i,
            's' => $s,
            'persona' => $persona,
            'mensaje' => $mensaje,
        ];
        return $result;
    } else {
        return false;
    }
}    
?>