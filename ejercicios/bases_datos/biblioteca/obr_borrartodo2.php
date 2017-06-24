<?php
/**
 * Biblioteca - obr_borrartodo2.php
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

include('funciones.php');

function borraTodoMySQL($db)
{
    global $dbDb, $dbObras, $dbUsuarios, $dbPrestamos;

    $consulta = "DROP TABLE $dbObras";
    if ($db->query($consulta)) {
        print "<p>Tabla de Obras borrada correctamente.</p>\n";
    } else {
        print "<p>Error al borrar la tabla de Obras.</p>\n";
    }
    $consulta = "DROP TABLE $dbPrestamos";
    if ($db->query($consulta)) {
        print "<p>Tabla de Préstamos borrada correctamente.</p>\n";
    } else {
        print "<p>Error al borrar la tabla de Préstamos.</p>\n";
    }
    $consultaCreaTablaObras = "CREATE TABLE $dbObras (
        id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
        autor VARCHAR(".TAM_AUTOR."), 
        titulo VARCHAR(".TAM_TITULO."),
        editorial VARCHAR(".TAM_EDITORIAL."),   
        PRIMARY KEY(id)
        )";
    if ($db->query($consultaCreaTablaObras)) {
        print "<p>Tabla de Obras creada correctamente.</p>\n";
    } else {
        print "<p>Error al crear la tabla de Obras.</p>\n";
    }
    $consultaCreaTablaPrestamos = "CREATE TABLE $dbPrestamos (
        id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
        id_usuario INTEGER UNSIGNED, 
        id_obra INTEGER UNSIGNED, 
        prestado DATE, 
        devuelto DATE, 
        PRIMARY KEY(id)
        )";
    if ($db->query($consultaCreaTablaPrestamos)) {
        print "<p>Tabla de Préstamos creada correctamente.</p>\n";
    } else {
        print "<p>Error al crear la tabla de Préstamos.</p>\n";
    }
}

function borraTodoSqlite($db)
{
    global $dbObras, $dbUsuarios, $dbPrestamos;
        
    $consulta = "DROP TABLE $dbObras";
    if ($db->query($consulta)) {
       print "<p>Tabla de Obras borrada correctamente.</p>\n";
    } else {
        print "<p>Error al borrar la tabla de Obras.</p>\n";
    }
    $consulta = "DROP TABLE $dbPrestamos";
    if ($db->query($consulta)) {
       print "<p>Tabla de Préstamos borrada correctamente.</p>\n";
    } else {
        print "<p>Error al borrar la tabla de Préstamos.</p>\n";
    }
    $consultaCreaTablaObras = "CREATE TABLE $dbObras (
        id INTEGER PRIMARY KEY,
        autor VARCHAR(".TAM_AUTOR."), 
        titulo VARCHAR(".TAM_TITULO."), 
        editorial VARCHAR(".TAM_EDITORIAL.")
        )";
    if ($db->query($consultaCreaTablaObras)) {
        print "<p>Tabla de Obras creada correctamente.</p>\n";
    } else {
        print "<p>Error al crear la tabla de Obras.</p>\n";
    }
    $consultaCreaTablaPrestamos = "CREATE TABLE $dbPrestamos (
        id INTEGER PRIMARY KEY,
        id_usuario INTEGER UNSIGNED, 
        id_obra INTEGER UNSIGNED, 
        prestado DATE, 
        devuelto DATE 
        )";
    if ($db->query($consultaCreaTablaPrestamos)) {
        print "<p>Tabla de Préstamos creada correctamente.</p>\n";
    } else {
        print "<p>Error al crear la tabla de Préstamos.</p>\n";
    }
}

if (!isset($_REQUEST['si'])) {
    header('Location:index.php');
    exit();
} else {
    $db = conectaDb();
    cabecera('Obras - Borrar todo 2', CABECERA_SIN_CURSOR, 'menuObras');
    if ($dbMotor==MYSQL) {
        borraTodoMySQL($db);
    } elseif ($dbMotor==SQLITE) {
        borraTodoSqlite($db);
    }
    $db = NULL;
    pie();
}
?>
