<?php

    include "funciongrafica.php";
    include "funcionllamadagrafica.php";
    
    llamadaGrafica(
        "SELECT * FROM mensajesporhoras"
        ,"Mensajes por cada hora del día"
    );
    llamadaGrafica(
        "SELECT * FROM mensajesporaño"
        ,"Mensajes por cada año"
    );
    llamadaGrafica(
        "SELECT * FROM mensajespormes"
        ,"Mensajes por cada mes"
    );
    llamadaGrafica(
        "SELECT * FROM mensajesporpersona"
        ,"Mensajes por cada persona"
    );
    llamadaGrafica(
        "SELECT * FROM mensajespordia"
        ,"Mensajes por cada dia"
    );

?>