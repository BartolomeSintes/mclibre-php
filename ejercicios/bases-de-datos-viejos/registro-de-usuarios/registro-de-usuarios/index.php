<?php
/**
 * Registro usuarios - index.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2013 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2013-03-07
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

require_once "biblioteca.php";

$db = conectaDb();

$consulta = $consultaExisteTabla;
$result = $db->query($consulta);
if (!$result) {
    cabecera("Primera conexión", MENU_PRINCIPAL);
    print "    <p>Error en la consulta.</p>\n";
    print "\n";
} elseif ($result->fetchColumn() == 0) {
    cabecera("Primera conexión", MENU_PRINCIPAL);
    print "    <p>Aparentemente, la base de datos no existe. Se creará a continuación.</p>";
    print "\n";
    if ($dbMotor == MYSQL) {
        borraTodoMySQL($db);
    } elseif ($dbMotor == SQLITE) {
        borraTodoSqlite($db);
    }
} else {
    session_start();
    if (isset($_SESSION["multiagendaUsuario"])) {
        cabecera("Inicio", $_SESSION["multiagendaUsuario"]);
    } else {
        cabecera("Identificación 1", MENU_PRINCIPAL);
        $aviso = recoge("aviso");
        if ($aviso) {
            print "    <p style=\"color: red\">$aviso</p>\n";
            print "\n";
        }
        print "    <form action=\"validar-1.php\" method=\"" . FORM_METHOD . "\">\n";
        print "      <p>Escriba su nombre de usuario y contraseña:</p>\n";
        print "\n";
        print "      <table>\n";
        print "        <tbody>\n";
        print "          <tr>\n";
        print "            <td>Nombre:</td>\n";
        print "            <td><input type=\"text\" name=\"usuario\" size=\"$tamUsuario\" "
            . "maxlength=\"$tamUsuario\" autofocus></td>\n";
        print "          </tr>\n";
        print "          <tr>\n";
        print "            <td>Contraseña:</td>\n";
        print "            <td><input type=\"password\" name=\"password\" size=\"$tamPassword\" "
            . "maxlength=\"$tamPassword\"></td>\n";
        print "          </tr>\n";
        print "        </tbody>\n";
        print "      </table>\n";
        print "\n";
        print "      <p><input type=\"submit\" value=\"Añadir\"></p>\n";
        print "\n";
        print "      <p><strong>Nota</strong>: Si no está ya registrado, le registraré como nuevo usuario.</p>\n";
        print "    </form>\n";
        print "\n";
    }
}
$db = null;
pie();
?>
