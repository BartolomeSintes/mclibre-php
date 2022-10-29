<?php
/**
 * Agenda - buscar-2.php
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
cabecera("Buscar 2");

$campo     = recogeParaConsulta($db, "campo", "apellidos");
$campo     = quitaComillasExteriores($campo);
$orden     = recogeParaConsulta($db, "orden", "ASC");
$orden     = quitaComillasExteriores($orden);
$nombre    = recogeParaConsulta($db, "nombre");
$nombre    = quitaComillasExteriores($nombre);
$apellidos = recogeParaConsulta($db, "apellidos");
$apellidos = quitaComillasExteriores($apellidos);
$telefono  = recogeParaConsulta($db, "telefono");
$telefono  = quitaComillasExteriores($telefono);
$correo    = recogeParaConsulta($db, "correo");
$correo    = quitaComillasExteriores($correo);

$consulta = "SELECT COUNT(*) FROM $dbAgenda
    WHERE nombre LIKE '%$nombre%'
    AND apellidos LIKE '%$apellidos%'
    AND telefono LIKE '%$telefono%'
    AND correo LIKE '%$correo%'";
$result = $db->query($consulta);
if (!$result) {
    print "    <p>Error en la consulta.</p>\n";
    print "
";
} elseif ($result->fetchColumn() == 0) {
    print "    <p>No se han encontrado registros.</p>\n";
    print "
";
} else {
    $consulta = "SELECT * FROM $dbAgenda
        WHERE nombre LIKE '%$nombre%'
        AND apellidos LIKE '%$apellidos%'
        AND telefono LIKE '%$telefono%'
        AND correo LIKE '%$correo%'
        ORDER BY $campo $orden";
    $result = $db->query($consulta);
    if (!$result) {
        print "    <p>Error en la consulta.</p>\n";
        print "
";
    } else {
        $datos = "nombre=$nombre&amp;apellidos=$apellidos&amp;"
            . "telefono=$telefono&amp;correo=$correo&amp;campo";
            print "    <p>Registros encontrados:</p>\n";
            print "\n";
            print "    <table border=\"1\">\n";
            print "      <thead>\n";
            print "        <tr class=\"neg\">\n";
            print "          <th>\n";
            print "            <a href=\"buscar-2.php?$datos=nombre&amp;orden=ASC\">"
                . "<img src=\"abajo.png\" alt=\"A-Z\" title=\"A-Z\"></a>\n";
            print "            Nombre\n";
            print "            <a href=\"buscar-2.php?$datos=nombre&amp;orden=DESC\">"
                . "<img src=\"arriba.png\" alt=\"Z-A\" title=\"Z-A\"></a>\n";
            print "          </th>\n";
            print "          <th>\n";
            print "            <a href=\"buscar-2.php?$datos=apellidos&amp;orden=ASC\">"
                . "<img src=\"abajo.png\" alt=\"A-Z\" title=\"A-Z\"></a>\n";
            print "            Apellidos\n";
            print "            <a href=\"buscar-2.php?$datos=apellidos&amp;orden=DESC\">"
                . "<img src=\"arriba.png\" alt=\"Z-A\" title=\"Z-A\"></a>\n";
            print "          </th>\n";
            print "          <th>\n";
            print "            <a href=\"buscar-2.php?$datos=telefono&amp;orden=ASC\">"
                . "<img src=\"abajo.png\" alt=\"0-9\" title=\"0-9\"></a>\n";
            print "            Teléfono\n";
            print "            <a href=\"buscar-2.php?$datos=telefono&amp;orden=DESC\">"
                . "<img src=\"arriba.png\" alt=\"9-0\" title=\"9-0\"></a>\n";
            print "          </th>\n";
            print "          <th>\n";
            print "            <a href=\"buscar-2.php?$datos=correo&amp;orden=ASC\">"
                . "<img src=\"abajo.png\" alt=\"A-Z\" title=\"A-Z\"></a>\n";
            print "            Correo\n";
            print "            <a href=\"buscar-2.php?$datos=correo&amp;orden=DESC\">"
                . "<img src=\"arriba.png\" alt=\"Z-A\" title=\"Z-A\"></a>\n";
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
            print "        <td>$valor[nombre]</td>\n";
            print "        <td>$valor[apellidos]</td>\n";
            print "        <td>$valor[telefono]</td>\n";
            print "        <td>$valor[correo]</td>\n";
            print "      </tr>\n";
        }
        print "    </table>\n";
        print "\n";
    }
}

$db = NULL;
pie();
?>
