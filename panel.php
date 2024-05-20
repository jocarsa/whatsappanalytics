<?php

    include "funciongrafica.php";
    include "funcionllamadagrafica.php";
    
    llamadaGrafica("SELECT 
        H as hora,
        COUNT(H) as numero
        FROM mensajes
        GROUP BY H
        ORDER BY H ASC;"
        ,"Mensajes por cada hora del día")

?>