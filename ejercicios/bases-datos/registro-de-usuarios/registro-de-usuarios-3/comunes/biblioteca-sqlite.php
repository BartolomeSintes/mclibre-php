<?php
/**
 * Registro de usuarios 3 - comunes/biblioteca-sqlite.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2019 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2019-05-07
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

// Variables globales

$dbDb               = SQLITE_DATABASE;                // Nombre de la base de datos
$dbTablaUsuariosWeb = SQLITE_TABLA_USUARIOS_WEB;      // Nombre de la tabla de Usuarios de la web

// Consultas

$consultaCreaTablaUsuariosWeb = "CREATE TABLE $dbTablaUsuariosWeb (
    id INTEGER PRIMARY KEY,
    usuario VARCHAR($tamUsuariosWebUsuario),
    password VARCHAR($tamUsuariosWebCifrado),
    nivel INTEGER NOT NULL
    )";

// Funciones comunes de bases de datos (SQLITE)

function conectaDb()
{
    global $dbDb;

    try {
        $tmp = new PDO("sqlite:$dbDb");
        // activate use of foreign key constraints
        $tmp->exec("PRAGMA foreign_keys = ON;");
        return($tmp);
    } catch(PDOException $e) {
        cabecera("Error grave", MENU_ERROR, 1);
        print "    <p class=\"aviso\">Error: No puede conectarse con la base de datos.</p>\n";
        print "\n";
        print "    <p class=\"aviso\">Error: " . $e->getMessage() . "</p>\n";
        pie();
        exit();
    }
}

function borraTodo($db)
{
    global $dbTablaUsuariosWeb, $consultaCreaTablaUsuariosWeb,
        $administradorNombre, $administradorPassword;

    $consulta = "DROP TABLE $dbTablaUsuariosWeb";
    if ($db->query($consulta)) {
        print "    <p>Tabla de Usuarios borrada correctamente.</p>\n";
        print "\n";
    } else {
        print "    <p class=\"aviso\">Error al borrar la tabla de Usuarios.</p>\n";
        print "\n";
    }
    if ($db->query($consultaCreaTablaUsuariosWeb)) {
        print "    <p>Tabla de Usuarios creada correctamente.</p>\n";
        print "\n";

        if ($administradorNombre != "") {
            $consulta = "INSERT INTO $dbTablaUsuariosWeb VALUES (NULL,
                '$administradorNombre', '" . encripta($administradorPassword) . "', '" . NIVEL_3 . "')";
            if ($db->query($consulta)) {
                print "    <p>Registro de Usuario Administrador creado correctamente.</p>\n";
                print "\n";
            } else {
                print "    <p class=\"aviso\">Error al crear el registro de Usuario Administrador.</p>\n";
                print "\n";
            }
        }
    } else {
        print "    <p class=\"aviso\">Error al crear la tabla de Usuarios.</p>\n";
        print "\n";
    }
}
