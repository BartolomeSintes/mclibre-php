<?php
/**
 * Registro usuarios - index.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2013 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2013-03-07
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

$consulta = $consultaExisteTabla;
$result = $db->query($consulta);
if (!$result) {
    cabecera("Primera conexión", CABECERA_SIN_CURSOR, MENU_PRINCIPAL);
    print "<p>Error en la consulta.</p>\n";
} elseif ($result->fetchColumn() == 0) {
    cabecera("Primera conexión", CABECERA_SIN_CURSOR, MENU_PRINCIPAL);
    print "<p>Aparentemente, la base de datos no existe. "
        . "Se creará a continuación.</p>";
    if ($dbMotor == MYSQL) {
        borraTodoMySQL($db);
    } elseif ($dbMotor == SQLITE) {
        borraTodoSqlite($db);
    }
} else {
    session_start();
    if (isset($_SESSION["multiagendaUsuario"])) {
        cabecera("Inicio", CABECERA_SIN_CURSOR, $_SESSION["multiagendaUsuario"]);
    } else {
        cabecera("Identificación 1", CABECERA_CON_CURSOR, MENU_PRINCIPAL);
        $aviso = recoge("aviso");
        if ($aviso) {
            print "<p style=\"color: red\">$aviso</p>\n";
        }
        print "<form action=\"validar1.php\" method=\"" . FORM_METHOD . "\">
  <p>Escriba su nombre de usuario y contraseña:</p>
  <table>
    <tbody>
      <tr>
        <td>Nombre:</td>
        <td><input type=\"text\" name=\"usuario\" size=\"$tamUsuario\" "
            . "maxlength=\"$tamUsuario\" id=\"cursor\" /></td>
      </tr>
      <tr>
        <td>Contraseña:</td>
        <td><input type=\"password\" name=\"password\" size=\"$tamPassword\" "
            . "maxlength=\"$tamPassword\" /></td>
      </tr>
    </tbody>
  </table>
  <p><input type=\"submit\" value=\"Añadir\" /></p>
  <p><strong>Nota</strong>: Si no está ya registrado, le registraré como nuevo usuario.</p>
</form>\n";
    }
}
$db = null;
pie();
?>
