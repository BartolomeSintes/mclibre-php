<?php
/**
 * Compraventa - modificar2.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2008 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2008-02-27
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
    cabecera('Modificar 2', 'venta');

    $id = recogeParaConsulta($db, 'id');

    if ($id=="''") {
        print "<p>No se ha seleccionado ningún registro.</p>\n";
    } else {
        $consulta = "SELECT COUNT(*) FROM $dbArticulos
            WHERE id='$id'
            AND id_vendedor='$_SESSION[compraventaIdUsuario]'";
        $result = $db->query($consulta);
        if (!$result) {
            print "<p>Error en la consulta.</p>\n";
        } elseif ($result->fetchColumn()==0) {
            print "<p>Registro no encontrado.</p>\n";
        } else {
            $consulta = "SELECT * FROM $dbArticulos
                WHERE id='$id'
                AND id_vendedor='$_SESSION[compraventaIdUsuario]'";
            $result = $db->query($consulta);
            if (!$result) {
                print "<p>Error en la consulta.</p>\n";
            } else {
                $valor = $result->fetch();
                print "<form action=\"ven_modificar3.php\" method=\"get\">
      <p>Modifique los campos que desee:</p>
      <table>
        <tbody>
          <tr>
            <td>Artículo:</td>
            <td><input type=\"text\" name=\"articulo\" size=\"$tamArticulo\" "
                    . "value=\"$valor[articulo]\" id=\"cursor\" /></td>
          </tr>
          <tr>
            <td>Precio:</td>
            <td><input type=\"text\" name=\"precio\" size=\"$tamPrecio\" "
                    . "value=\"$valor[precio]\" /></td>
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
}
?>
