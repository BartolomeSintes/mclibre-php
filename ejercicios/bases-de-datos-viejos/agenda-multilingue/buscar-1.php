<?php
/**
 * Poliagenda -  buscar-1.php
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
if (!isset($_SESSION["multiagendaUsuario"])) {
    header("Location:index.php");
    exit;
} else {
    include "biblioteca.php";
    $db = conectaDb();
    cabecera(_("Buscar") . " 1", $_SESSION["multiagendaUsuario"]);

    $consulta = "SELECT COUNT(*) FROM $dbAgenda
        WHERE id_usuario='$_SESSION[multiagendaIdUsuario]'";
    $result = $db->query($consulta);
    if (!$result) {
        print "    <p>" . _("Error en la consulta") . ".</p>\n";
        print "\n";
    } elseif ($result->fetchColumn() == 0) {
        print "    <p>" . _("No se ha creado todavía ningún registro") . ".</p>\n";
        print "\n";
    } else {
        print "    <form action=\"buscar-2.php\" method=\"get\">\n";
        print "      <p>" . _("Escriba el criterio de búsqueda (caracteres o números)") . ":</p>\n";
        print "      <table>\n";
        print "        <tr>\n";
        print "          <td>" . _("Nombre") . ":</td>\n";
        print "          <td><input type=\"text\" name=\"nombre\" size=\"$tamNombre\" autofocus></td>\n";
        print "        </tr>\n";
        print "        <tr>\n";
        print "          <td>" . _("Apellidos") . ":</td>\n";
        print "          <td><input type=\"text\" name=\"apellidos\" size=\"$tamApellidos\"></td>\n";
        print "        </tr>\n";
        print "        <tr>\n";
        print "          <td>" . _("Teléfono") . ":</td>\n";
        print "          <td><input type=\"text\" name=\"telefono\" size=\"$tamTelefono\"></td>\n";
        print "        </tr>\n";
        print "        <tr>\n";
        print "          <td>" . _("Correo") . ":</td>\n";
        print "          <td><input type=\"text\" name=\"correo\" size=\"$tamCorreo\"></td>\n";
        print "        </tr>\n";
        print "      </table>\n";
        print "\n";
        print "      <p><input type=\"submit\" value=\"" . _("Buscar") . "\"></p>\n";
        print "    </form>\n";
        print "\n";
    }

        pie();
}
?>
