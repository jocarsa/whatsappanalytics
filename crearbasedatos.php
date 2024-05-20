<?php
function creaBaseDatos(){
    $db_path = 'db/base.sqlite3';
    $db = new SQLite3($db_path);
    if ($db) {
        $create_table_query = '
                CREATE TABLE "mensajes" (
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
        $result = $db->exec($create_table_query);
        if ($result) {
            return true;
        } else {
            return false;
        }

        $db->close();
    } else {
        return false;
    }
}
?>