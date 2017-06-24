<?php
/**
 * Agenda - buscar1.php
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
$db = conectaDb();

$consulta = "SELECT COUNT(*) FROM $dbAgenda";
$result = $db->query($consulta);
if (!$result) {
    cabecera('Buscar 1', CABECERA_SIN_CURSOR);
    print "<p>Error en la consulta.</p>\n";
} elseif ($result->fetchColumn()==0) {
    cabecera('Buscar 1', CABECERA_SIN_CURSOR);
    print "<p>No se ha creado todavía ningún registro.</p>\n";
} else {
    cabecera('Buscar 1', CABECERA_CON_CURSOR);
    print "<form action=\"buscar2.php\" method=\"".FORM_METHOD."\">
  <p>Escriba el criterio de búsqueda (carácteres o números):</p>
  <table>
    <tbody>
      <tr>
        <td>Nombre:</td>
        <td><input type=\"text\" name=\"nombre\" size=\"".TAM_NOMBRE."\" "
        ."maxlength=\"".TAM_NOMBRE."\" id=\"cursor\" /></td>
      </tr>
      <tr>
        <td>Apellidos:</td>
        <td><input type=\"text\" name=\"apellidos\" size=\"".TAM_APELLIDOS."\" "
        ."maxlength=\"".TAM_APELLIDOS."\" /></td>
      </tr>
      <tr>
        <td>Teléfono:</td>
        <td><input type=\"text\" name=\"telefono\" size=\"".TAM_TELEFONO."\" "
        ."maxlength=\"".TAM_TELEFONO."\" /></td>
      </tr>
      <tr>
        <td>Correo:</td>
        <td><input type=\"text\" name=\"correo\" size=\"".TAM_CORREO."\" "
        ."maxlength=\"".TAM_CORREO."\" /></td>
      </tr>
    </tbody>
  </table>
  <p><input type=\"submit\" value=\"Buscar\" /></p>
</form>\n";
}

$db = NULL; 
pie();
?>
