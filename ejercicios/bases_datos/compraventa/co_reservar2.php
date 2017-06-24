<?php
/**
 * Compraventa - co_reservar2.php
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
    cabecera('Compra - Reservar 2', 'compra');

    $id = recogeMatrizParaConsulta($db, 'id');
    
    if (count($id)==0) {
      print "<p>No se ha marcado nada para reservar.</p>\n";
    } else {
        foreach ($id as $indice => $valor) {
            $consulta = "SELECT COUNT(*) FROM $dbArticulos 
                WHERE id=$indice 
                AND id_vendedor!='$_SESSION[compraventaIdUsuario]' 
                AND reservado=FALSE";
            $result = $db->query($consulta);
            if (!$result) {
                print "<p>Error en la consulta.</p>\n";
            } elseif ($result->fetchColumn()==0) {
                print "<p>El registro indicado no es válido o está ya reservado.</p>\n";
            } else {
                date_default_timezone_set('Europe/Madrid'); 
                $fecha_reserva = date("Y-m-d H:i:s");
                $consulta = "UPDATE $dbArticulos SET
                    id_comprador='$_SESSION[compraventaIdUsuario]',
                    reservado=TRUE,
                    fecha_reserva='$fecha_reserva'
                    WHERE id='$indice'";
                if ($db->query($consulta)) {
                    print "<p>Artículo reservado correctamente.</p>\n";
                } else {
                    print "<p>Error al reservar el artículo.</p>\n";
                }
            }
        }
    }
    
    $db = NULL;
    pie();
}
?>
