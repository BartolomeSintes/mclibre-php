<?php
/**
 * Compraventa - modificar1.php
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
    cabecera('Venta - Modificar 1', 'venta');

    $campo = recogeParaConsulta($db, 'campo', 'articulo');
    $campo = quitaComillasExteriores($campo);
    $orden = recogeParaConsulta($db, 'orden', 'ASC');
    $orden = quitaComillasExteriores($orden);

    $consulta = "SELECT COUNT(*) FROM $dbArticulos
         WHERE id_vendedor='$_SESSION[compraventaIdUsuario]'";
    $result = $db->query($consulta);
    if (!$result) {
        print "<p>Error en la consulta.</p>\n";
    } elseif ($result->fetchColumn() == 0) {
        print "<p>No se ha creado todavía ningún registro.</p>\n";
    } else {
        $consulta = "SELECT * FROM $dbArticulos
            WHERE id_vendedor='$_SESSION[compraventaIdUsuario]'
            ORDER BY $campo $orden";
        $result = $db->query($consulta);
        if (!$result) {
            print "<p>Error en la consulta.</p>\n";
        } else {
            print "<form action=\"ven_modificar2.php\" method=\"get\">
  <p>Marque los artículos que desee reservar:</p>\n
  <table border=\"1\">
    <thead>
      <tr class=\"neg\">
        <th>Modificar</th>
        <th><a href=\"$_SERVER[PHP_SELF]?campo=articulo&amp;orden=ASC\">
          <img src=\"abajo.png\" alt=\"A-Z\" title=\"A-Z\" /></a>
          Artículo
          <a href=\"$_SERVER[PHP_SELF]?campo=articulo&amp;orden=DESC\">
          <img src=\"arriba.png\" alt=\"Z-A\" title=\"Z-A\" /></a></th>
        <th><a href=\"$_SERVER[PHP_SELF]?campo=precio&amp;orden=ASC\">
          <img src=\"abajo.png\" alt=\"A-Z\" title=\"A-Z\" /></a>
          Precio
          <a href=\"$_SERVER[PHP_SELF]?campo=precio&amp;orden=DESC\">
          <img src=\"arriba.png\" alt=\"Z-A\" title=\"Z-A\" /></a></th>
      </tr>
    </thead>
    <tbody>\n";
        $tmp = true;
        foreach ($result as $valor) {
            if ($tmp) {
                print "      <tr>\n";
            } else {
                print "      <tr class=\"neg\">\n";
            }
            $tmp = !$tmp;
            print "        <td align=\"center\"><input type=\"radio\" "
                . "name=\"id\" value=\"$valor[id]\" /></td>
        <td>$valor[articulo]</td>
        <td>$valor[precio] &euro;</td>\n      </tr>\n";
        }
            print "    </tbody>\n  </table>
      <p><input type=\"submit\" value=\"Borrar\" /></p>
    </form>\n";
       }
    }

    $db = NULL;
    pie();
}
?>
