<?php
/**
 * Bases de datos 1-5 - buscar-2.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2016 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2016-12-06
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

require_once "biblioteca.php";

$db = conectaDb();
cabecera("Buscar 2", MENU_VOLVER);

$nombre    = recoge("nombre");
$apellidos = recoge("apellidos");

$consulta = "SELECT * FROM $dbTabla
    WHERE nombre LIKE :nombre
    AND apellidos LIKE :apellidos";
$result = $db->prepare($consulta);
$result->execute([":nombre" => "%$nombre%", ":apellidos" => "%$apellidos%"]);

print "    <p>Registros encontrados:</p>\n";
print "\n";
print "    <table class=\"conborde franjas\">\n";
print "      <thead>\n";
print "        <tr>\n";
print "          <th>Nombre</th>\n";
print "          <th>Apellidos </th>\n";
print "        </tr>\n";
print "      </thead>\n";
print "      <tbody>\n";
foreach ($result as $valor) {
    print "        <tr>\n";
    print "          <td>$valor[nombre]</td>\n";
    print "          <td>$valor[apellidos]</td>\n";
    print "        </tr>\n";
}
print "      </tbody>\n";
print "    </table>\n";

$db = null;
pie();
