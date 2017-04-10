<?php
/**
 * Bases de datos 1-6 - modificar_2.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2016 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2016-12-06
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

require_once "biblioteca.php";

$db = conectaDb();
cabecera("Modificar 2", MENU_VOLVER);

$id = recoge("id");

$consulta = "SELECT * FROM $dbTabla
    WHERE id=:id";
$result = $db->prepare($consulta);
$result->execute(array(":id" => $id));
$valor = $result->fetch();

print "      <form action=\"modificar_3.php\" method=\"" . FORM_METHOD . "\">\n";
print "        <p>Modifique los campos que desee:</p>\n";
print "\n";
print "        <table>\n";
print "          <tbody>\n";
print "            <tr>\n";
print "              <td>Nombre:</td>\n";
print "              <td><input type=\"text\" name=\"nombre\" size=\"$tamNombre\" maxlength=\"$tamNombre\" value=\"$valor[nombre]\" autofocus=\"autofocus\" /></td>\n";
print "            </tr>\n";
print "            <tr>\n";
print "              <td>Apellidos:</td>\n";
print "              <td><input type=\"text\" name=\"apellidos\" size=\"$tamApellidos\" maxlength=\"$tamApellidos\" value=\"$valor[apellidos]\" /></td>\n";
print "            </tr>\n";
print "          </tbody>\n";
print "        </table>\n";
print "\n";
print "        <p>\n";
print "          <input type=\"hidden\" name=\"id\" value=\"$id\" />\n";
print "          <input type=\"submit\" value=\"Actualizar\" />\n";
print "          <input type=\"reset\" value=\"Reiniciar formulario\" />\n";
print "        </p>\n";
print "      </form>\n";

$db = null;
pie();
