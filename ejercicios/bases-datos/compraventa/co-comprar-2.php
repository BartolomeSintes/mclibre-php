<?php
/**
 * Compraventa - co_comprar2.php
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

    $consulta = "SELECT COUNT(*) FROM $dbArticulos
        WHERE id_comprador='$_SESSION[compraventaIdUsuario]'
        AND reservado=TRUE
        AND comprado=FALSE";
    $result = $db->query($consulta);
    if (!$result) {
        print "<p>Error en la consulta.</p>\n";
    } elseif ($result->fetchColumn()==0) {
        print "<p>no hay ningún registro reservado.</p>\n";
    } else {
        $consulta = "SELECT * FROM $dbArticulos
            WHERE id_comprador='$_SESSION[compraventaIdUsuario]'
            AND reservado=TRUE
            AND comprado=FALSE";
        $result = $db->query($consulta);
        if (!$result) {
            print "<p>Error en la consulta.</p>\n";
        } else {
            date_default_timezone_set('Europe/Madrid');
            $fecha_compra = date("Y-m-d H:i:s");
            foreach($result as $valor) {
                $consulta = "UPDATE $dbArticulos SET
                    comprado=TRUE,
                    fecha_compra='$fecha_compra'
                    WHERE id='$valor[id]'";
                if ($db->query($consulta)) {
                    print "<p>Artículo comprado correctamente.</p>\n";
                } else {
                    print "<p>Error al comprar el artículo.</p>\n";
                }
            }
        }
    }

    $db = NULL;
    pie();
}
?>
