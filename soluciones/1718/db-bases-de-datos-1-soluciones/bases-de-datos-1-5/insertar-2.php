<?php
/**
 * Bases de datos 1-5 - insertar-2.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2017 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2017-12-05
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
cabecera("Añadir 2", MENU_VOLVER);

$nombre      = recoge("nombre");
$apellidos   = recoge("apellidos");

$nombreOk    = false;
$apellidosOk = false;

if (mb_strlen($nombre, "UTF-8") > $tamNombre) {
    print "    <p class=\"aviso\">El nombre no puede tener más de $tamNombre caracteres.</p>\n";
    print "\n";
} else {
    $nombreOk = true;
}

if (mb_strlen($apellidos, "UTF-8") > $tamApellidos) {
    print "    <p class=\"aviso\">Los apellidos no pueden tener más de $tamApellidos caracteres.</p>\n";
    print "\n";
} else {
    $apellidosOk = true;
}

if ($nombreOk && $apellidosOk) {
    $consulta = "INSERT INTO $dbTabla
        (nombre, apellidos)
        VALUES (:nombre, :apellidos)";
    $result = $db->prepare($consulta);
    if ($result->execute([":nombre" => $nombre, ":apellidos" => $apellidos])) {
        print "    <p>Registro <strong>$nombre $apellidos</strong> creado correctamente.</p>\n";
    } else {
        print "    <p>Error al crear el registro <strong>$nombre $apellidos</strong>.</p>\n";
    }
}

$db = null;
pie();
