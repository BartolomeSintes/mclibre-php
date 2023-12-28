<?php
/**
 * @author    Bartolomé Sintes Marco - bartolome.sintes+mclibre@gmail.com
 * @license   https://www.gnu.org/licenses/agpl-3.0.txt AGPL 3 or later
 * @link      https://www.mclibre.org
 */

// SQLITE: FUNCIONES ESPECÍFICAS

// SQLITE: Conexión con la base de datos

function conectaDb()
{
    global $cfg;

    try {
        $tmp = new PDO("sqlite:$cfg[sqliteDatabase]");
        $tmp->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT);
        $tmp->query("PRAGMA foreign_keys = ON");
        $tmp->query("PRAGMA encoding = 'UTF-8'");
        return $tmp;
    } catch (PDOException $e) {
        print "    <p class=\"aviso\">Error: No puede conectarse con la base de datos. {$e->getMessage()}</p>\n";
        exit;
    }
}

// SQLITE: Borrado y creación de tabla

function borraTodo()
{
    global $pdo, $cfg;

    print "    <p class=\"aviso\">Está utilizando SQLite</p>\n";
    print "\n";

    $consulta = "DROP TABLE IF EXISTS $cfg[tablaPersonas]";

    if (!$pdo->query($consulta)) {
        print "    <p class=\"aviso\">Error al borrar la tabla. SQLSTATE[{$pdo->errorCode()}]: {$pdo->errorInfo()[2]}</p>\n";
    } else {
        print "    <p>Tabla borrada correctamente (si existía).</p>\n";
    }
    print "\n";

    $consulta = "CREATE TABLE $cfg[tablaPersonas] (
                 id INTEGER PRIMARY KEY,
                 nombre VARCHAR($cfg[tablaPersonasTamNombre]) COLLATE NOCASE,
                 apellidos VARCHAR($cfg[tablaPersonasTamApellidos]) COLLATE NOCASE
                 )";

    if (!$pdo->query($consulta)) {
        print "    <p class=\"aviso\">Error al crear la tabla. SQLSTATE[{$pdo->errorCode()}]: {$pdo->errorInfo()[2]}</p>\n";
    } else {
        print "    <p>Tabla creada correctamente.</p>\n";
    }
    print "\n";
}

