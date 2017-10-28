<?php
/**
 * Bases de datos 2-2 - insertar-2.php
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
cabecera("Añadir 2", MENU_VOLVER);

$nombre      = recoge("nombre");
$apellidos   = recoge("apellidos");

$nombreOk    = false;
$apellidosOk = false;

if (mb_strlen($nombre, "UTF-8") > $tamNombre) {
    print "      <p class=\"aviso\">El nombre no puede tener más de $tamNombre caracteres.</p>\n";
    print "\n";
} else {
    $nombreOk = true;
}

if (mb_strlen($apellidos, "UTF-8") > $tamApellidos) {
    print "      <p class=\"aviso\">Los apellidos no pueden tener más de $tamApellidos caracteres.</p>\n";
    print "\n";
} else {
    $apellidosOk = true;
}

if ($nombreOk && $apellidosOk) {
    if ($nombre == "" && $apellidos == "") {
        print "      <p>Hay que rellenar al menos uno de los campos. No se ha guardado el registro.</p>\n";
    } else {
        $consulta = "SELECT COUNT(*) FROM $dbTabla";
        $result = $db->query($consulta);
        if (!$result) {
            print "      <p>Error en la consulta.</p>\n";
        } elseif ($result->fetchColumn() >= MAX_REG_TABLA) {
            print "      <p>Se ha alcanzado el número máximo de registros que se pueden guardar.</p>\n";
            print "      <p>Por favor, borre algún registro antes.</p>\n";
        } else {
            $consulta = "SELECT COUNT(*) FROM $dbTabla
                WHERE nombre=:nombre
                AND apellidos=:apellidos";
            $result = $db->prepare($consulta);
            $result->execute(array(":nombre" => $nombre, ":apellidos" => $apellidos));
            if (!$result) {
                print "      <p>Error en la consulta.</p>\n";
            } elseif ($result->fetchColumn() > 0) {
                print "      <p>El registro ya existe.</p>\n";
            } else {
                $consulta = "INSERT INTO $dbTabla
                    (nombre, apellidos)
                    VALUES (:nombre, :apellidos)";
                $result = $db->prepare($consulta);
                if ($result->execute(array(":nombre" => $nombre, ":apellidos" => $apellidos))) {
                    print "      <p>Registro <strong>$nombre $apellidos</strong> creado correctamente.</p>\n";
                } else {
                    print "      <p>Error al crear el registro <strong>$nombre $apellidos</strong>.</p>\n";
                }
            }
        }
    }
}

$db = null;
pie();
