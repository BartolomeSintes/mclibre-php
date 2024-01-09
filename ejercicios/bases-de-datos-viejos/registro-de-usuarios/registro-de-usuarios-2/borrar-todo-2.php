<?php
/**
 * Registro de usuarios 2 - borrar-todo-2.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2013 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2013-03-10
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

require_once "biblioteca.php";

function borraTodoMySQL($db)
{
    global $dbDb, $dbUsuarios, $administradorNombre, $administradorPassword,
        $tamUsuario, $tamCifrado;

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
        $consultaCreaTablaUsuarios = "CREATE TABLE $dbUsuarios (
            id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
            usuario VARCHAR($tamUsuario),
            password VARCHAR($tamCifrado),
            PRIMARY KEY(id) )";
        if ($db->query($consultaCreaTablaUsuarios)) {
            print "    <p>Tabla de Usuarios creada correctamente.</p>\n";
            print "\n";
        } else {
            print "    <p>Error al crear la tabla de Usuarios.</p>\n";
            print "\n";
        }
        if ($administradorPassword != "") {
            $consulta = "INSERT INTO $dbUsuarios VALUES (NULL,
                '$administradorNombre', '" . md5($administradorPassword) . "')";
            if ($db->query($consulta)) {
                print "    <p>Registro de Usuario Administrador creado correctamente.</p>\n";
                print "\n";
            } else {
                print "    <p>Error al crear el registro de Usuario Administrador.</p>\n";
                print "\n";
            }
        }
    } else {
        print "    <p>Error al crear la base de datos.</p>\n";
        print "\n";
    }
}

function borraTodoSqlite($db)
{
    global $dbUsuarios, $administradorNombre, $administradorPassword,
        $tamUsuario, $tamCifrado;

    $consulta = "DROP TABLE IF EXISTS $dbUsuarios";
    if ($db->query($consulta)) {
        print "    <p>Tabla de Usuarios borrada correctamente.</p>\n";
        print "\n";
    } else {
        print "    <p>Error al borrar la tabla de Usuarios.</p>\n";
        print "\n";
    }
    $consultaCreaTablaUsuarios = "CREATE TABLE $dbUsuarios (
        id INTEGER PRIMARY KEY,
        usuario VARCHAR($tamUsuario),
        password VARCHAR($tamCifrado)
        )";
    if ($db->query($consultaCreaTablaUsuarios)) {
        print "    <p>Tabla de Usuarios creada correctamente.</p>\n";
        print "\n";
    } else {
        print "    <p>Error al crear la tabla de Usuarios.</p>\n";
        print "\n";
    }
    if ($administradorPassword != "") {
        $consulta = "INSERT INTO $dbUsuarios VALUES (NULL,
            '$administradorNombre', '" . md5($administradorPassword) . "')";
        if ($db->query($consulta)) {
            print "    <p>Registro de Usuario Administrador creado correctamente.</p>\n";
            print "\n";
        } else {
            print "    <p>Error al crear el registro de Usuario Administrador.</p>\n";
            print "\n";
        }
    }
}

session_start();
if (isset($_SESSION["id"])) {
    header("Location:index.php");
    exit;
} else {
    if (!isset($_REQUEST["si"])) {
        header("Location:index.php");
        exit;
    } else {
        $db = conectaDb();
        cabecera("Borrar todo 2", MENU_VOLVER);
        if ($dbMotor == MYSQL) {
            borraTodoMySQL($db);
        } elseif ($dbMotor == SQLITE) {
            borraTodoSqlite($db);
        }
                pie();
    }
}
?>
