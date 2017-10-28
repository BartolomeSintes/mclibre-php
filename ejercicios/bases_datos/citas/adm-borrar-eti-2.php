<?php
/**
 * Citas -  adm_borrareti2.php
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
include('funciones.php');

if (!isset($_SESSION['citasUsuario']) || ($_SESSION['citasUsuario']!=$administradorNombre)) {
    header('Location:index.php');
    exit();
} else {
    $db = conectaDb();
    cabecera('Borrar etiquetas 2', $_SESSION['citasUsuario']);

    $id = recogeMatrizParaConsulta($db, 'id');

    if (count($id)==0) {
      print "<p>No se ha marcado nada para borrar.</p>\n";
    } else {
        foreach ($id as $indice => $valor) {
            $consulta = "DELETE FROM $dbEtiquetas
                WHERE id=$indice";
            if ($db->query($consulta)) {
                print "<p>Etiqueta borrada correctamente.</p>\n";
            } else {
                print "<p>Error al borrar la etiqueta.</p>\n";
            }
            $consulta = "DELETE FROM $dbElegidas
                WHERE id_etiqueta=$indice";
            if ($db->query($consulta)) {
                print "<p>Elecciones borradas correctamente.</p>\n";
            } else {
                print "<p>Error al borrar las elecciones.</p>\n";
            }
        }
    }

    $db = NULL;
    pie();
}
?>
