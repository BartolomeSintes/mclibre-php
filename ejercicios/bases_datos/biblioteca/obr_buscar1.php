<?php
/**
 * Biblioteca - obr_buscar1.php
 * 
 * @author    Bartolom� Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2009 Bartolom� Sintes Marco
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

$consulta = "SELECT COUNT(*) FROM $dbObras";
$result = $db->query($consulta);
if (!$result) {
    cabecera('Obras - Buscar 1', CABECERA_SIN_CURSOR, 'menuObras');
    print "<p>Error en la consulta.</p>\n";
} elseif ($result->fetchColumn()==0) {
    cabecera('Obras - Buscar 1', CABECERA_SIN_CURSOR, 'menuObras');
    print "<p>No se ha creado todav�a ning�n registro.</p>\n";
} else {
    cabecera('Obras - Buscar 1', CABECERA_CON_CURSOR, 'menuObras');
    print "<form action=\"obr_buscar2.php\" method=\"".FORM_METHOD."\">
  <p>Escriba el criterio de b�squeda (car�cteres o n�meros):</p>
  <table>
    <tbody>
      <tr>
        <td>Autor:</td>
        <td><input type=\"text\" name=\"autor\" size=\"".TAM_AUTOR."\" "
        ."maxlength=\"".TAM_AUTOR."\" id=\"cursor\" /></td>
      </tr>
      <tr>
        <td>T�tulo:</td>
        <td><input type=\"text\" name=\"titulo\" size=\"".TAM_TITULO."\" "
        ."maxlength=\"".TAM_TITULO."\" /></td>
      </tr>
      <tr>
        <td>Editorial:</td>
        <td><input type=\"text\" name=\"editorial\" size=\"".TAM_EDITORIAL."\" "
        ."maxlength=\"".TAM_EDITORIAL."\" /></td>
      </tr>
    </tbody>
  </table>
  <p><input type=\"submit\" value=\"Buscar\" /></p>
</form>\n";
}

$db = NULL; 
pie();
?>
