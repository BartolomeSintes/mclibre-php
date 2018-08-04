<?php
/**
 * Multiagenda -  borrartodo1.php
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
session_start();

if (!isset($_SESSION['multiagendaUsuario']) || ($_SESSION['multiagendaUsuario']!=$administradorNombre)) {
    header('Location:index.php');
    exit();
} else {
    cabecera('Borrar todo 1', CABECERA_SIN_CURSOR, $_SESSION['multiagendaUsuario']);

    print "<form action=\"borrartodo2.php\" method=\"" . FORM_METHOD . "\">
  <p>¿Está seguro?</p>
  <p><input type=\"submit\" value=\"Sí\" name=\"si\" />
    <input type=\"submit\" value=\"No\" name=\"no\" /></p>
</form>\n";

    pie();
}
?>
