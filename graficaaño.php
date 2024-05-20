<?php
    $cadena = "
    <style>td{border:1px solid grey;padding:5px;}</style>
    <table cellpadding=0 cellspacing=0>";
    for($diadelasemana = 1;$diadelasemana <= 7;$diadelasemana++){
        $cadena .= "<tr>";
        for($semana = 1;$semana<=51;$semana++){
           $cadena .= "<td>1</td>"; 
        }
        $cadena .= "</tr>";
    }
    $cadena .= "</table>";
    echo $cadena;
?>