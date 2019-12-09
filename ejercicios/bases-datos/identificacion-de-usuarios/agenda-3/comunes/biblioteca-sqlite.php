<?php
/**
 * Identificación de usuarios (1) - Agenda (3) - comunes/biblioteca-sqlite.php
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

$dbTablaAgenda   = SQLITE_TABLE_AGENDA;    // Nombre de la tabla Agenda
$dbTablaUsuarios = SQLITE_TABLE_USUARIOS;  // Nombre de la tabla Usuarios

// Consultas

$consultaCreaTablaAgenda = "CREATE TABLE $dbTablaAgenda (
    id INTEGER PRIMARY KEY,
    nombre VARCHAR($tamAgendaNombre),
    apellidos VARCHAR($tamAgendaApellidos),
    telefono VARCHAR($tamAgendaTelefono),
    correo VARCHAR($tamAgendaCorreo)
    )";

$consultaCreaTablaUsuarios = "CREATE TABLE $dbTablaUsuarios (
    id INTEGER PRIMARY KEY,
    usuario VARCHAR($tamUsuariosUsuario),
    password VARCHAR($tamUsuariosPasswordCifrado)
    )";

// Funciones comunes de bases de datos (SQLITE)

function conectaDb()
{
    try {
        $tmp = new PDO("sqlite:" . SQLITE_DATABASE);
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

function borraTodo($db, $tablas, $consultasTablas, $consultaCreaDB="")
{
    foreach ($tablas as $tabla) {
        $consulta = "DROP TABLE $tabla";
        if ($db->query($consulta)) {
            print "    <p>Tabla <strong>$tabla</strong> borrada correctamente.</p>\n";
            print "\n";
        } else {
            print "    <p>Error al borrar la tabla <strong>$tabla</strong>.</p>\n";
            print "\n";
        }
    }
    foreach ($consultasTablas as $consulta) {
        if ($db->query($consulta)) {
            print "    <p>Tabla creada correctamente.</p>\n";
            print "\n";
        } else {
            print "    <p>Error al crear la tabla.</p>\n";
            print "\n";
        }
    }
    $consulta = "INSERT INTO $tablas[0]
        VALUES (NULL, '" . ROOT_NAME. "', '" . ROOT_PASSWORD . "')";
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
    $existe = true;
    foreach ($tablas as $tabla) {
        $consulta = "SELECT count(*) FROM sqlite_master WHERE type='table' AND name='$tabla'";
        $result   = $db->query($consulta);
        if (!$result) {
            print "    <p>Error en la consulta.</p>\n";
            print "\n";
        } else {
            if ($result->fetchColumn() == 0) {
                $existe = false;
            }
        }
    }
    return $existe;
}
