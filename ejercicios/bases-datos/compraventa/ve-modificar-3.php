<?php
/**
 * Compraventa - modificar3.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2008 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2008-02-26
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
if (!isset($_SESSION['compraventaUsuario'])) {
    header('Location:index.php');
    exit();
} else {
    include('funciones.php');
    $db = conectaDb();
    cabecera('Modificar 3', $_SESSION['compraventaUsuario']);

    $nombre    = recogeParaConsulta($db, 'nombre');
    $apellidos = recogeParaConsulta($db, 'apellidos');
    $telefono  = recogeParaConsulta($db, 'telefono');
    $correo    = recogeParaConsulta($db, 'correo');
    $id        = recogeParaConsulta($db, 'id');

    if (($nombre=="''") && ($apellidos=="''") && ($telefono=="''") && ($correo=="''")) {
        print "<p>Hay que rellenar al menos uno de los campos. "
            ."No se ha guardado la modificación.</p>\n";
    } else {
        $consulta = "SELECT COUNT(*) FROM $dbAgenda WHERE
            id_usuario='$_SESSION[compraventaIdUsuario]'
            AND nombre=$nombre AND apellidos=$apellidos
            AND telefono=$telefono AND correo=$correo";
        $result = $db->query($consulta);
        if (!$result) {
            print "<p>Error en la consulta.</p>\n";
        } elseif ($result->fetchColumn()==0) {
            $consulta = "UPDATE $dbAgenda SET nombre=$nombre,
                apellidos=$apellidos, telefono=$telefono, correo=$correo
                WHERE id_usuario='$_SESSION[compraventaIdUsuario]'
                AND id=$id";
            if ($db->query($consulta)) {
                print "<p>Registro modificado correctamente.</p>\n";
            } else {
                print "<p>Error al modificar el registro.</p>\n";
            }
        } else {
// Esto es por culpa de MySQL que no distingue mayúsculas de minúsculas
// y si en un registro sólo se cambian mayúculas por minúsculas dice que
// ya hay un registro como el que se quiere guardar, así que compruebo
// si el registro que encuentra es el mismo que se quiere modificar y en ese
// caso se guarda
            $consulta = "SELECT * FROM $dbAgenda WHERE
                id_usuario='$_SESSION[compraventaIdUsuario]'
                AND nombre=$nombre AND apellidos=$apellidos
                AND telefono=$telefono AND correo=$correo";
            $result = $db->query($consulta);
            if (!$result) {
                print "<p>Error en la consulta.</p>\n";
            } else {
                $valor = $result->fetch();
                if ($valor['id']!=$id) {
                    print "<p>Ya existe un registro con esos mismos valores. "
                        ."No se ha guardado la modificación.</p>\n";
                } else {
                    $consulta = "UPDATE $dbAgenda SET nombre=$nombre,
                        apellidos=$apellidos, telefono=$telefono, correo=$correo
                        WHERE id_usuario='$_SESSION[compraventaIdUsuario]'
                        AND id=$id";
                    if ($db->query($consulta)) {
                        print "<p>Registro modificado correctamente.</p>\n";
                    } else {
                        print "<p>Error al modificar el registro.</p>\n";
                    }
                }
            }
        }
    }

    $db = NULL;
    pie();
}
?>
