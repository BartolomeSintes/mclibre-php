<?php
/**
 * Inyección SQL 1 - borrar-todo-2.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2011 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2011-05-18
 * @link      http://www.mclibre.org
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

include "biblioteca.php";

function borraTodoMySQL($db)
{
    global $dbDb, $dbTabla, $tamUsuario, $tamContraseña;

    $consulta = "DROP DATABASE $dbDb";
    if ($db->query($consulta)) {
        print "    <p>Base de datos borrada correctamente.</p>\n";
        print "\n";
    } else {
        print "    <p>Error al borrar la base de datos.</p>\n";
        print "\n";
    }
    $consulta = "CREATE DATABASE $dbDb";
    if ($db->query($consulta)) {
        print "    <p>Base de datos creada correctamente.</p>\n";
        print "\n";
        $consulta = "CREATE TABLE $dbTabla (
            id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
            user VARCHAR($tamUsuario),
            password VARCHAR($tamContraseña),
            PRIMARY KEY(id)
            )";
        if ($db->query($consulta)) {
            print "    <p>Tabla creada correctamente.</p>\n";
            print "\n";
        } else {
            print "    <p>Error al crear la tabla.</p>\n";
            print "\n";
        }
    } else {
        print "    <p>Error al crear la base de datos.</p>\n";
        print "\n";
    }
}

function borraTodoSqlite($db)
{
    global $dbTabla, $tamUsuario, $tamContraseña;

    $consulta = "DROP TABLE $dbTabla";
    if (sqlite_query($db, $consulta)) {
        print "    <p>Tabla borrada correctamente.</p>\n";
        print "\n";
    } else {
        print "    <p>Error al borrar la tabla.</p>\n";
        print "\n";
    }
    $consulta = "CREATE TABLE $dbTabla (
        id INTEGER PRIMARY KEY,
        user VARCHAR($tamUsuario),
        password VARCHAR($tamContraseña)
        )";
    if (sqlite_query($db, $consulta)) {
        print "    <p>Tabla creada correctamente.</p>\n";
        print "\n";
    } else {
        print "    <p>Error al crear la tabla.</p>\n";
        print "\n";
    }
}

if (!isset($_REQUEST["si"])) {
    header("Location:index.php");
    exit();
} else {
    $db = conectaDb();
    cabecera("Borrar todo 2", MENU_VOLVER, CABECERA_SIN_CURSOR);
    if ($dbMotor == MYSQL) {
        borraTodoMySQL($db);
    } elseif ($dbMotor == SQLITE) {
        borraTodoSqlite($db);
    }
    sqlite_close($db);
    pie();
}
?>
