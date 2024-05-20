<?php
function creaBaseDatos(){
    $ruta = 'db/base.sqlite3';
    $base = new SQLite3($ruta);
    if ($base) {
        $peticion = 'DROP TABLE mensajes';
        $base->exec($peticion);
        $peticion = '
                CREATE TABLE  
                "mensajes" (
                "id"	INTEGER,
                "Y"	INTEGER,
                "m"	INTEGER,
                "d"	INTEGER,
                "H"	INTEGER,
                "i"	INTEGER,
                "s"	INTEGER,
                "persona"	TEXT,
                "mensaje"	TEXT,
                PRIMARY KEY("id" AUTOINCREMENT)
            );
        ';
        $resultado = $base->exec($peticion);
        if ($resultado) {
            return true;
        } else {
            return false;
        }

        $base->close();
    } else {
        return false;
    }
}
?>