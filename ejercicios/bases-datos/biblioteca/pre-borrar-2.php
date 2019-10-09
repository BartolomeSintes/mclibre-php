<?php
/**
 * Biblioteca - pre-borrar-2.php
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

include "biblioteca.php";
$db = conectaDb();
cabecera ("Préstamos - Borrar 2", "menuPrestamos");

$id = recogeMatrizParaConsulta($db, "id");

if (count($id) == 0) {
  print "    <p>No se ha marcado nada para borrar.</p>\n";
  print "\n";
} else {
    foreach ($id as $indice => $valor) {
        $consulta = "DELETE FROM $dbPrestamos
            WHERE id=$indice";
        if ($db->query($consulta)) {
            print "    <p>Registro borrado correctamente.</p>\n";
            print "\n";
        } else {
            print "    <p>Error al borrar el registro.</p>\n";
            print "\n";
        }
    }
}

$db = NULL;
pie();
?>
