<?php
/**
 * Poliagenda -  borrar-todo-1.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2008 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2008-03-02
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

session_start();
include "biblioteca.php";

if (!isset($_SESSION["multiagendaUsuario"]) || ($_SESSION["multiagendaUsuario"] != $administradorNombre)) {
    header("Location:index.php");
    exit;
} else {
    cabecera(_("Borrar todo") . " 1", $_SESSION["multiagendaUsuario"]);

    print "    <form action=\"borrar-todo-2.php\" method=\"get\">\n";
    print "      <p>" . _("¿Está seguro?") . "</p>\n";
    print "\n";
    print "      <p>\n";
    print "        <input type=\"submit\" value=\"" . _("Sí") . "\" name=\"si\">\n";
    print "        <input type=\"submit\" value=\"" . _("No") . "\" name=\"no\">\n";
    print "      </p>\n";
    print "    </form>\n";
    print "\n";

    pie();
}
?>
