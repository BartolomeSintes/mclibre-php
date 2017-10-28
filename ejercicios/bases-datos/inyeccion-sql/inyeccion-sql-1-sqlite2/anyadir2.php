<?php
/**
 * Inyección SQL 1 - anyadir2.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2011 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2011-05-18
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
$db = conectaDb();
cabecera('Añadir 2', MENU_VOLVER, CABECERA_SIN_CURSOR);

// $usuario    = recogeParaConsulta($db, 'usuario');
// $contraseña = recogeParaConsulta($db, 'contraseña');

$usuario    = $_REQUEST['usuario'];
$contraseña = $_REQUEST['contraseña'];

//$usuario    = recogeParaConsulta($db, 'usuario');
//$usuario    = quitaComillasExteriores($usuario);
//$contraseña = recogeParaConsulta($db, 'contraseña');
//$contraseña = quitaComillasExteriores($contraseña);

if (($usuario=="") || ($contraseña=="")) {
    print "<p>Hay que rellenar los dos campos. "
        ."No se ha guardado el registro.</p>\n";
} else {
    $consulta = "SELECT COUNT(*) FROM $dbTabla";
    $result =  sqlite_array_query($db, $consulta);
    if (!$result) {
        print "<p>Error en la consulta.</p>\n";
    } elseif ($result[0][0]>=MAX_REG_TABLA) {
        print "<p>Se ha alcanzado el número máximo de registros que se pueden "
            ."guardar.</p>\n<p>Por favor, borre algún registro antes.</p>\n";
    } else {
        $consulta = "SELECT COUNT(*) FROM $dbTabla
            WHERE user='$usuario'";
        $result =  sqlite_array_query($db, $consulta);
        if (!$result) {
            print "<p>Error en la consulta.</p>\n";
        } elseif ($result[0][0]>0) {
            print "<p>El registro ya existe.</p>\n";
        } else {
            $consulta = "INSERT INTO $dbTabla
                VALUES (NULL, '$usuario', '$contraseña')";
            if (sqlite_query($db, $consulta)) {
                print "<p>Registro creado correctamente.</p>\n";
            } else {
                print "<p>Error al crear el registro.</p>\n";
            }
        }
    }
}

$db = null;
pie();
?>
