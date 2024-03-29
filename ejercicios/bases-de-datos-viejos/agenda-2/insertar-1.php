<?php
/**
 * Agenda multiusuario -  insertar-1.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2009 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2009-05-21
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

include "biblioteca.php";
session_start();

if (!isset($_SESSION["multiagendaUsuario"])) {
    header("Location:index.php");
    exit;
} else {
    $db = conectaDb();
    $consulta = "SELECT COUNT(*) FROM $dbAgenda";
    $result = $db->query($consulta);
    if (!$result) {
        cabecera("Añadir 1", $_SESSION["multiagendaUsuario"]);
        print "    <p>Error en la consulta.</p>\n";
        print "\n";
    } elseif ($result->fetchColumn() >= MAX_REG_AGENDA) {
        cabecera("Añadir 1", $_SESSION["multiagendaUsuario"]);
        print "    <p>Se ha alcanzado el número máximo de registros que se pueden guardar.</p>\n";
        print "\n";
        print "    <p>Por favor, borre algún registro antes.</p>\n";
        print "\n";
    } else {
        cabecera("Añadir 1", $_SESSION["multiagendaUsuario"]);
        print "    <form action=\"insertar-2.php\" method=\"" . FORM_METHOD . "\">\n";
        print "      <p>Escriba los datos del nuevo registro:</p>\n";
        print "\n";
        print "      <table>\n";
        print "        <tr>\n";
        print "          <td>Nombre:</td>\n";
        print "          <td><input type=\"text\" name=\"nombre\" size=\"" . TAM_NOMBRE . "\" "
            . "maxlength=\"" . TAM_NOMBRE . "\" autofocus></td>\n";
        print "        </tr>\n";
        print "        <tr>\n";
        print "          <td>Apellidos:</td>\n";
        print "          <td><input type=\"text\" name=\"apellidos\" size=\"" . TAM_APELLIDOS . "\" "
            . "maxlength=\"" . TAM_APELLIDOS . "\"></td>\n";
        print "        </tr>\n";
        print "        <tr>\n";
        print "          <td>Teléfono:</td>\n";
        print "          <td><input type=\"text\" name=\"telefono\" size=\"" . TAM_TELEFONO . "\" "
            . "maxlength=\"" . TAM_TELEFONO . "\"></td>\n";
        print "        </tr>\n";
        print "        <tr>\n";
        print "          <td>Correo:</td>\n";
        print "          <td><input type=\"text\" name=\"correo\" size=\"" . TAM_CORREO . "\" "
            . "maxlength=\"" . TAM_CORREO . "\"></td>\n";
        print "        </tr>\n";
        print "      </table>\n";
        print "\n";
        print "      <p><input type=\"submit\" value=\"Añadir\"></p>\n";
        print "    </form>\n";
        print "\n";
    }
        pie();
}
?>
