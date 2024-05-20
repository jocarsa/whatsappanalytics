<?php
    include "transformar.php";
    function leeArchivo($nombre){
        $ruta = 'db/base.sqlite3';
        $base = new SQLite3($ruta);
        $archivo = "entradas/$nombre";
        $manejador = fopen($archivo, "r");
        $contador = 0;
        while (($linea = fgets($manejador)) !== false) {
            //if($contador > 5){break;}
            $datos = procesaLinea($linea);
            $peticion = '
                INSERT INTO mensajes
                VALUES (
                    NULL,
                    '.$datos["Y"].',
                    '.$datos["m"].',
                    '.$datos["d"].',
                    '.$datos["H"].',
                    '.$datos["i"].',
                    '.$datos["s"].',
                    "'.$datos["persona"].'",
                    "'.$datos["mensaje"].'"
                );
        ';
            //echo $peticion."<br>";
            $base->exec($peticion);
            $contador++;
        }
        fclose($manejador);
    }
    
    leeArchivo("_chat.txt");
?>
