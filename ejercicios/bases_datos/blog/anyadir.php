<?php
/**
 * Blog - anyadir.php
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

$fecha = recogeFecha($db, 'fecha');
$entrada = recogeParaConsulta($db, 'entrada');

cabecera('Añadir', CABECERA_SIN_CURSOR, $fecha);

if (($fecha=="''") || ($entrada=="''")) {
    print "<p>Hay que escribir algo en la entrada. "
        ."No se ha guardado el registro.</p>\n";
} else {
    $consulta = "SELECT COUNT(*) FROM $dbEntradas";
    $result = $db->query($consulta);
    if (!$result) {
        print "<p>Error en la consulta.</p>\n";
    } elseif ($result->fetchColumn()>=MAX_REG_ENTRADAS) {
        print "<p>Se ha alcanzado el número máximo de registros que se pueden "
            ."guardar.</p>\n<p>Por favor, borre algún registro antes.</p>\n";
    } else { 
        $consulta = "SELECT COUNT(*) FROM $dbEntradas 
            WHERE fecha='$fecha'";
        $result = $db->query($consulta);
        if (!$result) {
            print "<p>Error en la consulta.</p>\n";
        } elseif ($result->fetchColumn()==0) {
            $consulta = "INSERT INTO $dbEntradas 
                VALUES (NULL, '$fecha', $entrada)";
            if ($db->query($consulta)) {
                print "<p>Registro creado correctamente.</p>\n";
            } else {
                print "<p>Error al crear el registro.<p>\n";
            }
        } else { 
            $consulta = "UPDATE $dbEntradas 
                SET entrada=$entrada 
                WHERE fecha='$fecha'";
           if ($db->query($consulta)) {
                print "<p>Registro creado correctamente.</p>\n";
            } else {
                print "<p>Error al crear el registro.<p>\n";
            }
        }
    }
}

$db = NULL; 
pie();
?>
