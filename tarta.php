<?php
function graficaTarta($nombre,$data){
        /*
    $data = [
        'Category 1' => 25,
        'Category 2' => 35,
        'Category 3' => 15,
        'Category 4' => 25,
    ];
    */

    $total = array_sum($data);
    $percentages = array_map(function($value) use ($total) {
        return ($value / $total) * 100;
    }, $data);

    $colors = [
        '#9A8FEE',
        '#9185EC',
        '#887BEA',
        '#7F71E8',
        '#7667E6',
        '#6D5DE4',
        '#6453E2',
        '#5B49E0',
        '#5240DE',
        '#4936DC',
        '#402CDA',
        '#3722D8',
        '#2E18D6',
        '#251ED4',
        '#1C14D2',
        '#130AD0',
        '#0A00CE',
        '#0A00C1',
        '#0900B4',
        '#0800A7',
    ]; // Define colors
        shuffle($colors);

    $currentPercentage = 0;
    $gradientParts = [];
    $legendItems = []; // For legend
    $contador = 0;

    foreach ($percentages as $index => $percentage) {
        $color = $colors[$contador % count($colors)];
        $start = $currentPercentage;
        $end = $currentPercentage + $percentage;
        $gradientParts[] = "$color $start% $end%";
        // Prepare legend item
        $legendItems[] = "<tr style='color: ".$color.";'>
                            
                            <td style='padding:0;'>".$index."</td>
                            <td style='padding:0;text-align:right;'>".round($percentage,2)."%</td>
                            <td style='padding:0;'><div style='height:20px;width:".round($percentage*4,2)."px;background:".$color.";'></div></td>
                            </tr>";
        $currentPercentage = $end;
        $contador++;
    }

    $gradient = implode(', ', $gradientParts);
    $legendHtml = implode('', $legendItems); // Convert legend items to HTML

    // Output the pie chart and the legend
    echo '<div style="display: flex;align-items: center;justify-content: center;flex-wrap: wrap;flex-direction: column;align-content: flex-start;float:left;margin:20px;width:300px;">';
    echo '<h3>'.$nombre.'</h3>';
    echo '<div style="width: 200px; height: 200px; border-radius: 50%; background-image: conic-gradient(' . $gradient . ');box-shadow:0px 0px 20px black inset;position:relative;"><div class="circuloblanco" style="width:50%;height:50%;background:white;left:50%;top:50%;position:absolute;margin-left:-25%;margin-top:-25%;border-radius:100%;box-shadow:0px 0px 10px black;"></div></div>';
    echo '<div style="margin-left: 20px;"><table>' . $legendHtml . '</table></div>';
    echo '</div>';
}
/*$data = [
        'Category 1' => 10,
        'Category 2' => 20,
        'Category 3' => 30
    ]*/;
//graficaTarta("Hola",$data);