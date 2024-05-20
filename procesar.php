<?php
    include "transformar.php";
    function leeArchivo($nombre){
        $ruta = 'db/base.sqlite3';
        $base = new SQLite3($ruta);
        $archivo = "entradas/$nombre";
        $manejador = fopen($archivo, "r");
        $contador = 0;
        $numero = 0;
        $peticion = "SELECT COUNT(id) as numero FROM mensajes";
        $resultado = $base->query($peticion);
        while ($fila = $resultado->fetchArray(SQLITE3_ASSOC)) {
            $numero = $fila['numero'];
        }
        while (($linea = fgets($manejador)) !== false) {
            //if($contador > 5){break;}
            try{
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
                echo (($contador/$numero)*100)."%<br>";
            } catch (Exception $e) {
    

            }
        }
        fclose($manejador);
    }
    
    leeArchivo("_chat.txt");
?>
