<?php
/**
 * Bases de datos 1-2 - biblioteca-mysql.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2019 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2019-12-09
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

// Constantes y variables globales

define("MYSQL_HOST", "mysql:host=localhost");        // Nombre de host
define("MYSQL_USER", "");                            // Nombre de usuario
define("MYSQL_PASSWORD", "");                        // Contraseña de usuario
define("MYSQL_DATABASE", "mclibre_base_datos_1_2");  // Nombre de la base de datos
define("MYSQL_TABLE_AGENDA", "tabla");               // Nombre de la tabla

$dbTablaAgenda = MYSQL_DATABASE . "." . MYSQL_TABLE_AGENDA;  // Nombre de la tabla

// Consultas

$consultaCreaDb = "CREATE DATABASE " . MYSQL_DATABASE . "
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci";

$consultaCreaTabla = "CREATE TABLE $dbTablaAgenda (
    id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
    nombre VARCHAR($tamAgendaNombre),
    apellidos VARCHAR($tamAgendaApellidos),
    PRIMARY KEY(id)
    )";

// Funciones comunes de bases de datos (MYSQL)

function conectaDb()
{
    try {
        $tmp = new PDO(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD);
        $tmp->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true);
        $tmp->exec("set names utf8mb4");
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

function borraTodo($db)
{
    global $consultaCreaDb, $consultaCreaTabla;

    $consulta = "DROP DATABASE " . MYSQL_DATABASE;
    if ($db->query($consulta)) {
        print "    <p>Base de datos borrada correctamente.</p>\n";
        print "\n";
    } else {
        print "    <p>Error al borrar la base de datos.</p>\n";
        print "\n";
    }
    $consulta = $consultaCreaDb;
    if ($db->query($consulta)) {
        print "    <p>Base de datos creada correctamente.</p>\n";
        print "\n";
        $consulta = $consultaCreaTabla;
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
