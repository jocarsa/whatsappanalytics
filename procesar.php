<?php

    $archivo = "entradas/_chat.txt";
    $manejador = fopen($archivo, "r");
    $contador = 0;
    while (($line = fgets($manejador)) !== false) {
        if($contador > 5){break;}
        echo $line . "<br>"; 
        $contador++;
    }
    fclose($manejador);


?>
