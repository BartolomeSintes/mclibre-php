<?php
/**
 * Citas -  cit-anyadir-1.php
 *
 * @author    Bartolom� Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2008 Bartolom� Sintes Marco
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
    cabecera('Citas - A�adir 1', 'menu_citas');
    $consulta = "SELECT COUNT(*) FROM $dbAutores";
    $result = $db->query($consulta);
    if (!$result) {
        print "<p>Error en la consulta.</p>\n";
    } elseif ($result->fetchColumn()==0) {
        print "<p>No se ha creado todav�a ning�n autor.</p>\n";
    } else {
        $consulta = "SELECT COUNT(*) FROM $dbCitas";
        $result = $db->query($consulta);
        if (!$result) {
            print "<p>Error en la consulta.</p>\n";
        } elseif ($result->fetchColumn()>=$maxRegCitas) {
            print "<p>Se ha alcanzado el n�mero m�ximo de registros que se pueden "
                ."guardar.</p>\n<p>Por favor, borre alg�n registro antes.</p>\n";
        } else {
            print "<form action=\"cit-anyadir-2.php\" method=\"get\">
  <p>Escriba los datos de la nueva cita:</p>
  <table>
    <tbody>
      <tr>
        <td>Autor:</td>
        <td>
          <select name=\"autor\">\n";
            $consulta = "SELECT * FROM $dbAutores
                ORDER by apellidos ASC";
            $result = $db->query($consulta);
            foreach ($result as $indice => $valor) {
                print "            <option value=\"$valor[id]\">$valor[nombre] $valor[apellidos]</option>\n";
            }
            print "          </select>
       </td>
    </tr>
    <tr>
        <td>Cita:</td>
        <td><textarea name=\"cita\" cols=\"80\" rows=\"5\" id=\"cursor\" ></textarea></td>
      </tr>
      </tbody>
  </table>
  <p><input type=\"submit\" value=\"A�adir\" /></p>
</form>\n";
        }
    }
    $db = NULL;
    pie();
}
?>
