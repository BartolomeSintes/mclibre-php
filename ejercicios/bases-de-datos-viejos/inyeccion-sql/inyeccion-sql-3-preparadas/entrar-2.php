<?php
/**
 * Inyección SQL 3 - entrar-2.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2011 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2011-05-18
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
cabecera("Entrar 2", MENU_VOLVER);

// Esta página no desinfecta la entrada del usuario
// pero utiliza sentencias preparadas
// Utiliza la biblioteca PDO

$usuario    = $_REQUEST["usuario"];
$contraseña = $_REQUEST["contraseña"];

if ($usuario == "" || $contraseña == "") {
    print "    <p>Hay que rellenar los dos campos.</p>\n";
    print "\n";
} else {
    $consulta = "SELECT COUNT(*) FROM $dbTabla
        WHERE user=?
        AND password=?";
    $result = $db->prepare($consulta);
    $result->execute([$usuario, $contraseña]);
    if (!$result) {
        print "    <p>Error en la consulta.</p>\n";
        print "\n";
    } elseif ($result->fetchColumn()>0) {
        print "    <p>Nombre de usuario y contraseña correctos.</p>\n";
        print "\n";
    } else {
        $consulta = "SELECT COUNT(*) FROM $dbTabla
            WHERE user=?";
        $result = $db->prepare($consulta);
        $result->execute([$usuario]);
        if (!$result) {
            print "    <p>Error en la consulta.</p>\n";
            print "\n";
        } elseif ($result->fetchColumn()>0) {
            print "    <p>Contraseña incorrecta.</p>\n";
            print "\n";
        } else {
            print "    <p>Nombre de usuario incorrecto.</p>\n";
            print "\n";
        }
    }
}

$db = null;
pie();
?>
