<?php
/**
 * Foro - hil-insertar-1.php
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

$hilo = recogeParaConsulta($db, "hilo");

$consulta = "SELECT COUNT(*) FROM $dbDiscusiones
    WHERE id=$hilo";
$result = $db->query($consulta);
if (!$result) {
    cabecera("Discusiones - Intervenir en discusión 1", "menuHilos", $hilo);
    print "    <p>Error en la consulta.</p>\n";
    print "\n";
} elseif ($result->fetchColumn() == 0) {
    cabecera("Discusiones - Intervenir en discusión 1", "menuHilos", $hilo);
    print "    <p>La discusión solicitada no existe.</p>\n";
    print "\n";
} else {
    $consulta = "SELECT COUNT(*) FROM $dbIntervenciones
        WHERE id_discusion=$hilo";
    $result = $db->query($consulta);
    if (!$result) {
        cabecera("Discusiones - Intervenir en discusión 1", "menuHilos", $hilo);
        print "    <p>Error en la consulta.</p>\n";
        print "\n";
    } elseif ($result->fetchColumn() >= MAX_REG_INTERVENCIONES) {
        cabecera("Discusiones - Intervenir en discusión 1", "menuHilos", $hilo);
        print "    <p>Se ha alcanzado el número máximo de intervenciones que se pueden guardar.</p>\n";
        print "\n";
        print "    <p>Por favor, borre alguna intervención antes.</p>\n";
        print "\n";
    } else {
        cabecera("Discusiones - Intervenir en discusión 1", "menuHilos", $hilo);
        print "    <form action=\"hil-insertar-2.php\" method=\"" . FORM_METHOD . "\">\n";
        print "      <table>\n";
        print "        <tr>\n";
        print "          <td>Autor:</td>\n";
        print "          <td><input type=\"text\" name=\"autor\" size=\"" . TAM_AUTOR . "\" "
            . "maxlength=\"" . TAM_AUTOR . "\" autofocus></td>\n";
        print "        </tr>\n";
        print "        <tr>\n";
        print "          <td style=\"vertical-align:top\">Texto:</td>\n";
        print "          <td><textarea rows=\"10\" cols=\"40\" name=\"intervencion\"></textarea></td>\n";
        print "        </tr>\n";
        print "      </table>\n";
        print "\n";
        print "      <p>\n";
        print "        <input type=\"submit\" value=\"Añadir\">\n";
        print "        <input type=\"hidden\" name=\"hilo\" value=\"$hilo\">\n";
        print "      </p>\n";
        print "    </form>\n";
        print "\n";
    }
}

$db = NULL;
pie();
?>
