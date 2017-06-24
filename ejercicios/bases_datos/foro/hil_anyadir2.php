<?php
/**
 * Foro - dis_anyadir2.php
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

date_default_timezone_set(ZONA_HORARIA); 

$autor        = recogeParaConsulta($db, 'autor',        ANONIMO_AUTOR);
$intervencion = recogeParaConsulta($db, 'intervencion', ANONIMO_INTERVENCION);
$hilo         = recogeParaConsulta($db, 'hilo',         '');
$fecha        = date("Y-m-d H:i:s");

cabecera('Discusiones - Intervenir en discusión 2', CABECERA_SIN_CURSOR, 'menuHilos', $hilo);

if (($autor=="'".ANONIMO_AUTOR."'") && ($intervencion=="'".ANONIMO_INTERVENCION."'")) {
    print "<p>Hay que rellenar al menos uno de los campos.</p>\n";
} else {
    $consulta = "SELECT COUNT(*) FROM $dbDiscusiones 
        WHERE id=$hilo";
    $result = $db->query($consulta);
    if (!$result) {
        print "<p>Error en la consulta.</p>\n";
    } elseif ($result->fetchColumn()==0) {
        print "<p>La discusión solicitada no existe.</p>\n";
    } else {
        $consulta = "SELECT COUNT(*) FROM $dbIntervenciones 
            WHERE id_discusion=$hilo";
        $result = $db->query($consulta);
        if (!$result) {
            print "<p>Error en la consulta.</p>\n";
        } elseif ($result->fetchColumn()>=MAX_REG_INTERVENCIONES) {
            print "<p>Se ha alcanzado el número máximo de intervenciones que se pueden "
                ."guardar.</p>\n<p>Por favor, borre alguna intervención antes.</p>\n";
        } else { 
            $consulta = "SELECT COUNT(*) FROM $dbIntervenciones 
                WHERE id_discusion=$hilo 
                AND autor=$autor 
                AND intervencion=$intervencion";
            $result = $db->query($consulta);
            if (!$result) {
                print "<p>Error en la consulta.</p>\n";
            } elseif ($result->fetchColumn()!=0) {
                print "<p>Ya existe una intervención con ese autor y texto.</p>\n";
            } else { 
                $consulta = "INSERT INTO $dbIntervenciones
                    VALUES (NULL, $hilo, $autor, '$fecha', $intervencion)";
                if ($db->query($consulta)) {
                    print "<p>Registro creado correctamente.</p>\n";
                } else {
                    print "<p>Error al crear el registro.<p>\n";
                }
            }
        }
    }
}

$db = NULL;
pie();
?>
