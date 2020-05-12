<?php
/**
 * Biblioteca - db-prestamos/devolver-1.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2020 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2020-05-11
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

require_once "../comunes/biblioteca.php";

session_name(SESSION_NAME);
session_start();
if (!isset($_SESSION["conectado"]) || $_SESSION["conectado"] != NIVEL_2) {
    header("Location:../index.php");
    exit;
}

$db = conectaDb();
cabecera("Préstamos - Devolver 1", MENU_PRESTAMOS, 1);

$ordena = recogeValores("ordena", $columnasPrestamosOrden, "autor ASC");

$consulta = "SELECT COUNT(*) FROM $tablaPrestamos
    WHERE devuelto='0000-00-00'";
$result   = $db->query($consulta);
if (!$result) {
    print "    <p>Error en la consulta.</p>\n";
} elseif ($result->fetchColumn() == 0) {
    print "    <p>No hay obras pendientes de devolución.</p>\n";
} else {
    $consulta = "SELECT $tablaPrestamos.id as id,
            $tablaPersonas.nombre as nombre,
            $tablaPersonas.apellidos as apellidos,
            $tablaObras.titulo as titulo,
            $tablaObras.autor as autor,
            $tablaPrestamos.prestado as prestado,
            $tablaPrestamos.devuelto as devuelto
        FROM $tablaPersonas, $tablaObras, $tablaPrestamos
        WHERE $tablaPrestamos.id_persona=$tablaPersonas.id
        AND $tablaPrestamos.id_obra=$tablaObras.id
        AND $tablaPrestamos.devuelto='0000-00-00'
        ORDER BY $ordena";
    $result   = $db->query($consulta);
    if (!$result) {
        print "    <p class=\"aviso\">Error en la consulta.</p>\n";
    } else {
        print "    <form action=\"devolver-2.php\" method=\"" . FORM_METHOD . "\">\n";
        print "      <p>Seleccione el préstamo pendiente e indique la fecha de devolución:</p>\n";
        print "\n";
        print "      <table>\n";
        print "        <tbody>\n";
        print "          <tr>\n";
        print "            <td>Préstamo:</td>\n";
        print "            <td>\n";
        print "            <select name=\"id\">\n";
        print "                <option value=\"\"></option>\n";
        foreach ($result as $valor) {
            print "                <option value=\"$valor[id]\">$valor[nombre] $valor[apellidos] - $valor[autor] - $valor[titulo]</option>\n";
        }
        print "              </select>\n";
        print "            </td>\n";
        print "          </tr>\n";
        print "          <tr>\n";
        print "            <td>Fecha de devolución:</td>\n";
        print "            <td><input type=\"date\" name=\"devuelto\" value=\"" . date("Y-m-j") . "\"></td>\n";
        print "          </tr>\n";
        print "        </tbody>\n";
        print "      </table>\n";
        print "\n";
        print "      <p>\n";
        print "        <input type=\"submit\" value=\"Añadir\">\n";
        print "        <input type=\"reset\" value=\"Reiniciar formulario\">\n";
        print "      </p>\n";
        print "    </form>\n";
    }
}

$db = null;
pie();
