<?php
/**
 * Registro usuarios - validar-1.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2013 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2013-03-07
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

require_once "biblioteca.php";

$db = conectaDb();

$usuario  = recoge("usuario");
$password = recoge("password");

if (!$usuario|| ($usuario == MENU_PRINCIPAL)) {
    header("Location:index.php?aviso=Nombre de usuario no permitido");
    exit();
} else {
    $consulta = "SELECT COUNT(*) FROM $dbUsuarios
        WHERE usuario='$usuario'";
    $result = $db->query($consulta);
    if (!$result) {
        cabecera("Identificación 2", MENU_PRINCIPAL);
        print "    <p>Error en la consulta.</p>\n";
        print "\n";
    } elseif ($result->fetchColumn() == 0) {
        $consulta = "SELECT COUNT(*) FROM $dbUsuarios";
        $result = $db->query($consulta);
        if (!$result) {
            cabecera("Identificación 2", MENU_PRINCIPAL);
            print "    <p>Error en la consulta.</p>";
            print "\n";
        } elseif ($result->fetchColumn() >= MAX_REG_USUARIOS) {
            cabecera("Identificación 2", MENU_PRINCIPAL);
            print "    <p>Se ha alcanzado el número máximo de Usuarios que se pueden guardar.</p>\n";
            print "\n";
            print "    <p>Por favor, borre algún registro antes.</p>\n";
            print "\n";
        } else {
            cabecera("Identificación 2", MENU_PRINCIPAL);
            print "    <p><strong>$usuario</strong> es un nuevo usuario. Por favor, repita la contraseña para registrarse como usuario.</p>\n";
            print "\n";
            print "    <form action=\"validar-2.php\" method=\"" . FORM_METHOD . "\">\n";
            print "      <table>\n";
            print "        <tbody>\n";
            print "          <tr>\n";
            print "            <td>Contraseña:</td>\n";
            print "            <td><input type=\"password\" name=\"password2\" autofocus></td>\n";
            print "          </tr>\n";
            print "        </tbody>\n";
            print "      </table>\n";
            print "\n";
            print "      <p>\n";
            print "        <input type=\"submit\" value=\"Añadir\">\n";
            print "        <input type=\"hidden\" name=\"usuario\" value=\"$usuario\">\n";
            print "        <input type=\"hidden\" name=\"password\" value=\"" . md5($password) . "\">\n";
            print "      </p>\n";
            print "    </form>\n";
            print "\n";
        }
    } else {
        $consulta = "SELECT * FROM $dbUsuarios
            WHERE usuario='$usuario'";
        $result = $db->query($consulta);
        if (!$result) {
            cabecera("Identificación 2", MENU_PRINCIPAL);
            print "    <p>Error en la consulta.</p>\n";
            print "\n";
        } else {
            $valor = $result->fetch();
            if ($valor["password"] == md5($password)) {
                session_start();
                $_SESSION["multiagendaIdUsuario"] = $valor["id"];
                $_SESSION["multiagendaUsuario"]   = $valor["usuario"];
                header("Location:index.php");
                exit();
            } else {
                header("Location:index.php?aviso=El usuario ya existe, pero la contraseña no es correcta");
                exit();
            }
        }
    }
    $db = NULL;
    pie();
}
?>
