<?php
    include "transformar.php";
    function leeArchivo($nombre){
        $archivo = "entradas/$nombre";
        $manejador = fopen($archivo, "r");
        $contador = 0;
        while (($linea = fgets($manejador)) !== false) {
            if($contador > 5){break;}
            $datos = procesaLinea($linea);
            var_dump($datos);
            $contador++;
        }
        fclose($manejador);
    }
    
    leeArchivo("_chat.txt");
?>
