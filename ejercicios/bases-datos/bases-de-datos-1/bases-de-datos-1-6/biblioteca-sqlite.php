<?php
/**
 * @author    Bartolomé Sintes Marco - bartolome.sintes+mclibre@gmail.com
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @link      https://www.mclibre.org
 */

// Configuración específica para SQLite

// Configuración general

define("SQLITE_DATABASE", "/home/barto/mclibre/tmp/mclibre/mclibre-base-datos-1-6.sqlite");  // Ubicación de la base de datos
define("SQLITE_TABLE_AGENDA", "agenda");                                                     // Nombre de la tabla Agenda

// Nombres de las tablas

$tablaAgenda = SQLITE_TABLE_AGENDA;      // Nombre de la tabla Agenda

// Consultas de borrado y creación de base de datos y tablas, etc.

$consultaCreaTabla = "CREATE TABLE $tablaAgenda (
    id INTEGER PRIMARY KEY,
    nombre VARCHAR($tamAgendaNombre),
    apellidos VARCHAR($tamAgendaApellidos)
    )";

// Funciones específicas de bases de datos (SQLITE)

function conectaDb()
{
    try {
        $tmp = new PDO("sqlite:" . SQLITE_DATABASE);
        return $tmp;
    } catch (PDOException $e) {
        cabecera("Error grave", MENU_PRINCIPAL);
        print "    <p class=\"aviso\">Error: No puede conectarse con la base de datos.</p>\n";
        print "\n";
        print "    <p class=\"aviso\">Error: " . $e->getMessage() . "</p>\n";
        pie();
        exit();
    }
}

function borraTodo($db, $nombreTabla, $consultaCreacionTabla)
{
    $consulta = "DROP TABLE $nombreTabla";
    if ($db->query($consulta)) {
        print "    <p>Tabla borrada correctamente.</p>\n";
        print "\n";
    } else {
        print "    <p class=\"aviso\">Error al borrar la tabla.</p>\n";
        print "\n";
    }

    $consulta = $consultaCreacionTabla;
    if ($db->query($consulta)) {
        print "    <p>Tabla creada correctamente.</p>\n";
        print "\n";
    } else {
        print "    <p class=\"aviso\">Error al crear la tabla.</p>\n";
        print "\n";
    }
}
