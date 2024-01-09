<?php
/**
 * Foro - edi_borrardinte2.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2009 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2009-05-21
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

include "biblioteca.php";
$db = conectaDb();
cabecera("Editor - Borrar intervenciones 2", "menuEditor", "");

$id    = recogeParaConsulta($db, "id");
$campo = recogeParaConsulta($db, "campo", "fecha");
$campo = quitaComillasExteriores($campo);
$orden = recogeParaConsulta($db, "orden", "ASC");
$orden = quitaComillasExteriores($orden);

if ($id == "") {
    print "    <p>No se ha marcado nada para borrar.</p>\n";
    print "\n";
} else {
    $consulta = "SELECT COUNT(*) FROM $dbDiscusiones
        WHERE id=$id";
    $result = $db->query($consulta);
    if (!$result) {
        print "    <p>Error en la consulta.</p>\n";
        print "\n";
    } elseif ($result->fetchColumn() == 0) {
        print "    <p>La discusión solicitada no existe.</p>\n";
        print "\n";
    } else {
        $consulta = "SELECT * FROM $dbDiscusiones
            WHERE id=$id";
        $result = $db->query($consulta);
        if (!$result) {
           print "    <p>Error en la consulta</p>\n";
           print "\n";
        } else {
            $valor = $result->fetch();
            $consulta = "SELECT COUNT(*) FROM $dbIntervenciones
                WHERE id_discusion=$id";
            $result = $db->query($consulta);
            if (!$result) {
                print "    <p>Error en la consulta.</p>\n";
                print "\n";
            } elseif ($result->fetchColumn() == 0) {
                print "    <p>No hay intervenciones en la discusión elegida.</p>\n";
                print "\n";
            } else {
                $consulta = "SELECT * FROM $dbIntervenciones
                    WHERE id_discusion=$id";
                $result = $db->query($consulta);
                if (!$result) {
                    print "    <p>Error en la consulta.</p>\n";
                    print "\n";
                } else {
                    print "    <form action=\"edi-borrar-inte-3.php\" method=\"" . FORM_METHOD . "\">\n";
                    print "      <p>Marque las intervenciones que quiera borrar.</p>\n";
                    print "\n";
                    print "      <table border=\"1\">\n";
                    print "        <thead>\n";
                    print "          <tr class=\"neg\">\n";
                    print "            <th>Borrar</th>\n";
                    print "            <th>\n";
                    print "              <a href=\"$_SERVER[PHP_SELF]?campo=autor&amp;orden=ASC\">"
                        . "<img src=\"abajo.png\" alt=\"A-Z\" title=\"A-Z\"></a>\n";
                    print "              Autor\n";
                    print "              <a href=\"$_SERVER[PHP_SELF]?campo=autor&amp;orden=DESC\">"
                        . "<img src=\"arriba.png\" alt=\"Z-A\" title=\"Z-A\"></a>\n";
                    print "            </th>\n";
                    print "            <th>\n";
                    print "              <a href=\"$_SERVER[PHP_SELF]?campo=fecha&amp;orden=ASC\">"
                        . "<img src=\"abajo.png\" alt=\"A-Z\" title=\"A-Z\"></a>\n";
                    print "              Fecha\n";
                    print "              <a href=\"$_SERVER[PHP_SELF]?campo=fecha&amp;orden=DESC\">"
                        . "<img src=\"arriba.png\" alt=\"Z-A\" title=\"Z-A\"></a>\n";
                    print "            </th>\n";
                    print "            <th>\n";
                    print "              <a href=\"$_SERVER[PHP_SELF]?campo=intervencion&amp;orden=ASC\">"
                        . "<img src=\"abajo.png\" alt=\"A-Z\" title=\"A-Z\"></a>\n";
                    print "              Texto\n";
                    print "              <a href=\"$_SERVER[PHP_SELF]?campo=intervencion&amp;orden=DESC\">"
                        . "<img src=\"arriba.png\" alt=\"Z-A\" title=\"Z-A\"></a>\n";
                    print "            </th>\n";
                    print "          </tr>\n";
                    print "        </thead>\n";
                    $tmp = true;
                    foreach ($result as $valor) {
                        if ($tmp) {
                            print "        <tr>\n";
                        } else {
                            print "        <tr class=\"neg\">\n";
                        }
                        $tmp = !$tmp;
                        print "          <td align=\"center\"><input "
                            . " type=\"checkbox\" name=\"id[$valor[id]]\"></td>\n";
                        print "          <td>$valor[autor]</td>\n";
                        print "          <td>" . fechaDma($valor["fecha"]) . "</td>\n";
                        print "          <td>$valor[intervencion]</td>\n";
                        print "        </tr>\n";
                    }
                    print "      </table>\n";
                    print "\n";
                    print "      <p><input type=\"submit\" value=\"Borrar\"></p>\n";
                    print "    </form>\n";
                    print "\n";
                }
            }
        }
    }
}

pie();
