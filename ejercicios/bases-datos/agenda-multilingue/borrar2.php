<?php
/**
 * Poliagenda -  borrar2.php
 *
 * @author    Bartolom� Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2008 Bartolom� Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2008-03-02
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
if (!isset($_SESSION['multiagendaUsuario'])) {
    header('Location:index.php');
    exit();
} else {
    include('funciones.php');
    $db = conectaDb();
    cabecera(_('Borrar').' 2', $_SESSION['multiagendaUsuario']);

    $id = recogeMatrizParaConsulta($db, 'id');

    if (count($id)==0) {
      print "<p>"._('No se ha marcado nada para borrar').".</p>\n";
    } else {
        foreach ($id as $indice => $valor) {
            $consulta = "DELETE FROM $dbAgenda
                WHERE id=$indice";
            if ($db->query($consulta)) {
                print "<p>"._('Registro borrado correctamente').".</p>\n";
            } else {
                print "<p>"._('Error al borrar el registro').".</p>\n";
            }
        }
    }

    $db = NULL;
    pie();
}
?>
