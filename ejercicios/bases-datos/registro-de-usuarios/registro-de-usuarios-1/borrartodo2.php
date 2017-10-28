<?php
/**
 * Registro de usuarios 1 - borrartodo2.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2013 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2013-03-10
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

require_once "biblioteca.php";

function borraTodoMySQL($db)
{
    global $dbDb, $dbUsuarios, $tamUsuario, $tamPassword;

    $consulta = "DROP DATABASE $dbDb";
    if ($db->query($consulta)) {
        print "<p>Base de datos borrada correctamente.</p>\n";
    } else {
        print "<p>Error al borrar la base de datos.</p>\n";
    }
    $consulta = "CREATE DATABASE $dbDb";
    if ($db->query($consulta)) {
        print "<p>Base de datos creada correctamente.</p>\n";
        $consultaCreaTablaUsuarios = "CREATE TABLE $dbUsuarios (
            id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
            usuario VARCHAR($tamUsuario),
            password VARCHAR($tamPassword),
            PRIMARY KEY(id) )";
        if ($db->query($consultaCreaTablaUsuarios)) {
            print "<p>Tabla de Usuarios creada correctamente.</p>\n";
        } else {
            print "<p>Error al crear la tabla de Usuarios.</p>\n";
        }
    } else {
        print "<p>Error al crear la base de datos.</p>\n";
    }
}

function borraTodoSqlite($db)
{
    global $dbUsuarios, $tamUsuario, $tamPassword;

    $consulta = "DROP TABLE $dbUsuarios";
    if ($db->query($consulta)) {
       print "<p>Tabla de Usuarios borrada correctamente.</p>\n";
    } else {
        print "<p>Error al borrar la tabla de Usuarios.</p>\n";
    }
    $consultaCreaTablaUsuarios = "CREATE TABLE $dbUsuarios (
        id INTEGER PRIMARY KEY,
        usuario VARCHAR($tamUsuario),
        password VARCHAR($tamPassword)
        )";
    if ($db->query($consultaCreaTablaUsuarios)) {
        print "<p>Tabla de Usuarios creada correctamente.</p>\n";
    } else {
        print "<p>Error al crear la tabla de Usuarios.</p>\n";
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
    $db = null;
    pie();
}
?>
