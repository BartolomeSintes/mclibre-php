<?php
/**
 * Compraventa - anyadir1.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2008 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2008-02-26
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
if (!isset($_SESSION['compraventaUsuario'])) {
    header('Location:index.php');
    exit();
} else {
    include('funciones.php');
    $db = conectaDb();
    cabecera('Venta - Añadir 1', 'venta');
    $consulta = "SELECT COUNT(*) FROM $dbArticulos";
    $result = $db->query($consulta);
    if (!$result) {
        print "<p>Error en la consulta.</p>\n";
    } elseif ($result->fetchColumn()>=$maxRegArticulos) {
        print "<p>Se ha alcanzado el número máximo de registros que se pueden "
            . "guardar.</p>\n<p>Por favor, borre algún registro antes.</p>\n";
    } else {
        print "<form action=\"ve_anyadir2.php\" method=\"get\">
      <p>Escriba los datos del nuevo artículo:</p>
      <table>
        <tbody>
          <tr>
            <td>Artículo:</td>
            <td><input type=\"text\" name=\"articulo\" size=\"$tamArticulo\" id=\"cursor\" /></td>
          </tr>
          <tr>
            <td>Precio:</td>
            <td><input type=\"text\" name=\"precio\" size=\"$tamPrecio\" /> &euro;</td>
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
