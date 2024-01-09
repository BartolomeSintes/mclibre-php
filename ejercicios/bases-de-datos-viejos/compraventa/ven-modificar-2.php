<?php
/**
 * Compraventa - modificar-2.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2008 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2008-02-27
 * @link      https://www.mclibre.org
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
if (!isset($_SESSION["compraventaUsuario"])) {
    header("Location:index.php");
    exit;
} else {
    include "biblioteca.php";
    $db = conectaDb();
    cabecera("Modificar 2", "venta");

    $id = recogeParaConsulta($db, "id");

    if ($id == "''") {
        print "    <p>No se ha seleccionado ningún registro.</p>\n";
        print "\n";
    } else {
        $consulta = "SELECT COUNT(*) FROM $dbArticulos
            WHERE id='$id'
            AND id_vendedor='$_SESSION[compraventaIdUsuario]'";
        $result = $db->query($consulta);
        if (!$result) {
            print "    <p>Error en la consulta.</p>\n";
            print "\n";
        } elseif ($result->fetchColumn() == 0) {
            print "    <p>Registro no encontrado.</p>\n";
            print "\n";
        } else {
            $consulta = "SELECT * FROM $dbArticulos
                WHERE id='$id'
                AND id_vendedor='$_SESSION[compraventaIdUsuario]'";
            $result = $db->query($consulta);
            if (!$result) {
                print "    <p>Error en la consulta.</p>\n";
                print "\n";
            } else {
                $valor = $result->fetch();
                print "    <form action=\"ven-modificar-3.php\" method=\"get\">\n";
                print "      <p>Modifique los campos que desee:</p>\n";
                print "\n";
                print "      <table>\n";
                print "        <tr>\n";
                print "          <td>Artículo:</td>\n";
                print "          <td><input type=\"text\" name=\"articulo\" size=\"$tamArticulo\" "
                    . "value=\"$valor[articulo]\" autofocus></td>\n";
                print "        </tr>\n";
                print "        <tr>\n";
                print "          <td>Precio:</td>\n";
                print "          <td><input type=\"text\" name=\"precio\" size=\"$tamPrecio\" "
                    . "value=\"$valor[precio]\"></td>\n";
                print "        </tr>\n";
                print "      </table>\n";
                print "\n";
                print "      <p>\n";
                print "        <input type=\"hidden\" name=\"id\" value=\"$id\">\n";
                print "        <input type=\"submit\" value=\"Actualizar\">\n";
                print "      </p>\n";
                print "    </form>\n";
                print "\n";
            }
        }
    }

        pie();
}
?>
