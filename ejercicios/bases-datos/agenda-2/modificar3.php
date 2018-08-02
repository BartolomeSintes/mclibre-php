<?php
/**
 * Multiagenda -  modificar3.php
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

include('funciones.php');
session_start();

if (!isset($_SESSION['multiagendaUsuario'])) {
    header('Location:index.php');
    exit();
} else {
    $db = conectaDb();
    cabecera('Modificar 3', CABECERA_SIN_CURSOR, $_SESSION['multiagendaUsuario']);

    $nombre    = recogeParaConsulta($db, 'nombre');
    $apellidos = recogeParaConsulta($db, 'apellidos');
    $telefono  = recogeParaConsulta($db, 'telefono');
    $correo    = recogeParaConsulta($db, 'correo');
    $id        = recogeParaConsulta($db, 'id');

    if ($id=="''") {
        print "<p>No se ha seleccionado ningún registro.</p>\n";
    } elseif (($nombre=="''") && ($apellidos=="''") && ($telefono=="''") && ($correo=="''")) {
        print "<p>Hay que rellenar al menos uno de los campos. "
            ."No se ha guardado la modificación.</p>\n";
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
            print "<p>Error en la consulta.</p>\n";
        } elseif ($result->fetchColumn()>0) {
            print "<p>Ya existe un registro con esos mismos valores. "
                ."No se ha guardado la modificación.</p>\n";
        } else {
            $consulta = "UPDATE $dbAgenda
                SET nombre=$nombre, apellidos=$apellidos,
                telefono=$telefono, correo=$correo
                WHERE id_usuario='$_SESSION[multiagendaIdUsuario]'
                AND id=$id";
            if ($db->query($consulta)) {
                print "<p>Registro modificado correctamente.</p>\n";
            } else {
                print "<p>Error al modificar el registro.</p>\n";
            }
        }
    }

    $db = NULL;
    pie();
}
?>
