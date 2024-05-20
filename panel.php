<?php

error_reporting(E_ERROR | E_PARSE);

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if file was uploaded without errors
    if (isset($_FILES['archivo']) && $_FILES['archivo']['error'] == 0) {
        $filename = $_FILES['archivo']['name'];
        $fileTmpPath = $_FILES['archivo']['tmp_name'];
        $fileSize = $_FILES['archivo']['size'];
        $fileType = $_FILES['archivo']['type'];
        $fileNameCmps = explode(".", $filename);
        $fileExtension = strtolower(end($fileNameCmps));
        
        // Sanitize file name
        $newFileName = md5(time() . $filename) . '.' . $fileExtension;
        
        // Check if the entradas directory exists, if not create it
        $uploadFileDir = './entradas/';
        if (!is_dir($uploadFileDir)) {
            mkdir($uploadFileDir, 0777, true);
        }
        $dest_path = $uploadFileDir . $newFileName;
        
        // Move the file from the temporary directory to the destination directory
        if(move_uploaded_file($fileTmpPath, $dest_path)) {
            $message = 'File is successfully uploaded.';
        } else {
            $message = 'There was an error moving the uploaded file.';
        }
    } else {
        $message = 'There was an error uploading the file.';
    }
    echo $message;
}
?>

<?php

    include "crearbasedatos.php";
    include "procesar.php";
        
    creaBaseDatos();
    leeArchivo($newFileName);
    sleep(5);
?>

<?php

    include "funciongrafica.php";
    include "funcionllamadagrafica.php";
    include "graficaaño.php";
    include "tarta.php";
    
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
    $datos = [];
    $ruta = 'db/base.sqlite3';
        $base = new SQLite3($ruta);
        $peticion = "SELECT * FROM mensajesporpersona";
        $resultado = $base->query($peticion);
        $coleccion = [];
        while ($fila = $resultado->fetchArray(SQLITE3_ASSOC)) {
            //echo $fila['persona']." - ".$fila['numero'];
            $clave = $fila['persona'];
            $valor = $fila['numero'];
            $datos[$clave] = $valor;
        }
    //var_dump($datos);
    graficaTarta(
        "Mensajes por cada persona",
        $datos
    );

$datos = [];
    $ruta = 'db/base.sqlite3';
        $base = new SQLite3($ruta);
        $peticion = "SELECT * FROM mensajesporaño";
        $resultado = $base->query($peticion);
        $coleccion = [];
        while ($fila = $resultado->fetchArray(SQLITE3_ASSOC)) {
            //echo $fila['persona']." - ".$fila['numero'];
            $clave = $fila['año'];
            $valor = $fila['numero'];
            $datos[$clave] = $valor;
        }
    //var_dump($datos);
    graficaTarta(
        "Años y mensajes",
        $datos
    );

echo '<div style="clear:both;"></div>';
    $datos = [];
        $ruta = 'db/base.sqlite3';
        $base = new SQLite3($ruta);
        $peticion = "SELECT * FROM vistagoogle1";
        $resultado = $base->query($peticion);
        $coleccion = [];
        while ($fila = $resultado->fetchArray(SQLITE3_ASSOC)) {
            array_push($datos,["Y"=>$fila['Y'],"m"=>$fila['m'],"d"=>$fila['d'],"numero"=>$fila['hits']]);
        }
    echo graficaAños(2017,2024,$datos,32);

?>