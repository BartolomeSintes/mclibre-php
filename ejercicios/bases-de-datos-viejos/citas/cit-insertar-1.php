<?php
/**
 * Citas -  cit-insertar-1.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2008 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2008-06-06
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
if (!isset($_SESSION["citasUsuario"])) {
    header("Location:index.php");
    exit();
} else {
    include "biblioteca.php";
    $db = conectaDb();
    cabecera("Citas - Añadir 1", "menu_citas");
    $consulta = "SELECT COUNT(*) FROM $dbAutores";
    $result = $db->query($consulta);
    if (!$result) {
        print "    <p>Error en la consulta.</p>\n";
        print "\n";
    } elseif ($result->fetchColumn() == 0) {
        print "    <p>No se ha creado todavía ningún autor.</p>\n";
        print "\n";
    } else {
        $consulta = "SELECT COUNT(*) FROM $dbCitas";
        $result = $db->query($consulta);
        if (!$result) {
            print "    <p>Error en la consulta.</p>\n";
            print "\n";
        } elseif ($result->fetchColumn()>=$maxRegCitas) {
            print "    <p>Se ha alcanzado el número máximo de registros que se pueden guardar.</p>\n";
            print "\n";
            print "    <p>Por favor, borre algún registro antes.</p>\n";
            print "\n";
        } else {
            print "    <form action=\"cit-insertar-2.php\" method=\"get\">\n";
            print "      <p>Escriba los datos de la nueva cita:</p>\n";
            print "\n";
            print "      <table>\n";
            print "        <tbody>\n";
            print "          <tr>\n";
            print "            <td>Autor:</td>\n";
            print "            <td>\n";
            print "              <select name=\"autor\">\n";
            $consulta = "SELECT * FROM $dbAutores
                ORDER by apellidos ASC";
            $result = $db->query($consulta);
            foreach ($result as $indice => $valor) {
                print "                <option value=\"$valor[id]\">$valor[nombre] $valor[apellidos]</option>\n";
            }
            print "              </select>\n";
            print "            </td>\n";
            print "          </tr>\n";
            print "          <tr>\n";
            print "            <td>Cita:</td>\n";
            print "            <td><textarea name=\"cita\" cols=\"80\" rows=\"5\" autofocus></textarea></td>\n";
            print "          </tr>\n";
            print "        </tbody>\n";
            print "      </table>\n";
            print "\n";
            print "      <p><input type=\"submit\" value=\"Añadir\"></p>\n";
            print "    </form>\n";
        }
    }
    $db = NULL;
    pie();
}
?>
