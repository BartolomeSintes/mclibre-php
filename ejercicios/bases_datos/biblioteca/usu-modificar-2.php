<?php
/**
 * Biblioteca - usu_modificar2.php
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
    cabecera('Usuarios - Modificar 2', CABECERA_SIN_CURSOR, 'menuUsuarios');
    print "<p>No se ha seleccionado ningún registro.</p>\n";
} else {
    $consulta = "SELECT COUNT(*) FROM $dbUsuarios
        WHERE id=$id";
    $result = $db->query($consulta);
    if (!$result) {
        cabecera('Usuarios - Modificar 2', CABECERA_SIN_CURSOR, 'menuUsuarios');
        print "<p>Error en la consulta.</p>\n";
    } elseif ($result->fetchColumn()==0) {
        cabecera('Usuarios - Modificar 2', CABECERA_SIN_CURSOR, 'menuUsuarios');
        print "<p>Registro no encontrado.</p>\n";
    } else {
        $consulta = "SELECT * FROM $dbUsuarios
            WHERE id=$id";
        $result = $db->query($consulta);
        if (!$result) {
            cabecera('Usuarios - Modificar 2', CABECERA_SIN_CURSOR, 'menuUsuarios');
            print "<p>Error en la consulta.</p>\n";
        } else {
            $valor = $result->fetch();
            cabecera('Usuarios - Modificar 2', CABECERA_CON_CURSOR, 'menuUsuarios');
            print "<form action=\"usu_modificar3.php\" method=\"".FORM_METHOD."\">
  <p>Modifique los campos que desee:</p>
  <table>
    <tbody>
      <tr>
        <td>Nombre:</td>
        <td><input type=\"text\" name=\"nombre\" size=\"".TAM_NOMBRE."\" "
          ."maxlength=\"".TAM_NOMBRE."\" value=\"$valor[nombre]\" id=\"cursor\" /></td>
      </tr>
      <tr>
        <td>Apellidos:</td>
        <td><input type=\"text\" name=\"apellidos\" size=\"".TAM_APELLIDOS."\" "
          ."maxlength=\"".TAM_APELLIDOS."\" value=\"$valor[apellidos]\" /></td>
      </tr>
      <tr>
        <td>DNI:</td>
        <td><input type=\"text\" name=\"dni\" size=\"".TAM_DNI."\" "
          ."maxlength=\"".TAM_DNI."\" value=\"$valor[dni]\" /></td>
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
