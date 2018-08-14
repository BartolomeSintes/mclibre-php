<?php
/**
 * Blog - borrar-todo-2.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2009 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2009-05-21
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

function borraTodoMySQL($db)
{
    global $dbDb, $dbEntradas;

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
        $consulta = "CREATE TABLE $dbEntradas (
            id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
            fecha DATE,
            entrada VARCHAR(".TAM_ENTRADA."),
            PRIMARY KEY(id)
            )";
        if ($db->query($consulta)) {
            print "    <p>Tabla de Entradas creada correctamente.</p>\n";
            print "\n";
        } else {
            print "    <p>Error al crear la tabla de Entradas.</p>\n";
            print "\n";
        }
    } else {
        print "    <p>Error al crear la base de datos.</p>\n";
        print "\n";
    }
}

function borraTodoSqlite($db)
{
    global $dbEntradas;

    $consulta = "DROP TABLE $dbEntradas";
    if ($db->query($consulta)) {
        print "    <p>Tabla de Entradas borrada correctamente.</p>\n";
        print "\n";
    } else {
        print "    <p>Error al borrar la tabla de Entradas.</p>\n";
    }
    $consulta = "CREATE TABLE $dbEntradas (
        id INTEGER PRIMARY KEY,
        fecha DATE,
        entrada VARCHAR(".TAM_ENTRADA.")
        )";
    if ($db->query($consulta)) {
        print "    <p>Tabla de Entradas creada correctamente.</p>\n";
        print "\n";
    } else {
        print "    <p>Error al crear la tabla de Entradas.</p>\n";
        print "\n";
    }
}

if (!isset($_REQUEST["si"])) {
    header("Location:index.php");
    exit();
} else {
    include("biblioteca.php");
    $db = conectaDb();
    cabecera("Borrar todo 2", CABECERA_SIN_CURSOR, "");
    if ($dbMotor == MYSQL) {
        borraTodoMySQL($db);
    } elseif ($dbMotor == SQLITE) {
        borraTodoSqlite($db);
    }
    $db = NULL;
    pie();
}
?>
