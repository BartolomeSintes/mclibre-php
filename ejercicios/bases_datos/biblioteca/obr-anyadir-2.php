<?php
/**
 * Biblioteca - obr_anyadir2.php
 *
 * @author    Bartolom� Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2009 Bartolom� Sintes Marco
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
cabecera('Obras - A�adir 2', CABECERA_SIN_CURSOR, 'menuObras');

$autor     = recogeParaConsulta($db, 'autor');
$titulo    = recogeParaConsulta($db, 'titulo');
$editorial = recogeParaConsulta($db, 'editorial');

if (($autor=="''") && ($titulo=="''") && ($editorial=="''")) {
    print "<p>Hay que rellenar al menos uno de los campos. "
        ."No se ha guardado el registro.</p>\n";
} else {
    $consulta = "SELECT COUNT(*) FROM $dbObras";
    $result = $db->query($consulta);
    if (!$result) {
        print "<p>Error en la consulta.</p>\n";
    } elseif ($result->fetchColumn()>=MAX_REG_OBRAS) {
        print "<p>Se ha alcanzado el n�mero m�ximo de registros que se pueden "
            ."guardar.</p>\n<p>Por favor, borre alg�n registro antes.</p>\n";
    } else {
        $consulta = "SELECT COUNT(*) FROM $dbObras
            WHERE autor=$autor
            AND titulo=$titulo
            AND editorial=$editorial";
        $result = $db->query($consulta);
        if (!$result) {
            print "<p>Error en la consulta.</p>\n";
        } elseif ($result->fetchColumn()!=0) {
            print "<p>El registro ya existe.</p>\n";
        } else {
            $consulta = "INSERT INTO $dbObras
                VALUES (NULL, $autor, $titulo, $editorial)";
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
