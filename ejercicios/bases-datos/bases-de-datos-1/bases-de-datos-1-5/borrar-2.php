<?php
/**
 * Bases de datos 1-5 - borrar-2.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2019 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2019-12-11
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

require_once "biblioteca.php";

$db = conectaDb();
cabecera("Borrar 2", MENU_VOLVER);

$id = recoge("id", []);

foreach ($id as $indice => $valor) {
    $consulta = "DELETE FROM $tablaAgenda
        WHERE id=:indice";
    $result = $db->prepare($consulta);
    if ($result->execute([":indice" => $indice])) {
        print "    <p>Registro borrado correctamente.</p>\n";
    } else {
        print "    <p>Error al borrar el registro.</p>\n";
    }
}

$db = null;
pie();
