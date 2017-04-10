<?php
/**
 * Inyección SQL 1 - entrar1.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2011 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2011-05-18
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
$db = conectaDb();

$consulta = "SELECT COUNT(*) FROM $dbTabla";
$result = sqlite_array_query($db, $consulta);
if (!$result) {
    cabecera('Añadir 1', MENU_VOLVER, CABECERA_SIN_CURSOR);
    print "<p>Error en la consulta.</p>\n";
} elseif ($result[0][0]>=MAX_REG_TABLA) {
    cabecera('Añadir 1', MENU_VOLVER, CABECERA_SIN_CURSOR);
    print "<p>Se ha alcanzado el número máximo de registros que se pueden "
        ."guardar.</p>\n<p>Por favor, borre algún registro antes.</p>\n";
} else {
    cabecera('Entrar 1', MENU_VOLVER, CABECERA_CON_CURSOR);
    print "<form action=\"entrar2.php\" method=\"".FORM_METHOD."\">
  <p>Para entrar en el sistema escriba su nombre de usuario y contraseña:</p>
  <table>
    <tbody>
      <tr>
        <td>Usuario:</td>
        <td><input type=\"text\" name=\"usuario\" size=\"$tamUsuario\" "
        ."maxlength=\"$tamUsuario\" id=\"cursor\" /></td>
      </tr>
      <tr>
        <td>Contraseña:</td>
        <td><input type=\"text\" name=\"contraseña\" size=\"$tamContraseña\" "
        ."maxlength=\"$tamContraseña\" /></td>
      </tr>
    </tbody>
  </table>
  <p><input type=\"submit\" value=\"Entrar\" /></p>
</form>\n";
}

$db = null;
pie();
?>
