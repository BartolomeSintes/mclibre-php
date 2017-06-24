<?php
/**
 * Compraventa - modificar3.php
 * 
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2008 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2008-02-27
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
    cabecera('Modificar 3', 'venta');

    $articulo = recogeParaConsulta($db, 'articulo');
    $precio   = recogeParaConsulta($db, 'precio');
    $id       = recogeParaConsulta($db, 'id');
    
    if ($id=="''") {
        print "<p>No se ha seleccionado ningún registro.</p>\n";    
    } elseif (($articulo=="''") && ($precio=="''")) {
        print "<p>Hay que rellenar al menos uno de los campos. "
            ."No se ha guardado la modificación.</p>\n";
    } else {
// La consulta cuenta los registros con un id diferente porque MySQL no distingue 
// mayúsculas de minúsculas y si en un registro sólo se cambian mayúsculas por 
// minúsculas MySQL diría que ya hay un registro como el que se quiere guardar. 
        $consulta = "SELECT COUNT(*) FROM $dbArticulos 
            WHERE id_vendedor='$_SESSION[compraventaIdUsuario]'
            AND articulo=$articulo 
            AND precio=$precio 
            AND id<>$id";
        $result = $db->query($consulta);
        if (!$result) {
            print "<p>Error en la consulta.</p>\n";
        } elseif ($result->fetchColumn()>0) {
            print "<p>Ya existe un registro con esos mismos valores. "
                ."No se ha guardado la modificación.</p>\n";
        } else {
            $consulta = "UPDATE $dbArticulos 
                    SET articulo=$articulo, precio=$precio 
                    WHERE id_usuario='$_SESSION[compraventaIdUsuario]'
                    AND id='$id'";
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
