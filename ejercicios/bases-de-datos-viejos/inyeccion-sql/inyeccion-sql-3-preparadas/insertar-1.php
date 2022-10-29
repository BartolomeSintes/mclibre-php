<?php
/**
 * Inyección SQL 3 - insertar-1.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2011 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2011-05-18
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

include "biblioteca.php";
$db = conectaDb();

$consulta = "SELECT COUNT(*) FROM $dbTabla";
$result = $db->query($consulta);
if (!$result) {
    cabecera("Añadir 1", MENU_VOLVER);
    print "    <p>Error en la consulta.</p>\n";
    print "\n";
} elseif ($result->fetchColumn() >= MAX_REG_TABLA) {
    cabecera("Añadir 1", MENU_VOLVER);
    print "    <p>Se ha alcanzado el número máximo de registros que se pueden guardar.</p>\n";
    print "\n";
    print "    <p>Por favor, borre algún registro antes.</p>\n";
    print "\n";
} else {
    cabecera("Añadir 1", MENU_VOLVER);
    print "    <form action=\"insertar-2.php\" method=\"" . FORM_METHOD . "\">\n";
    print "      <p>Escriba los datos del nuevo registro:</p>\n";
    print "\n";
    print "      <table>\n";
    print "        <tr>\n";
    print "          <td>Usuario:</td>\n";
    print "          <td><input type=\"text\" name=\"usuario\" size=\"$tamUsuario\" "
    . "maxlength=\"$tamUsuario\" autofocus></td>\n";
    print "        </tr>\n";
    print "        <tr>\n";
    print "          <td>Contraseña:</td>\n";
    print "          <td><input type=\"text\" name=\"contraseña\" size=\"$tamContraseña\" "
    . "maxlength=\"$tamContraseña\"></td>\n";
    print "        </tr>\n";
    print "      </table>\n";
    print "\n";
    print "      <p><input type=\"submit\" value=\"Añadir\"></p>\n";
    print "    </form>\n";
    print "    \n";
}

$db = null;
pie();
?>
