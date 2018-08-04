<?php
/**
 * Poliagenda -  anyadir2.php
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
    cabecera(_('Añadir').' 2', $_SESSION['multiagendaUsuario']);

    $nombre    = recogeParaConsulta($db, 'nombre');
    $apellidos = recogeParaConsulta($db, 'apellidos');
    $telefono  = recogeParaConsulta($db, 'telefono');
    $correo    = recogeParaConsulta($db, 'correo');

    if (($nombre=="''")&&($apellidos=="''")&&($telefono=="''")&&($correo=="''")) {
        print "<p>"._('Hay que rellenar al menos uno de los campos').". "
            ._('No se ha guardado el registro').".</p>\n";
    } else {
        $consulta = "SELECT COUNT(*) FROM $dbAgenda";
        $result = $db->query($consulta);
        if (!$result) {
            print "<p>"._('Error en la consulta').".</p>\n";
        } elseif ($result->fetchColumn()>=$maxRegAgenda) {
            print "<p>"._('Se ha alcanzado el número máximo de registros que se pueden guardar')
                . ".</p>\n<p>"._('Por favor, borre algún registro antes').".</p>\n";
        } else {
            $consulta = "SELECT COUNT(*) FROM $dbAgenda
                WHERE id_usuario='$_SESSION[multiagendaIdUsuario]'
                AND nombre=$nombre
                AND apellidos=$apellidos
                AND telefono=$telefono
                AND correo=$correo";
            $result = $db->query($consulta);
            if (!$result) {
                print "<p>"._('Error en la consulta').".</p>\n";
            } elseif ($result->fetchColumn()==1) {
                print "<p>"._('El registro ya existe').".</p>\n";
            } else {
                $consulta = "INSERT INTO $dbAgenda
                    VALUES (NULL, '$_SESSION[multiagendaIdUsuario]', $nombre,
                    $apellidos, $telefono, $correo)";
                if ($db->query($consulta)) {
                    print "<p>"._('Registro creado correctamente').".</p>\n";
                } else {
                    print "<p>"._('Error al crear el registro').".<p>\n";
                }
            }
        }
    }
    $db = NULL;
    pie();
}

?>
