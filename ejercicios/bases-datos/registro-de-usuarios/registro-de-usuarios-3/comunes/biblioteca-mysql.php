<?php
/**
 * Registro de usuarios 3 - comunes/biblioteca-mysql.php
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

$dbDb               = MYSQL_DATABASE;                                  // Nombre de la base de datos
$dbTablaUsuariosWeb = MYSQL_DATABASE . "." . MYSQL_TABLA_USUARIOS_WEB; // Nombre de la tabla de Usuarios de la web

// Consultas

$consultaCreaDb = "CREATE DATABASE $dbDb
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci";

$consultaCreaTablaUsuariosWeb = "CREATE TABLE $dbTablaUsuariosWeb (
    id INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY,
    usuario VARCHAR($tamUsuariosWebUsuario),
    password VARCHAR($tamUsuariosWebCifrado),
    nivel INTEGER NOT NULL
    )";

// Funciones comunes de bases de datos (MYSQL)

function conectaDb()
{
    try {
        $tmp = new PDO(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD);
        $tmp->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true);
        $tmp->exec("set names utf8mb4");
        return($tmp);
    } catch(PDOException $e) {
        cabecera("Error grave", MENU_ERROR, 1);
        print "    <p class=\"aviso\">Error: No puede conectarse con la base de datos.</p>\n";
        print "\n";
        print "    <p class=\"aviso\">Error: " . utf8_encode($e->getMessage()) . "</p>\n";
        pie();
        exit();
    }
}

function borraTodo($db)
{
    global $dbDb, $consultaCreaDb,
        $dbTablaUsuariosWeb, $consultaCreaTablaUsuariosWeb,
        $administradorNombre, $administradorPassword;

    $consulta = "DROP DATABASE $dbDb";
    if ($db->query($consulta)) {
        print "    <p>Base de datos borrada correctamente.</p>\n";
        print "\n";
    } else {
        print "    <p class=\"aviso\">Error al borrar la base de datos.</p>\n";
        print "\n";
    }
    $consulta = $consultaCreaDb;
    if ($db->query($consulta)) {
        print "    <p>Base de datos creada correctamente.</p>\n";
        print "\n";
        $consulta = $consultaCreaTablaUsuariosWeb;
        if ($db->query($consulta)) {
            print "    <p>Tabla de Usuario creada correctamente.</p>\n";
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
    } else {
        print "    <p class=\"aviso\">Error al crear la base de datos.</p>\n";
        print "\n";
    }
}
