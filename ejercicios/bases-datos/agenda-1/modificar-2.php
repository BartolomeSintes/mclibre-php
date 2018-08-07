<?php
/**
 * Agenda - modificar-2.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2009 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2009-05-21
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

include('biblioteca.php');
$db = conectaDb();

$id = recogeParaConsulta($db, 'id');

if ($id == "''") {
    cabecera('Modificar 2', CABECERA_SIN_CURSOR);
    print "    <p>No se ha seleccionado ningún registro.</p>\n";
    print "\n";
} else {
    $consulta = "SELECT COUNT(*) FROM $dbAgenda
        WHERE id=$id";
    $result = $db->query($consulta);
    if (!$result) {
        cabecera('Modificar 2', CABECERA_SIN_CURSOR);
        print "    <p>Error en la consulta.</p>\n";
        print "\n";
    } elseif ($result->fetchColumn() == 0) {
        cabecera('Modificar 2', CABECERA_SIN_CURSOR);
        print "    <p>Registro no encontrado.</p>\n";
        print "\n";
    } else {
        $consulta = "SELECT * FROM $dbAgenda WHERE id=$id";
        $result = $db->query($consulta);
        if (!$result) {
            cabecera('Modificar 2', CABECERA_SIN_CURSOR);
            print "    <p>Error en la consulta.</p>\n";
            print "\n";
        } else {
            $valor = $result->fetch();
            cabecera('Modificar 2', CABECERA_CON_CURSOR);
            print "    <form action=\"modificar-3.php\" method=\"" . FORM_METHOD . "\">\n";
            print "\n";
            print "      <p>Modifique los campos que desee:</p>\n";
            print "\n";
            print "      <table>\n";
            print "        <tbody>\n";
            print "          <tr>\n";
            print "            <td>Nombre:</td>\n";
            print "            <td><input type=\"text\" name=\"nombre\" size=\"" . TAM_NOMBRE . "\" "
                . "maxlength=\"" . TAM_NOMBRE . "\" value=\"$valor[nombre]\" id=\"cursor\" /></td>\n";
            print "          </tr>\n";
            print "          <tr>\n";
            print "            <td>Apellidos:</td>\n";
            print "            <td><input type=\"text\" name=\"apellidos\" size=\"" . TAM_APELLIDOS . "\" "
                . "maxlength=\"" . TAM_APELLIDOS . "\" value=\"$valor[apellidos]\" /></td>\n";
            print "          </tr>\n";
            print "          <tr>\n";
            print "            <td>Teléfono:</td>\n";
            print "            <td><input type=\"text\" name=\"telefono\" size=\"" . TAM_TELEFONO . "\" "
                . "maxlength=\"" . TAM_TELEFONO . "\" value=\"$valor[telefono]\" /></td>\n";
            print "          </tr>\n";
            print "          <tr>\n";
            print "            <td>Correo:</td>\n";
            print "            <td><input type=\"text\" name=\"correo\" size=\"" . TAM_CORREO . "\" "
                . "maxlength=\"" . TAM_CORREO . "\" value=\"$valor[correo]\" /></td>\n";
            print "          </tr>\n";
            print "        </tbody>\n";
            print "      </table>\n";
            print "\n";
            print "      <p>\n";
            print "        <input type=\"hidden\" name=\"id\" value=\"$id\" />\n";
            print "        <input type=\"submit\" value=\"Actualizar\" />\n";
            print "      </p>\n";
            print "    </form>\n";
            print "\n";
        }
    }
}

$db = NULL;
pie();
?>
