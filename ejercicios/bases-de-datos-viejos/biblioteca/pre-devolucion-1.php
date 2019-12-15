<?php
/**
 * Biblioteca - pre-devolucion-1.php
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

date_default_timezone_set(ZONA_HORARIA);

$campo = recogeParaConsulta($db, "campo", "apellidos");
$campo = quitaComillasExteriores($campo);
$orden = recogeParaConsulta($db, "orden", "ASC");
$orden = quitaComillasExteriores($orden);

$consulta = "SELECT COUNT(*) FROM $dbPrestamos
    WHERE $dbPrestamos.devuelto='0000-00-00'";
$result = $db->query($consulta);
if (!$result) {
    cabecera("Préstamos - Devolución 1", "menuPrestamos");
    print "    <p>Error en la consulta.</p>\n";
    print "\n";
} elseif ($result->fetchColumn() == 0) {
    cabecera("Préstamos - Devolución 1", "menuPrestamos");
    print "    <p>No hay préstamos pendientes de devolución.</p>\n";
    print "\n";
} else {
    $consulta = "SELECT $dbPrestamos.id AS id, $dbUsuarios.nombre as nombre,
        $dbUsuarios.apellidos as apellidos, $dbObras.titulo as titulo,
        $dbPrestamos.prestado as prestado, $dbPrestamos.devuelto as devuelto
        FROM $dbPrestamos, $dbUsuarios, $dbObras
        WHERE $dbPrestamos.id_usuario=$dbUsuarios.id
        AND $dbPrestamos.id_obra=$dbObras.id
        AND $dbPrestamos.devuelto='0000-00-00'
        ORDER BY $campo $orden";
    $result = $db->query($consulta);
    if (!$result) {
        cabecera("Préstamos - Devolución 1", "menuPrestamos");
        print "    <p>Error en la consulta.</p>\n";
        print "\n";
    } else {
        cabecera("Préstamos - Devolución 1", "menuPrestamos");
        print "    <form action=\"pre-devolucion-2.php\" method=\"" . FORM_METHOD . "\">\n";
        print "      <p>Seleccione el préstamo pendiente e indique la fecha de devolución:</p>\n";
        print "\n";
        print "      <table border=\"1\">\n";
        print "        <thead>\n";
        print "          <tr class=\"neg\">\n";
        print "            <th>\n";
        print "              <a href=\"$_SERVER[PHP_SELF]?campo=apellidos&amp;orden=ASC\">"
            . "<img src=\"abajo.png\" alt=\"A-Z\" title=\"A-Z\"></a>\n";
        print "              Usuario\n";
        print "              <a href=\"$_SERVER[PHP_SELF]?campo=apellidos&amp;orden=DESC\">"
            . "<img src=\"arriba.png\" alt=\"Z-A\" title=\"Z-A\"></a>\n";
        print "              &nbsp; - &nbsp;\n";
        print "              <a href=\"$_SERVER[PHP_SELF]?campo=titulo&amp;orden=ASC\">"
            . "<img src=\"abajo.png\" alt=\"A-Z\" title=\"A-Z\"></a>\n";
        print "              Título\n";
        print "              <a href=\"$_SERVER[PHP_SELF]?campo=titulo&amp;orden=DESC\">"
            . "<img src=\"arriba.png\" alt=\"Z-A\" title=\"Z-A\"></a>\n";
        print "              &nbsp; - &nbsp;\n";
        print "              <a href=\"$_SERVER[PHP_SELF]?campo=prestado&amp;orden=ASC\">"
            . "<img src=\"abajo.png\" alt=\"0-9\" title=\"0-9\"></a>\n";
        print "              Fecha préstamo\n";
        print "              <a href=\"$_SERVER[PHP_SELF]?campo=prestado&amp;orden=DESC\">"
            . "<img src=\"arriba.png\" alt=\"9-0\" title=\"9-0\"></a>\n";
        print "            </th>\n";
        print "            <th>Fecha de devolución (dd-mm-aaaa)</th>\n";
        print "          </tr>\n";
        print "        </thead>\n";
        print "        <tbody>\n";
        print "          <tr>\n";
        print "            <td>\n";
        print "              <select name=\"id\">\n";
        foreach ($result as $valor) {
            print "                <option value=\"$valor[id]\">$valor[apellidos], "
                . "$valor[nombre] - $valor[titulo] - " . fechaDma($valor["prestado"])
                . "</option>\n";
        }
        print "              </select>\n";
        print "            </td>\n";
        print "            <td>\n";
        print "              <input type=\"text\" name=\"fecha\" size=\"" . TAM_FECHA . "\" "
            . "maxlength=\"" . TAM_FECHA . "\" value=\"" . date("d-m-Y") . "\" autofocus>\n";
        print "            </td>\n";
        print "          </tr>\n";
        print "        </tbody>\n";
        print "      </table>\n";
        print "\n";
        print "      <p><input type=\"submit\" value=\"Guardar devolución\"></p>\n";
        print "    </form>\n";
        print "    \n";
    }
}

$db = NULL;
pie();
?>
