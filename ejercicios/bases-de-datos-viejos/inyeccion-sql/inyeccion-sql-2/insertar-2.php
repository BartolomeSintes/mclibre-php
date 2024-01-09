<?php
/**
 * Inyección SQL 2 - insertar-2.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2012 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2012-11-25
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

include "biblioteca.php";

$db = conectaDb();
cabecera("Añadir 2", MENU_VOLVER);

$usuario    = recoge("usuario");
$contraseña = recoge("contraseña");

if ($usuario == "" || $contraseña == "") {
    print "    <p>Hay que rellenar los dos campos. No se ha guardado el registro.</p>\n";
    print "\n";
} else {
    $consulta = "SELECT COUNT(*) FROM $dbTabla";
    $result = $db->query($consulta);
    if (!$result) {
        print "    <p>Error en la consulta.</p>\n";
        print "\n";
    } elseif ($result->fetchColumn() >= MAX_REG_TABLA) {
        print "    <p>Se ha alcanzado el número máximo de registros que se pueden guardar.</p>\n";
        print "\n";
        print "    <p>Por favor, borre algún registro antes.</p>\n";
        print "\n";
    } else {
        $consulta = "SELECT COUNT(*) FROM $dbTabla
            WHERE user='$usuario'";
        $result = $db->query($consulta);
        if (!$result) {
            print "    <p>Error en la consulta.</p>\n";
            print "\n";
        } elseif ($result->fetchColumn() != 0) {
            print "    <p>El registro ya existe.</p>\n";
            print "\n";
        } else {
            $consulta = "INSERT INTO $dbTabla
                VALUES (NULL, '$usuario', '$contraseña')";
            if ($db->query($consulta)) {
                print "    <p>Registro creado correctamente.</p>\n";
                print "\n";
            } else {
                print "    <p>Error al crear el registro.</p>\n";
                print "\n";
            }
        }
    }
}

pie();
