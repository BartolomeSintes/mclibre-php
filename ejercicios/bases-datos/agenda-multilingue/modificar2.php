<?php
/**
 * Poliagenda -  modificar2.php
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
    include('funciones.php');
    $db = conectaDb();
    cabecera(_('Modificar').' 2', $_SESSION['multiagendaUsuario']);

    $id = recogeParaConsulta($db, 'id');

    if ($id=="''") {
        print "<p>"._('No se ha seleccionado ningún registro').".</p>\n";
    } else {
        $consulta = "SELECT COUNT(*) FROM $dbAgenda
            WHERE id=$id
            AND id_usuario='$_SESSION[multiagendaIdUsuario]'";
        $result = $db->query($consulta);
        if (!$result) {
            print "<p>"._('Error en la consulta').".</p>\n";
        } elseif ($result->fetchColumn()==0) {
            print "<p>"._('Registro no encontrado').".</p>\n";
        } else {
            $consulta = "SELECT * FROM $dbAgenda
                WHERE id=$id
                AND id_usuario='$_SESSION[multiagendaIdUsuario]'";
            $result = $db->query($consulta);
            if (!$result) {
                print "<p>"._('Error en la consulta').".</p>\n";
            } else {
                $valor = $result->fetch();
                print "<form action=\"modificar3.php\" method=\"get\">
      <p>"._('Modifique los campos que desee').":</p>
      <table>
        <tbody>
          <tr>
            <td>"._('Nombre').":</td>
            <td><input type=\"text\" name=\"nombre\" size=\"$tamNombre\" "
                    . "value=\"$valor[nombre]\" id=\"cursor\" /></td>
          </tr>
          <tr>
            <td>"._('Apellidos').":</td>
            <td><input type=\"text\" name=\"apellidos\" size=\"$tamApellidos\" "
                    . "value=\"$valor[apellidos]\" /></td>
          </tr>
          <tr>
            <td>"._('Teléfono').":</td>
            <td><input type=\"text\" name=\"telefono\" size=\"$tamTelefono\" "
                    . "value=\"$valor[telefono]\" /></td>
          </tr>
          <tr>
            <td>"._('Correo').":</td>
            <td><input type=\"text\" name=\"correo\" size=\"$tamCorreo\" "
                    . "value=\"$valor[correo]\" /></td>
          </tr>
        </tbody>
      </table>
      <p><input type=\"hidden\" name=\"id\" value=\"$id\" />
        <input type=\"submit\" value=\""._('Actualizar')."\" /></p>
    </form>\n";
            }
        }
    }

    $db = NULL;
    pie();
}
?>
