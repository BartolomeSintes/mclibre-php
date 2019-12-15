<?php
/**
 * Registro de usuarios 3 - db-usuarios/modificar-2.php
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
cabecera("Tabla Usuarios - Modificar 2", MENU_TABLA_USUARIOS_WEB, 1);

$id = recoge("id");

if ($id == "") {
    print "    <p>No se ha seleccionado ningún registro.</p>\n";
} else {
    $consulta = "SELECT COUNT(*) FROM $dbTablaUsuariosWeb
       WHERE id=:id";
    $result = $db->prepare($consulta);
    $result->execute([":id" => $id]);
    if (!$result) {
        print "    <p class=\"aviso\">Error en la consulta.</p>\n";
    } elseif ($result->fetchColumn() == 0) {
        print "    <p>Registro no encontrado.</p>\n";
    } else {
        $consulta = "SELECT * FROM $dbTablaUsuariosWeb
            WHERE id=:id";
        $result = $db->prepare($consulta);
        $result->execute([":id" => $id]);
        if (!$result) {
            print "    <p class=\"aviso\">Error en la consulta.</p>\n";
        } else {
            $valor = $result->fetch();
            print "    <form action=\"modificar-3.php\" method=\"" . FORM_METHOD . "\">\n";
            print "      <p>Modifique los campos que desee:</p>\n";
            print "\n";
            print "      <table>\n";
            print "        <tbody>\n";
            print "          <tr>\n";
            print "            <td>Nombre de usuario:</td>\n";
            print "            <td><input type=\"text\" name=\"usuario\" size=\"$tamUsuariosWebUsuario\" maxlength=\"$tamUsuariosWebUsuario\" value=\"$valor[usuario]\" autofocus></td>\n";
            print "          </tr>\n";
            print "          <tr>\n";
            print "            <td>Contraseña:</td>\n";
            print "            <td><input type=\"text\" name=\"password\" size=\"$tamUsuariosWebPassword\" maxlength=\"$tamUsuariosWebPassword\"></td>\n";
            print "          </tr>\n";
            print "          <tr>\n";
            print "            <td>Nivel:</td>\n";
            print "            <td>\n";
            print "              <select name=\"nivel\">\n";
            foreach ($usuariosWebNiveles as $valorNivel) {
                if ($valor["nivel"] == $valorNivel[1]) {
                    print "                <option value=\"$valorNivel[1]\" selected>$valorNivel[0]</option>\n";
                } else {
                    print "                <option value=\"$valorNivel[1]\">$valorNivel[0]</option>\n";
                }
            }
            print "              </select>\n";
            print "            </td>\n";
            print "          </tr>\n";
            print "        </tbody>\n";
            print "      </table>\n";
            print "\n";
            print "      <p>\n";
            print "        <input type=\"hidden\" name=\"id\" value=\"$id\">\n";
            print "        <input type=\"submit\" value=\"Actualizar\">\n";
            print "        <input type=\"reset\" value=\"Reiniciar formulario\">\n";
            print "      </p>\n";
            print "    </form>\n";
        }
    }
}

$db = null;
pie();
