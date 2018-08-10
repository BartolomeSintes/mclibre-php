<?php
/**
 * Poliagenda -  modificar-2.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2008 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2008-03-02
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

session_start();
if (!isset($_SESSION['multiagendaUsuario'])) {
    header('Location:index.php');
    exit();
} else {
    include('biblioteca.php');
    $db = conectaDb();
    cabecera(_('Modificar').' 2', $_SESSION['multiagendaUsuario']);

    $id = recogeParaConsulta($db, 'id');

    if ($id == "''") {
        print "    <p>" . _('No se ha seleccionado ningún registro') . ".</p>\n";
        print "\n";
    } else {
        $consulta = "SELECT COUNT(*) FROM $dbAgenda
            WHERE id=$id
            AND id_usuario='$_SESSION[multiagendaIdUsuario]'";
        $result = $db->query($consulta);
        if (!$result) {
            print "    <p>" . _('Error en la consulta') . ".</p>\n";
            print "\n";
        } elseif ($result->fetchColumn() == 0) {
            print "    <p>" . _('Registro no encontrado') . ".</p>\n";
            print "\n";
        } else {
            $consulta = "SELECT * FROM $dbAgenda
                WHERE id=$id
                AND id_usuario='$_SESSION[multiagendaIdUsuario]'";
            $result = $db->query($consulta);
            if (!$result) {
                print "    <p>" . _('Error en la consulta') . ".</p>\n";
                print "\n";
            } else {
                $valor = $result->fetch();
                print "    <form action=\"modificar-3.php\" method=\"get\">\n";
                print "      <p>" . _('Modifique los campos que desee') . ":</p>\n";
                print "\n";
                print "      <table>\n";
                print "        <tbody>\n";
                print "          <tr>\n";
                print "            <td>" . _('Nombre') . ":</td>\n";
                print "            <td><input type=\"text\" name=\"nombre\" size=\"$tamNombre\" "
                    . "value=\"$valor[nombre]\" id=\"cursor\" /></td>\n";
                print "          </tr>\n";
                print "          <tr>\n";
                print "            <td>" . _('Apellidos') . ":</td>\n";
                print "            <td><input type=\"text\" name=\"apellidos\" size=\"$tamApellidos\" "
                    . "value=\"$valor[apellidos]\" /></td>\n";
                print "          </tr>\n";
                print "          <tr>\n";
                print "            <td>" . _('Teléfono') . ":</td>\n";
                print "            <td><input type=\"text\" name=\"telefono\" size=\"$tamTelefono\" "
                    . "value=\"$valor[telefono]\" /></td>\n";
                print "          </tr>\n";
                print "          <tr>\n";
                print "            <td>" . _('Correo') . ":</td>\n";
                print "            <td><input type=\"text\" name=\"correo\" size=\"$tamCorreo\" "
                    . "value=\"$valor[correo]\" /></td>\n";
                print "          </tr>\n";
                print "        </tbody>\n";
                print "      </table>\n";
                print "\n";
                print "      <p>\n";
                print "        <input type=\"hidden\" name=\"id\" value=\"$id\" />\n";
                print "        <input type=\"submit\" value=\"" . _('Actualizar') . "\" />\n";
                print "      </p>\n";
                print "    </form>\n";
                print "\n";
            }
        }
    }

    $db = NULL;
    pie();
}
?>
