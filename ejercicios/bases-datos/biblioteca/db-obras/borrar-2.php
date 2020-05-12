<?php
/**
 * Biblioteca - db-obras/borrar-2.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2020 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2020-05-11
 * @link      https://www.mclibre.org
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

require_once "../comunes/biblioteca.php";

session_name(SESSION_NAME);
session_start();
if (!isset($_SESSION["conectado"]) || $_SESSION["conectado"] != NIVEL_2) {
    header("Location:../index.php");
    exit;
}

$db = conectaDb();
cabecera("Obras - Borrar 2", MENU_OBRAS, 1);

$id = recoge("id", []);

if (count($id) == 0) {
    print "    <p>No se ha seleccionado ningún registro.</p>\n";
} else {
    foreach ($id as $indice => $valor) {
        $consulta = "SELECT COUNT(*) FROM $tablaObras
            WHERE id=:indice";
        $result = $db->prepare($consulta);
        $result->execute([":indice" => $indice]);
        if (!$result) {
            print "    <p>Error en la consulta.</p>\n";
        } elseif ($result->fetchColumn() == 0) {
            print "    <p>Registro no encontrado.</p>\n";
        } else {
            $consulta = "DELETE FROM $tablaObras
                WHERE id=:indice";
            $result = $db->prepare($consulta);
            if ($result->execute([":indice" => $indice])) {
                print "    <p>Registro borrado correctamente.</p>\n";
            } else {
                print "    <p>Error al borrar el registro.</p>\n";
            }
        }
    }
}

$db = null;
pie();
