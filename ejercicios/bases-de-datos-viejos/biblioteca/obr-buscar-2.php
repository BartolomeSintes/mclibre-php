<?php
/**
 * Biblioteca - obr-buscar-2.php
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
cabecera("Obras - Buscar 2", "menuObras");

$campo      = recogeParaConsulta($db, "campo", "autor");
$campo      = quitaComillasExteriores($campo);
$orden      = recogeParaConsulta($db, "orden", "ASC");
$orden      = quitaComillasExteriores($orden);
$autor      = recogeParaConsulta($db, "autor");
$autor      = quitaComillasExteriores($autor);
$titulo     = recogeParaConsulta($db, "titulo");
$titulo     = quitaComillasExteriores($titulo);
$editorial  = recogeParaConsulta($db, "editorial");
$editorial  = quitaComillasExteriores($editorial);

$consulta = "SELECT COUNT(*) FROM $dbObras
    WHERE autor LIKE '%$autor%'
    AND titulo LIKE '%$titulo%'
    AND editorial LIKE '%$editorial%'";
$result = $db->query($consulta);
if (!$result) {
    print "    <p>Error en la consulta.</p>\n";
    print "\n";
} elseif ($result->fetchColumn() == 0) {
    print "    <p>No se han encontrado registros.</p>\n";
    print "\n";
} else {
    $consulta = "SELECT * FROM $dbObras
        WHERE autor LIKE '%$autor%'
        AND titulo LIKE '%$titulo%'
        AND editorial LIKE '%$editorial%'
        ORDER BY $campo $orden";
    $result = $db->query($consulta);
    if (!$result) {
        print "    <p>Error en la consulta.</p>\n";
        print "\n";
    } else {
        $datos = "autor=$autor&amp;titulo=$titulo&amp;"
            . "editorial=$editorial&amp;campo";
        print "    <p>Registros encontrados:</p>\n";
        print "\n";
        print "    <table border=\"1\">\n";
        print "      <thead>\n";
        print "        <tr class=\"neg\">\n";
        print "          <th>\n";
        print "            <a href=\"buscar-2.php?$datos=autor&amp;orden=ASC\">"
            . "<img src=\"abajo.png\" alt=\"A-Z\" title=\"A-Z\"></a>\n";
        print "            Autor\n";
        print "            <a href=\"buscar-2.php?$datos=autor&amp;orden=DESC\">"
            . "<img src=\"arriba.png\" alt=\"Z-A\" title=\"Z-A\"></a>\n";
        print "          </th>\n";
        print "          <th>\n";
        print "            <a href=\"buscar-2.php?$datos=titulo&amp;orden=ASC\">"
            . "<img src=\"abajo.png\" alt=\"A-Z\" title=\"A-Z\"></a>\n";
        print "            Título\n";
        print "            <a href=\"buscar-2.php?$datos=titulo&amp;orden=DESC\">"
            . "<img src=\"arriba.png\" alt=\"Z-A\" title=\"Z-A\"></a>\n";
        print "          </th>\n";
        print "          <th>\n";
        print "            <a href=\"buscar-2.php?$datos=editorial&amp;orden=ASC\">"
            . "<img src=\"abajo.png\" alt=\"0-9\" title=\"0-9\"></a>\n";
        print "            Editorial\n";
        print "            <a href=\"buscar-2.php?$datos=editorial&amp;orden=DESC\">"
            . "<img src=\"arriba.png\" alt=\"9-0\" title=\"9-0\"></a>\n";
        print "          </th>\n";
        print "        </tr>\n";
        print "      </thead>\n";
        $tmp = true;
        foreach ($result as $valor) {
            if ($tmp) {
                print "      <tr>\n";
            } else {
                print "      <tr class=\"neg\">\n";
            }
            $tmp = !$tmp;
            print "        <td>$valor[autor]</td>\n";
            print "        <td>$valor[titulo]</td>\n";
            print "        <td>$valor[editorial]</td>\n";
            print "      </tr>\n";
        }
        print "    </table>\n";
        print "\n";
    }
}

$db = NULL;
pie();
?>
