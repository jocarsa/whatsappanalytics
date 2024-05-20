<?php
    function llamadaGrafica($miquery,$titulo){
        $ruta = 'db/base.sqlite3';
        $base = new SQLite3($ruta);
        $peticion = $miquery;
        $resultado = $base->query($peticion);
        $coleccion = [];
        while ($fila = $resultado->fetchArray(SQLITE3_ASSOC)) {
            $coleccion[] = $fila;
        }
        echo barras($coleccion,$titulo);
    }
?>