<?php
/**
 * Foro - hil-index.php
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

include ('funciones.php');
$db = conectaDb();

$hilo = recogeParaConsulta($db, 'hilo');

cabecera("Discusiones", CABECERA_SIN_CURSOR, 'menuHilos', $hilo);

$consulta = "SELECT COUNT(*) FROM $dbDiscusiones WHERE id=$hilo";
$result = $db->query($consulta);
if (!$result) {
    print "<p>Error en la consulta.</p>\n";
} elseif ($result->fetchColumn() == 0) {
    print "<p>La discusión solicitada no existe.</p>\n";
} else {
    $consulta = "SELECT * FROM $dbDiscusiones
        WHERE id=$hilo";
    $result = $db->query($consulta);
    if (!$result) {
        print "<p>Error en la consulta.</p>\n";
    } else {
        $valor = $result->fetch();
        print "<div class=\"discu\">
  <h2>$valor[titulo]</h2>
  <p class=\"dis_aut\">Propuesta por <strong>$valor[autor]</strong> el "
            .fechaDma($valor['fecha']).".</p>
  <p>$valor[descripcion]</p>\n";
        $consulta = "SELECT COUNT(*) FROM $dbIntervenciones
            WHERE id_discusion=$hilo";
        $result = $db->query($consulta);
        if (!$result) {
            print "<p>Error en la consulta.</p>\n";
        } else {
            $numInt = $result->fetchColumn();
            if ($numInt) {
                $consulta = "SELECT * FROM $dbIntervenciones
                    WHERE id_discusion=$hilo ORDER BY fecha ASC";
                $result = $db->query($consulta);
                if (!$result) {
                    print "<p>Error en la consulta.</p>\n";
                } else {
                    foreach ($result as $valor) {
                        print "  <p class=\"int_aut\"><strong>$valor[autor]</strong> "
                            . "ha dicho el ".fechaDma($valor['fecha'])
                            . ":</p>\n  <p>$valor[intervencion]</p>\n";
                    }
                }
            }
        }
        print "</div>\n";
    }
}

$db = NULL;
pie();
?>
