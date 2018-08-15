<?php
/**
 * Poliagenda -  modificar-3.php
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
if (!isset($_SESSION["multiagendaUsuario"])) {
    header("Location:index.php");
    exit();
} else {
    include "biblioteca.php";
    $db = conectaDb();
    cabecera(_("Modificar") . " 3", $_SESSION["multiagendaUsuario"]);

    $nombre    = recogeParaConsulta($db, "nombre");
    $apellidos = recogeParaConsulta($db, "apellidos");
    $telefono  = recogeParaConsulta($db, "telefono");
    $correo    = recogeParaConsulta($db, "correo");
    $id        = recogeParaConsulta($db, "id");

    if ($id == "''") {
        print "    <p>" . _("No se ha seleccionado ningún registro") . ".</p>\n";
        print "\n";
    } elseif ($nombre == "''" && $apellidos == "''" && $telefono == "''" && $correo == "''") {
        print "    <p>" . _("Hay que rellenar al menos uno de los campos. No se ha guardado la modificación") . ".</p>\n";
        print "\n";
    } else {
// La consulta cuenta los registros con un id diferente porque MySQL no distingue
// mayúsculas de minúsculas y si en un registro sólo se cambian mayúsculas por
// minúsculas MySQL diría que ya hay un registro como el que se quiere guardar.
        $consulta = "SELECT COUNT(*) FROM $dbAgenda
            WHERE id_usuario='$_SESSION[multiagendaIdUsuario]'
            AND nombre=$nombre
            AND apellidos=$apellidos
            AND telefono=$telefono
            AND correo=$correo
            AND id<>$id";
        $result = $db->query($consulta);
        if (!$result) {
            print "    <p>" . _("Error en la consulta") . ".</p>\n";
            print "\n";
        } elseif ($result->fetchColumn()>0) {
            print "    <p>" . _("Ya existe un registro con esos mismos valores. No se ha guardado la modificación") . ".</p>\n";
            print "\n";
        } else {
            $consulta = "UPDATE $dbAgenda
                SET nombre=$nombre, apellidos=$apellidos,
                telefono=$telefono, correo=$correo
                WHERE id_usuario='$_SESSION[multiagendaIdUsuario]'
                AND id=$id";
            if ($db->query($consulta)) {
                print "    <p>" . _("Registro modificado correctamente") . ".</p>\n";
                print "\n";
            } else {
                print "    <p>" . _("Error al modificar el registro") . ".</p>\n";
                print "\n";
            }
        }
    }

    $db = NULL;
    pie();
}
?>
