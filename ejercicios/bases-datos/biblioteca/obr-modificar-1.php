<?php
/**
 * Biblioteca - obr-modificar-1.php
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
cabecera('Obras - Modificar 1', CABECERA_SIN_CURSOR, 'menuObras');

$campo = recogeParaConsulta($db, 'campo', 'autor');
$campo = quitaComillasExteriores($campo);
$orden = recogeParaConsulta($db, 'orden', 'ASC');
$orden = quitaComillasExteriores($orden);

$consulta = "SELECT COUNT(*) FROM $dbObras";
$result = $db->query($consulta);
if (!$result) {
    print "<p>Error en la consulta.</p>\n";
} elseif ($result->fetchColumn() == 0) {
    print "<p>No se ha creado todavía ningún registro.</p>\n";
} else {
    $consulta = "SELECT * FROM $dbObras ORDER BY $campo $orden";
    $result = $db->query($consulta);
    if (!$result) {
        print "<p>Error en la consulta.</p>\n";
    } else {
        print "<form action=\"obr-modificar-2.php\" method=\"" . FORM_METHOD . "\">
  <p>Indique el registro que quiera modificar:</p>
  <table border=\"1\">
    <thead>
      <tr class=\"neg\">
        <th>Modificar</th>
        <th><a href=\"$_SERVER[PHP_SELF]?campo=autor&amp;orden=ASC\">
          <img src=\"abajo.png\" alt=\"A-Z\" title=\"A-Z\" /></a>
          Autor
          <a href=\"$_SERVER[PHP_SELF]?campo=autor&amp;orden=DESC\">
          <img src=\"arriba.png\" alt=\"Z-A\" title=\"Z-A\" /></a></th>
        <th><a href=\"$_SERVER[PHP_SELF]?campo=titulo&amp;orden=ASC\">
          <img src=\"abajo.png\" alt=\"A-Z\" title=\"A-Z\" /></a>
          Título
          <a href=\"$_SERVER[PHP_SELF]?campo=titulo&amp;orden=DESC\">
          <img src=\"arriba.png\" alt=\"Z-A\" title=\"Z-A\" /></a></th>
        <th><a href=\"$_SERVER[PHP_SELF]?campo=editorial&amp;orden=ASC\">
          <img src=\"abajo.png\" alt=\"0-9\" title=\"0-9\" /></a>
          Editorial
          <a href=\"$_SERVER[PHP_SELF]?campo=editorial&amp;orden=DESC\">
          <img src=\"arriba.png\" alt=\"9-0\" title=\"9-0\" /></a></th>
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
        <td>$valor[autor]</td>
        <td>$valor[titulo]</td>
        <td>$valor[editorial]</td>\n      </tr>\n";
        }
        print "    </tbody>\n  </table>
  <p><input type=\"submit\" value=\"Modificar\" /></p>\n</form>\n";
    }
}

$db = NULL;
pie();
?>
