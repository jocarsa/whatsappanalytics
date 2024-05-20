<?php
function fechaCompleta($dayOfYear, $year) {
    $date = new DateTime();
    $date->setDate($year, 1, 1);
    $date->modify('+' . ($dayOfYear - 1) . ' days');
    return $date->format('Y-m-d');
}
function getDateFromDayOfYear($dayOfYear, $year) {
    $date = new DateTime();
    $date->setDate($year, 1, 1);
    $date->modify('+' . ($dayOfYear - 1) . ' days');
    return $date->format('d');
}
function getMesFromDayOfYear($dayOfYear, $year) {
    $date = new DateTime();
    $date->setDate($year, 1, 1);
    $date->modify('+' . ($dayOfYear - 1) . ' days');
    return $date->format('m');
}
function getFirstDayOfWeek($year) {
    $date = new DateTime();
    $date->setDate($year, 1, 1);
    $dayOfWeek = $date->format('w');
    $dayName = $date->format('l');
    return ["dayNumber" => $dayOfWeek, "dayName" => $dayName];
}
function graficaAños($añoinicio,$añofinal,$datos,$maximo){
    $html = "<div>";
    for($año = $añoinicio;$año<=$añofinal;$año++){
        $html .= "<h1>".$año."</h1>";
        $html .= getFirstDayOfWeek($año)['dayNumber'];
        $html .= "
        <style>
            td{width:10px;height:10px;padding:5px;border-radius:30px;margin:2px;}
            table{font-family:sans-serif;font-size:9px;}
            .marcado{background:blue;color:white;}
        </style>
        <table cellpadding=0 cellspacing=2>";
        $dia = getFirstDayOfWeek($año)['dayNumber']-1;
        if(getFirstDayOfWeek($año)['dayNumber'] == 0){$dia = -6;}
        for($diadelasemana = 1;$diadelasemana <= 7;$diadelasemana++){
            $html .= "<tr>";
            for($semana = 1;$semana<51;$semana++){
                $html .= "<td anio=".$año." mes=".getMesFromDayOfYear(($semana+($diadelasemana-1)+(($semana-1)*6)+$dia),$año)." dia=".getDateFromDayOfYear(($semana+($diadelasemana-1)+(($semana-1)*6)+$dia),$año)."";
                for($i = 0;$i<count($datos);$i++){
                    if(
                        $datos[$i]['Y'] == $año &&
                        $datos[$i]['m'] == getMesFromDayOfYear(($semana+($diadelasemana-1)+(($semana-1)*6)+$dia),$año) &&
                        $datos[$i]['d'] == getDateFromDayOfYear(($semana+($diadelasemana-1)+(($semana-1)*6)+$dia),$año)
                    ){
                        $html .= " style='background:rgba(0,0,255,".($datos[$i]['numero']/$maximo).")' 
                         title='".fechaCompleta(($semana+($diadelasemana-1)+(($semana-1)*6)+$dia),$año)." - ".$datos[$i]['numero']."'
                        ";
                    }
                }
                $html .= ">".getDateFromDayOfYear(($semana+($diadelasemana-1)+(($semana-1)*6)+$dia),$año)."</td>";

            }
            $html .= "</tr>";
        }
        $html .= "</table></div>";
    }
    return $html;
}

?>
