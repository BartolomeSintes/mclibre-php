<?php
/**
 * Biblioteca - obr-modificar-2.php
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
$db = conectaDb();

$id = recogeParaConsulta($db, "id");

if ($id == "''") {
    cabecera("Obras - Modificar 2", "menuObras");
    print "    <p>No se ha seleccionado ningún registro.</p>\n";
    print "\n";
} else {
    $consulta = "SELECT COUNT(*) FROM $dbObras
        WHERE id=$id";
    $result = $db->query($consulta);
    if (!$result) {
        cabecera("Obras - Modificar 2", "menuObras");
        print "    <p>Error en la consulta.</p>\n";
        print "\n";
    } elseif ($result->fetchColumn() == 0) {
        cabecera("Obras - Modificar 2", "menuObras");
        print "    <p>Registro no encontrado.</p>\n";
        print "\n";
    } else {
        $consulta = "SELECT * FROM $dbObras
            WHERE id=$id";
        $result = $db->query($consulta);
        if (!$result) {
            cabecera("Obras - Modificar 2", "menuObras");
            print "    <p>Error en la consulta.</p>\n";
            print "\n";
        } else {
            $valor = $result->fetch();
            cabecera("Obras - Modificar 2", "menuObras");
            print "    <form action=\"obr-modificar-3.php\" method=\"" . FORM_METHOD . "\">\n";
            print "      <p>Modifique los campos que desee:</p>\n";
            print "\n";
            print "      <table>\n";
            print "        <tbody>\n";
            print "          <tr>\n";
            print "            <td>Autor:</td>\n";
            print "            <td><input type=\"text\" name=\"autor\" size=\"" . TAM_AUTOR . "\" "
                . "maxlength=\"" . TAM_AUTOR . "\" value=\"$valor[autor]\" autofocus></td>\n";
            print "          </tr>\n";
            print "          <tr>\n";
            print "            <td>Título:</td>\n";
            print "            <td><input type=\"text\" name=\"titulo\" size=\"" . TAM_TITULO . "\" "
                . "maxlength=\"" . TAM_TITULO . "\" value=\"$valor[titulo]\"></td>\n";
            print "          </tr>\n";
            print "          <tr>\n";
            print "            <td>Editorial:</td>\n";
            print "            <td><input type=\"text\" name=\"editorial\" size=\"" . TAM_EDITORIAL . "\" "
                . "maxlength=\"" . TAM_EDITORIAL . "\" value=\"$valor[editorial]\"></td>\n";
            print "          </tr>\n";
            print "        </tbody>\n";
            print "      </table>\n";
            print "\n";
            print "      <p>\n";
            print "        <input type=\"hidden\" name=\"id\" value=\"$id\">\n";
            print "        <input type=\"submit\" value=\"Actualizar\">\n";
            print "      </p>\n";
            print "    </form>\n";
            print "\n";
        }
    }
}

$db = NULL;
pie();
?>
