<?php
/**
 * Foro - edi-borrar-todo-2.php
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
    global $dbDb, $dbDiscusiones, $dbIntervenciones;

    $consulta = "DROP DATABASE $dbDb";
    if ($db->query($consulta)) {
        print "<p>Base de datos borrada correctamente.</p>\n";
    } else {
        print "<p>Error al borrar la base de datos.</p>\n";
    }
    $consulta = "CREATE DATABASE $dbDb";
    if ($db->query($consulta)) {
        print "<p>Base de datos creada correctamente.</p>\n";
        $consultaCreaTablaDiscusiones  = "CREATE TABLE $dbDiscusiones (
            id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
            titulo VARCHAR(".TAM_TITULO."),
            descripcion VARCHAR(".TAM_DESCRIPCION."),
            autor VARCHAR(".TAM_AUTOR."),
            fecha DATETIME,
            PRIMARY KEY(id)
            )";
        if ($db->query($consultaCreaTablaDiscusiones )) {
            print "<p>Tabla de Discusiones creada correctamente.</p>\n";
        } else {
            print "<p>Error al crear la tabla de Discusiones.</p>\n";
        }
        $consultaCreaTablaIntervenciones  = "CREATE TABLE $dbIntervenciones (
            id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
            id_discusion INTEGER UNSIGNED,
            autor VARCHAR(".TAM_AUTOR."),
            fecha DATETIME,
            intervencion VARCHAR(".TAM_INTERVENCION."),
            PRIMARY KEY(id)
            )";
        if ($db->query($consultaCreaTablaIntervenciones )) {
            print "<p>Tabla de Intervenciones creada correctamente.</p>\n";
        } else {
            print "<p>Error al crear la tabla de Intervenciones.</p>\n";
        }
    } else {
        print "<p>Error al crear la base de datos.</p>\n";
    }
}

function borraTodoSqlite($db)
{
    global $dbDiscusiones, $dbIntervenciones;

    $consulta = "DROP TABLE $dbDiscusiones";
    if ($db->query($consulta)) {
       print "<p>Tabla de Discusiones borrada correctamente.</p>\n";
    } else {
        print "<p>Error al borrar la tabla de Discusiones.</p>\n";
    }
    $consulta = "DROP TABLE $dbIntervenciones";
    if ($db->query($consulta)) {
       print "<p>Tabla de Intervenciones borrada correctamente.</p>\n";
    } else {
        print "<p>Error al borrar la tabla de Intervenciones.</p>\n";
    }
    $consultaCreaTablaDiscusiones = "CREATE TABLE $dbDiscusiones (
        id INTEGER PRIMARY KEY,
        titulo VARCHAR(".TAM_TITULO."),
        descripcion VARCHAR(".TAM_DESCRIPCION."),
        autor VARCHAR(".TAM_AUTOR."),
        fecha DATETIME
        )";
    if ($db->query($consultaCreaTablaDiscusiones)) {
       print "<p>Tabla de Discusiones creada correctamente.</p>\n";
    } else {
        print "<p>Error al crear la tabla de Discusiones.</p>\n";
    }
    $consultaCreaTablaIntervenciones = "CREATE TABLE $dbIntervenciones (
        id INTEGER PRIMARY KEY,
        id_discusion INTEGER UNSIGNED,
        autor VARCHAR(".TAM_AUTOR."),
        fecha DATETIME,
        intervencion VARCHAR(".TAM_INTERVENCION.")
        )";
    if ($db->query($consultaCreaTablaIntervenciones)) {
       print "<p>Tabla de Intervenciones creada correctamente.</p>\n";
    } else {
        print "<p>Error al crear la tabla de Intervenciones.</p>\n";
    }
}

if (!isset($_REQUEST['si'])) {
    header('Location:index.php');
    exit();
} else {
    include('funciones.php');
    $db = conectaDb();
    cabecera('Editor - Borrar todo 2', CABECERA_SIN_CURSOR, 'menuEditor', '');
    if ($dbMotor==MYSQL) {
        borraTodoMySQL($db);
    } elseif ($dbMotor==SQLITE) {
        borraTodoSqlite($db);
    }
    $db = NULL;
    pie();
}
?>
