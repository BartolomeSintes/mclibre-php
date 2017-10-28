<?php
/**
 * Registro de usuarios 2 - registrar1.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2013 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2013-03-10
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

session_start();
if (isset($_SESSION['id'])) {
    header("Location:index.php");
    exit();
} else {
    cabecera("Registrar nuevo usuario 1", MENU_VOLVER, CABECERA_CON_CURSOR);

    $aviso = recoge("aviso");
    if ($aviso) {
        print "<p style=\"color: red\">$aviso</p>\n";
    }
    print "<form action=\"registrar2.php\" method=\"".FORM_METHOD."\">
  <p>Escriba su nombre de usuario y contraseña:</p>
  <table>
    <tbody>
      <tr>
        <td>Nombre:</td>
        <td><input type=\"text\" name=\"usuario\" size=\"$tamUsuario\" "
        ."maxlength=\"$tamUsuario\" id=\"cursor\" /> (hasta $tamUsuario caracteres)</td>
      </tr>
      <tr>
        <td>Contraseña:</td>
        <td><input type=\"password\" name=\"password\" size=\"$tamPassword\" "
        ."maxlength=\"$tamPassword\" /> (hasta $tamPassword caracteres)</td>
      </tr>
      <tr>
        <td>Repita la contraseña:</td>
        <td><input type=\"password\" name=\"password2\" size=\"$tamPassword\" "
        ."maxlength=\"$tamPassword\" /> (hasta $tamPassword caracteres)</td>
      </tr>
      </tbody>
  </table>
  <p><strong>Nota</strong>: Los nombres de más de $tamUsuario caracteres y las
  contraseñas de más de $tamPassword se recortarán a esas longitudes.</p>
  <p><input type=\"submit\" value=\"Añadir\" />
  <input type=\"reset\" value=\"Borrar\" />
</form>\n";
}

pie();
?>
