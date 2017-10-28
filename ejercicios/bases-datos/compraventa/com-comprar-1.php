<?php
/**
 * Compraventa - com_comprar1.php
 *
 * @author    Bartolom� Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2008 Bartolom� Sintes Marco
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
    cabecera('Compra - Comprar 1', 'compra');

    $campo = recogeParaConsulta($db, 'campo', 'articulo');
    $campo = quitaComillasExteriores($campo);
    $orden = recogeParaConsulta($db, 'orden', 'ASC');
    $orden = quitaComillasExteriores($orden);

    $consulta = "SELECT COUNT(*) FROM $dbArticulos
        WHERE id_comprador='$_SESSION[compraventaIdUsuario]'
        AND reservado='TRUE'
        AND comprado='FALSE'";
    $result = $db->query($consulta);
    if (!$result) {
        print "<p>Error en la consulta.</p>\n";
    } elseif ($result->fetchColumn()==0) {
        print "<p>No hay ning�n art�culo reservado.</p>\n";
    } else {
        $consulta = "SELECT * FROM $dbArticulos
        WHERE id_comprador='$_SESSION[compraventaIdUsuario]'
        AND reservado='TRUE'
        AND comprado='FALSE'
        ORDER BY $campo $orden";
        $result = $db->query($consulta);
        if (!$result) {
            print "<p>Error en la consulta.</p>\n";
        } else {
            print "<form action=\"com_comprar2.php\" method=\"get\">
  <p>Estos son los art�culos reservados:</p>\n
  <table border=\"1\">
    <thead>
      <tr class=\"neg\">
        <th><a href=\"$_SERVER[PHP_SELF]?campo=articulo&amp;orden=ASC\">
          <img src=\"abajo.png\" alt=\"A-Z\" title=\"A-Z\" /></a>
          Art�culo
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
        $tmp = TRUE;
        foreach ($result as $valor) {
            if ($tmp) {
                print "      <tr>\n";
            } else {
                print "      <tr class=\"neg\">\n";
            }
            $tmp = !$tmp;
            print "        <td>$valor[articulo]</td>
        <td>$valor[precio] &euro;</td>\n      </tr>\n";
        }
            print "    </tbody>\n  </table>
      <p><input type=\"submit\" value=\"Comprar\" /></p>
    </form>\n";
       }
    }

    $db = NULL;
    pie();
}
?>
