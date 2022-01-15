<?php
/**
 * @author    Bartolomé Sintes Marco - bartolome.sintes+mclibre@gmail.com
 * @license   https://www.gnu.org/licenses/agpl-3.0.txt AGPL 3 or later
 * @link      https://www.mclibre.org
 */

// FUNCIONES ESPECÍFICAS DE LA BASE DE DATOS SQLITE

// SQLITE: Nombres de las tablas

$cfg["dbPersonasTabla"] = "personas";                       // Nombre de la tabla Personas

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

// SQLITE: Consultas de borrado y creación de tablas

function borraTodo()
{
    global $pdo, $cfg;

    $consulta = "DROP TABLE IF EXISTS $cfg[dbPersonasTabla]";

    if (!$pdo->query($consulta)) {
        print "    <p class=\"aviso\">Error al borrar la tabla. SQLSTATE[{$pdo->errorCode()}]: {$pdo->errorInfo()[2]}</p>\n";
    } else {
        print "    <p>Tabla borrada correctamente (si existía).</p>\n";
    }
    print "\n";

    $consulta = "CREATE TABLE $cfg[dbPersonasTabla]  (
                 id INTEGER PRIMARY KEY,
                 nombre VARCHAR($cfg[dbPersonasTamNombre]),
                 apellidos VARCHAR($cfg[dbPersonasTamApellidos]),
                 telefono VARCHAR($cfg[dbPersonasTamTelefono]),
                 correo VARCHAR($cfg[dbPersonasTamCorreo])
                 )";

    if (!$pdo->query($consulta)) {
        print "    <p class=\"aviso\">Error al crear la tabla. SQLSTATE[{$pdo->errorCode()}]: {$pdo->errorInfo()[2]}</p>\n";
    } else {
        print "    <p>Tabla creada correctamente.</p>\n";
    }
}
