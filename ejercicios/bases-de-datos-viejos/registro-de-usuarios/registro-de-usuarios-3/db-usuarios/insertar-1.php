<?php
/**
 * Registro de usuarios 3 - db-usuarios/insertar-1.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2019 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2019-05-07
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

require_once "../comunes/biblioteca.php";

if (!isset($_SESSION["id"]) || $_SESSION["nivel"] != NIVEL_3) {
    header("location:../index.php");
    exit();
}

$db = conectaDb();
cabecera("Tabla Usuarios - Añadir 1", MENU_TABLA_USUARIOS_WEB, 1);

$consulta = "SELECT COUNT(*) FROM $dbTablaUsuariosWeb";
$result = $db->query($consulta);
if (!$result) {
    print "    <p class=\"aviso\">Error en la consulta.</p>\n";
} elseif ($result->fetchColumn() >= MAX_REG_TABLA_USUARIOS_WEB) {
    print "    <p class=\"aviso\">Se ha alcanzado el número máximo de registros que se pueden guardar.</p>\n";
    print "    <p class=\"aviso\">Por favor, borre algún registro antes.</p>\n";
} else {
    print "    <form action=\"insertar-2.php\" method=\"" . FORM_METHOD . "\">\n";
    print "      <p>Escriba los datos del nuevo registro:</p>\n";
    print "\n";
    print "      <table>\n";
    print "        <tr>\n";
    print "          <td>Nombre de usuario:</td>\n";
    print "          <td><input type=\"text\" name=\"usuario\" size=\"$tamUsuariosWebUsuario\" maxlength=\"$tamUsuariosWebUsuario\" autofocus></td>\n";
    print "        </tr>\n";
    print "        <tr>\n";
    print "          <td>Contraseña:</td>\n";
    print "          <td><input type=\"text\" name=\"password\" size=\"$tamUsuariosWebPassword\" maxlength=\"$tamUsuariosWebPassword\"></td>\n";
    print "        </tr>\n";
    print "        <tr>\n";
    print "          <td>Nivel:</td>\n";
    print "          <td>\n";
    print "            <select name=\"nivel\">\n";
    foreach ($usuariosWebNiveles as $valor) {
        print "              <option value=\"$valor[1]\">$valor[0]</option>\n";
    }
    print "            </select>\n";
    print "          </td>\n";
    print "        </tr>\n";
    print "      </table>\n";
    print "\n";
    print "      <p>\n";
    print "        <input type=\"submit\" value=\"Añadir\">\n";
    print "        <input type=\"reset\" value=\"Reiniciar formulario\">\n";
    print "      </p>\n";
    print "    </form>\n";
}

$db = null;
pie();
