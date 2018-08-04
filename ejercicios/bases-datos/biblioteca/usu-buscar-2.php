<?php
/**
 * Biblioteca - usu-buscar-2.php
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
cabecera('Usuarios - Buscar 2', CABECERA_SIN_CURSOR, 'menuUsuarios');

$campo     = recogeParaConsulta($db, 'campo', 'apellidos');
$campo     = quitaComillasExteriores($campo);
$orden     = recogeParaConsulta($db, 'orden', 'ASC');
$orden     = quitaComillasExteriores($orden);
$nombre    = recogeParaConsulta($db, 'nombre');
$nombre    = quitaComillasExteriores($nombre);
$apellidos = recogeParaConsulta($db, 'apellidos');
$apellidos = quitaComillasExteriores($apellidos);
$dni       = recogeParaConsulta($db, 'dni');
$dni       = quitaComillasExteriores($dni);

$consulta = "SELECT COUNT(*) FROM $dbUsuarios
    WHERE nombre LIKE '%$nombre%'
    AND apellidos LIKE '%$apellidos%'
    AND dni LIKE '%$dni%'";
$result = $db->query($consulta);
if (!$result) {
    print "<p>Error en la consulta.</p>\n";
} elseif ($result->fetchColumn()==0) {
    print "<p>No se han encontrado registros en la agenda.</p>\n";
} else {
    $consulta = "SELECT * FROM $dbUsuarios
        WHERE nombre LIKE '%$nombre%'
        AND apellidos LIKE '%$apellidos%'
        AND dni LIKE '%$dni%'
        ORDER BY $campo $orden";
    $result = $db->query($consulta);
    if (!$result) {
        print "<p>Error en la consulta.</p>\n";
    } else {
        $datos = "nombre=$nombre&amp;apellidos=$apellidos&amp;"
            . "dni=$dni&amp;campo";
        print "<p>Registros encontrados:</p>\n<table border=\"1\">
  <thead>
    <tr class=\"neg\">
      <th><a href=\"buscar2.php?$datos=nombre&amp;orden=ASC\">
        <img src=\"abajo.png\" alt=\"A-Z\" title=\"A-Z\" /></a>
        Nombre
        <a href=\"buscar2.php?$datos=nombre&amp;orden=DESC\">
        <img src=\"arriba.png\" alt=\"Z-A\" title=\"Z-A\" /></a></th>
      <th><a href=\"buscar2.php?$datos=apellidos&amp;orden=ASC\">
        <img src=\"abajo.png\" alt=\"A-Z\" title=\"A-Z\" /></a>
        Apellidos
        <a href=\"buscar2.php?$datos=apellidos&amp;orden=DESC\">
        <img src=\"arriba.png\" alt=\"Z-A\" title=\"Z-A\" /></a></th>
      <th><a href=\"buscar2.php?$datos=dni&amp;orden=ASC\">
        <img src=\"abajo.png\" alt=\"0-9\" title=\"0-9\" /></a>
        DNI
        <a href=\"buscar2.php?$datos=dni&amp;orden=DESC\">
        <img src=\"arriba.png\" alt=\"9-0\" title=\"9-0\" /></a></th>
    </tr>
  </thead>
  <tbody>\n";
        $tmp = TRUE;
        foreach ($result as $valor) {
            if ($tmp) {
                print "    <tr>\n";
            } else {
                print "    <tr class=\"neg\">\n";
            }
            $tmp = !$tmp;
            print "      <td>$valor[nombre]</td>
      <td>$valor[apellidos]</td>\n      <td>$valor[dni]</td>\n    </tr>\n";
        }
        print "  </tbody>\n</table>\n";
    }
}

$db = NULL;
pie();
?>
