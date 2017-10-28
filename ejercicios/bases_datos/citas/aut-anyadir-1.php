<?php
/**
 * Citas -  aut_anyadir1.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2008 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2008-06-06
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

session_start();
if (!isset($_SESSION['citasUsuario'])) {
    header('Location:index.php');
    exit();
} else {
    include('funciones.php');
    $db = conectaDb();
    cabecera('Autores - Añadir 1', 'menu_autores');
    $consulta = "SELECT COUNT(*) FROM $dbAutores";
    $result = $db->query($consulta);
    if (!$result) {
        print "<p>Error en la consulta.</p>\n";
    } elseif ($result->fetchColumn()>=$maxRegAutores) {
        print "<p>Se ha alcanzado el número máximo de registros que se pueden "
            ."guardar.</p>\n<p>Por favor, borre algún registro antes.</p>\n";
    } else {
        print "<form action=\"aut_anyadir2.php\" method=\"get\">
  <p>Escriba los datos del nuevo autor:</p>
  <table>
    <tbody>
      <tr>
        <td>Nombre:</td>
        <td><input type=\"text\" name=\"nombre\" size=\"$tamNombre\" id=\"cursor\" /></td>
      </tr>
      <tr>
        <td>Apellidos:</td>
        <td><input type=\"text\" name=\"apellidos\" size=\"$tamApellidos\" /></td>
      </tr>
      </tbody>
  </table>
  <p><input type=\"submit\" value=\"Añadir\" /></p>
</form>\n";
    }
    $db = NULL;
    pie();
}
?>
