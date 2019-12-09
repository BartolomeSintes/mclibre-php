<?php
/**
 * Identificación de usuarios (1) - Agenda (3) - comunes/biblioteca-mysql.php
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

// Variables globales

$dbTablaAgenda   = MYSQL_DATABASE . "." . MYSQL_TABLE_AGENDA;    // Nombre de la tabla Agenda
$dbTablaUsuarios = MYSQL_DATABASE . "." . MYSQL_TABLE_USUARIOS;  // Nombre de la tabla Usuarios

// Consultas

$consultaCreaDb = "CREATE DATABASE " . MYSQL_DATABASE . "
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci";

$consultaCreaTablaAgenda = "CREATE TABLE $dbTablaAgenda (
    id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
    nombre VARCHAR($tamAgendaNombre),
    apellidos VARCHAR($tamAgendaApellidos),
    telefono VARCHAR($tamAgendaTelefono),
    correo VARCHAR($tamAgendaCorreo),
    PRIMARY KEY(id)
    )";

$consultaCreaTablaUsuarios = "CREATE TABLE $dbTablaUsuarios (
    id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
    usuario VARCHAR($tamUsuariosUsuario),
    password VARCHAR($tamUsuariosPasswordCifrado),
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
        cabecera("Error grave", MENU_VOLVER, 1);
        print "    <p>Error: No puede conectarse con la base de datos.</p>\n";
        print "\n";
        print "    <p>Error: " . $e->getMessage() . "</p>\n";
        pie();
        exit();
    }
}

function borraTodo($db, $tablas, $consultasTablas)
{
    global $consultaCreaDb;

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
        foreach ($consultasTablas as $consulta) {
            if ($db->query($consulta)) {
                print "    <p>Tabla creada correctamente.</p>\n";
                print "\n";
            } else {
                print "    <p>Error al crear la tabla</p>\n";
                print "\n";
            }
        }
    } else {
        print "    <p>Error al crear la base de datos.</p>\n";
        print "\n";
    }

    $consulta = "INSERT INTO $tablas[0]
        VALUES (NULL, '" . ROOT_NAME . "', '" . ROOT_PASSWORD . "')";
    if ($db->query($consulta)) {
        print "    <p>Registro de Usuario " . ROOT_NAME . " creado correctamente.</p>\n";
        print "\n";
    } else {
        print "    <p>Error al crear el registro de Usuario " . ROOT_NAME . ".<p>\n";
        print "\n";
    }
}

function existenTablas($db, $tablas)
{
    $existe   = true;
    $consulta = "SELECT count(*) FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = '" . MYSQL_DATABASE . "'";
    $result   = $db->query($consulta);
    if (!$result) {
        print "    <p>Error en la consulta.</p>\n";
        print "\n";
    } else {
        if ($result->fetchColumn() == 0) {
            $existe = false;
        } else {
            foreach ($tablas as $tabla) {
                // En information_schema.tables los nombres d elas tablas no llevan el nombre
                // de la base de datos, así que lo elimino
                $tabla    = str_replace(MYSQL_DATABASE . ".", "", $tabla);
                $consulta = "SELECT count(*) FROM information_schema.tables
                WHERE table_schema = '" . MYSQL_DATABASE . "'
                    AND table_name = '$tabla'";
                $result = $db->query($consulta);
                if (!$result) {
                    print "    <p>Error en la consulta.</p>\n";
                    print "\n";
                } else {
                    if ($result->fetchColumn() == 0) {
                        print "hola";
                        $existe = false;
                    }
                }
            }
        }
    }
    return $existe;
}
