<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load("current", {packages:["calendar"]});
      google.charts.setOnLoadCallback(drawChart);

   function drawChart() {
       var dataTable = new google.visualization.DataTable();
       dataTable.addColumn({ type: 'date', id: 'Date' });
       dataTable.addColumn({ type: 'number', id: 'Won/Loss' });
       dataTable.addRows([
           <?php
                $ruta = 'db/base.sqlite3';
                $base = new SQLite3($ruta);
                $peticion = "SELECT * FROM vistagoogle1;";
                $resultado = $base->query($peticion);
                $coleccion = [];
                while ($fila = $resultado->fetchArray(SQLITE3_ASSOC)) {
                    echo '[ new Date('.$fila['Y'].', '.$fila['m'].', '.$fila['d'].'), '.$fila['hits'].' ],
                    ';
                }
           ?>
          [ new Date(2013, 9, 30), 10 ]
        ]);

       var chart = new google.visualization.Calendar(document.getElementById('calendar_basic'));

       var options = {
         title: "Red Sox Attendance",
         height: 2550,
       };

       chart.draw(dataTable, options);
   }
    </script>
  </head>
  <body>
    <div id="calendar_basic" style="width: 1000px; height: 350px;"></div>
  </body>
</html>