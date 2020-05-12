<?php
/**
 * Biblioteca - db-obras/modificar-2.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2020 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2020-05-11
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

require_once "../comunes/biblioteca.php";

session_name(SESSION_NAME);
session_start();
if (!isset($_SESSION["conectado"]) || $_SESSION["conectado"] != NIVEL_2) {
    header("Location:../index.php");
    exit;
}

$db = conectaDb();
cabecera("Obras - Modificar 2", MENU_OBRAS, 1);

$id = recoge("id");

if ($id == "") {
    print "    <p>No se ha seleccionado ningún registro.</p>\n";
} else {
    $consulta = "SELECT COUNT(*) FROM $tablaObras
       WHERE id=:id";
    $result = $db->prepare($consulta);
    $result->execute([":id" => $id]);
    if (!$result) {
        print "    <p>Error en la consulta.</p>\n";
    } elseif ($result->fetchColumn() == 0) {
        print "    <p>Registro no encontrado.</p>\n";
    } else {
        $consulta = "SELECT * FROM $tablaObras
            WHERE id=:id";
        $result = $db->prepare($consulta);
        $result->execute([":id" => $id]);
        if (!$result) {
            print "    <p>Error en la consulta.</p>\n";
        } else {
            $valor = $result->fetch();
            print "    <form action=\"modificar-3.php\" method=\"" . FORM_METHOD . "\">\n";
            print "      <p>Modifique los campos que desee:</p>\n";
            print "\n";
            print "      <table>\n";
            print "        <tbody>\n";
            print "          <tr>\n";
            print "            <td>Autor:</td>\n";
            print "            <td><input type=\"text\" name=\"autor\" size=\"$tamObrasAutor\" maxlength=\"$tamObrasAutor\" value=\"$valor[autor]\" autofocus></td>\n";
            print "          </tr>\n";
            print "          <tr>\n";
            print "            <td>Título:</td>\n";
            print "            <td><input type=\"text\" name=\"titulo\" size=\"$tamObrasTitulo\" maxlength=\"$tamObrasTitulo\" value=\"$valor[titulo]\"></td>\n";
            print "          </tr>\n";
            print "          <tr>\n";
            print "            <td>Editorial:</td>\n";
            print "            <td><input type=\"text\" name=\"editorial\" size=\"$tamObrasEditorial\" maxlength=\"$tamObrasEditorial\" value=\"$valor[editorial]\"></td>\n";
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
