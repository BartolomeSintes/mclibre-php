<?php
/**
 * Citas - cit-borrar-2.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2008 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2008-06-06
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

session_start();
if (!isset($_SESSION["citasUsuario"])) {
    header("Location:index.php");
    exit();
} else {
    include "biblioteca.php";
    $db = conectaDb();
    cabecera("Citas - Borrar 2", "menu_citas");

    $id = recogeMatrizParaConsulta($db, "id");
    // FALTA VALIDAR LA MATRIZ
    foreach ($id as $indice => $valor) {
        $consulta = "DELETE FROM $dbCitas
            WHERE id=$indice";
        if ($db->query($consulta)) {
            print "    <p>Registro de Citas borrado correctamente.</p>\n";
            print "\n";
        } else {
            print "    <p>Error al borrar el registro de Citas.<p>\n";
            print "\n";
        }
        $consulta = "DELETE FROM $dbEtiCitas
            WHERE id_cita=$indice";
        if ($db->query($consulta)) {
            print "    <p>Registro de Etiquetas de Citas borrado correctamente.</p>\n";
            print "\n";
        } else {
            print "    <p>Error al borrar el registro de Etiquetas de Citas.<p>\n";
            print "\n";
        }
            }
    $db = NULL;
    pie();
}
?>
