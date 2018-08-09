<?php
/**
 * Foro - edi_borrardinte2.php
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
cabecera('Editor - Borrar intervenciones 2', CABECERA_SIN_CURSOR, 'menuEditor', '');

$id    = recogeParaConsulta($db, 'id');
$campo = recogeParaConsulta($db, 'campo', 'fecha');
$campo = quitaComillasExteriores($campo);
$orden = recogeParaConsulta($db, 'orden', 'ASC');
$orden = quitaComillasExteriores($orden);

if ($id=='') {
  print "<p>No se ha marcado nada para borrar.</p>\n";
} else {
    $consulta = "SELECT COUNT(*) FROM $dbDiscusiones
        WHERE id=$id";
    $result = $db->query($consulta);
    if (!$result) {
        print "<p>Error en la consulta.</p>\n";
    } elseif ($result->fetchColumn() == 0) {
        print "<p>La discusión solicitada no existe.</p>\n";
    } else {
        $consulta = "SELECT * FROM $dbDiscusiones
            WHERE id=$id";
        $result = $db->query($consulta);
        if (!$result) {
           print "<p>Error en la consulta</p>\n";
        } else {
            $valor = $result->fetch();
            $consulta = "SELECT COUNT(*) FROM $dbIntervenciones
                WHERE id_discusion=$id";
            $result = $db->query($consulta);
            if (!$result) {
                print "<p>Error en la consulta.</p>\n";
            } elseif ($result->fetchColumn() == 0) {
                print "<p>No hay intervenciones en la discusión elegida.</p>\n";
            } else {
                $consulta = "SELECT * FROM $dbIntervenciones
                    WHERE id_discusion=$id";
                $result = $db->query($consulta);
                if (!$result) {
                    print "<p>Error en la consulta.</p>\n";
                } else {
                    print "<form action=\"edi-borrar-inte-3.php\" method=\"" . FORM_METHOD . "\">
  <p>Marque las intervenciones que quiera borrar.</p>\n";
                    print "<table border=\"1\">
    <thead>
      <tr class=\"neg\">
        <th>Borrar</th>
        <th><a href=\"$_SERVER[PHP_SELF]?campo=autor&amp;orden=ASC\">
          <img src=\"abajo.png\" alt=\"A-Z\" title=\"A-Z\" /></a>
          Autor
          <a href=\"$_SERVER[PHP_SELF]?campo=autor&amp;orden=DESC\">
          <img src=\"arriba.png\" alt=\"Z-A\" title=\"Z-A\" /></a></th>
        <th><a href=\"$_SERVER[PHP_SELF]?campo=fecha&amp;orden=ASC\">
          <img src=\"abajo.png\" alt=\"A-Z\" title=\"A-Z\" /></a>
          Fecha
          <a href=\"$_SERVER[PHP_SELF]?campo=fecha&amp;orden=DESC\">
          <img src=\"arriba.png\" alt=\"Z-A\" title=\"Z-A\" /></a></th>
        <th><a href=\"$_SERVER[PHP_SELF]?campo=intervencion&amp;orden=ASC\">
          <img src=\"abajo.png\" alt=\"A-Z\" title=\"A-Z\" /></a>
          Texto
          <a href=\"$_SERVER[PHP_SELF]?campo=intervencion&amp;orden=DESC\">
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
                        print "        <td align=\"center\"><input "
                            . " type=\"checkbox\" name=\"id[$valor[id]]\" /></td>
        <td>$valor[autor]</td>
        <td>".fechaDma($valor['fecha'])."</td>
        <td>$valor[intervencion]</td>
      </tr>\n";
                    }
                    print "    </tbody>\n  </table>
  <p><input type=\"submit\" value=\"Borrar\" /></p>
</form>\n";
                }
            }
        }
    }
}

$db = NULL;
pie();
?>
