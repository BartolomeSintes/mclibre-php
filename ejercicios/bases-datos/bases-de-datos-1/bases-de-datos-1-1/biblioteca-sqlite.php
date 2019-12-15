<?php
/**
 * Bases de datos 1-1 - biblioteca-sqlite.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2019 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2019-12-11
 * @link      https://www.mclibre.org
 *
 *  This program is free software: you can redistribute it and/or modify
 *  it under the terms of the GNU Affero General Public License as published by
 *  the Free Software Foundation, either version 3 of the License, or
 *  any later version.
 *
 *  This program is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU Affero General Public License for more details.
 *
 *  You should have received a copy of the GNU Affero General Public License
 *  along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

// Configuración específica para SQLite

// Configuración general

define("SQLITE_DATABASE", "/home/barto/mclibre/tmp/mclibre/mclibre-base-datos-1-1.sqlite");  // Ubicación de la base de datos
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
        print "    <p>Error: No puede conectarse con la base de datos.</p>\n";
        print "\n";
        print "    <p>Error: " . $e->getMessage() . "</p>\n";
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
        print "    <p>Error al borrar la tabla.</p>\n";
        print "\n";
    }

    $consulta = $consultaCreacionTabla;
    if ($db->query($consulta)) {
        print "    <p>Tabla creada correctamente.</p>\n";
        print "\n";
    } else {
        print "    <p>Error al crear la tabla.</p>\n";
        print "\n";
    }
}
