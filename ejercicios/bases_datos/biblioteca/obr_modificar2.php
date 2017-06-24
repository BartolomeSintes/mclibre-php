<?php
/**
 * Biblioteca - obr_modificar2.php
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

$id = recogeParaConsulta($db, 'id');

if ($id=="''") {
    cabecera('Obras - Modificar 2', CABECERA_SIN_CURSOR, 'menuObras');
    print "<p>No se ha seleccionado ningún registro.</p>\n";
} else {
    $consulta = "SELECT COUNT(*) FROM $dbObras 
        WHERE id=$id";
    $result = $db->query($consulta);
    if (!$result) {
        cabecera('Obras - Modificar 2', CABECERA_SIN_CURSOR, 'menuObras');
        print "<p>Error en la consulta.</p>\n";
    } elseif ($result->fetchColumn()==0) {
        cabecera('Obras - Modificar 2', CABECERA_SIN_CURSOR, 'menuObras');
        print "<p>Registro no encontrado.</p>\n";
    } else {
        $consulta = "SELECT * FROM $dbObras 
            WHERE id=$id";
        $result = $db->query($consulta);
        if (!$result) {
            cabecera('Obras - Modificar 2', CABECERA_SIN_CURSOR, 'menuObras');
            print "<p>Error en la consulta.</p>\n";
        } else {
            $valor = $result->fetch();
            cabecera('Obras - Modificar 2', CABECERA_CON_CURSOR, 'menuObras');
            print "<form action=\"obr_modificar3.php\" method=\"".FORM_METHOD."\">
  <p>Modifique los campos que desee:</p>
  <table>
    <tbody>
      <tr>
        <td>Autor:</td>
        <td><input type=\"text\" name=\"autor\" size=\"".TAM_AUTOR."\" " 
          ."maxlength=\"".TAM_AUTOR."\" value=\"$valor[autor]\" id=\"cursor\" /></td>
      </tr>
      <tr>
        <td>Título:</td>
        <td><input type=\"text\" name=\"titulo\" size=\"".TAM_TITULO."\" " 
          ."maxlength=\"".TAM_TITULO."\" value=\"$valor[titulo]\" /></td>
      </tr>
      <tr>
        <td>Editorial:</td>
        <td><input type=\"text\" name=\"editorial\" size=\"".TAM_EDITORIAL."\" "
          ."maxlength=\"".TAM_EDITORIAL."\" value=\"$valor[editorial]\" /></td>
      </tr>
    </tbody>
  </table>
  <p><input type=\"hidden\" name=\"id\" value=\"$id\" />
    <input type=\"submit\" value=\"Actualizar\" /></p>
</form>\n";
        }
    }
}

$db = NULL;
pie();
?>
