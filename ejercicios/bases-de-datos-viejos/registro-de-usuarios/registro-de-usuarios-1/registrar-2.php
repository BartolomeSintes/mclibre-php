<?php
/**
 * Registro de usuarios 1 - registrar-2.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2013 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2013-03-10
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

$usuario   = recoge("usuario");
$password  = recoge("password");
$password2 = recoge("password2");

if (!$usuario) {
    header("Location:registrar-1.php?aviso=Error: Nombre de usuario no permitido");
    exit();
} elseif ($password != $password2) {
    header("Location:registrar-1.php?aviso=Error: Las contraseñas no coinciden");
    exit();
} else {
    $consulta = "SELECT COUNT(*) FROM $dbUsuarios
        WHERE usuario='$usuario'";
    $result = $db->query($consulta);
    if (!$result) {
        cabecera("Registrar nuevo usuario 2", MENU_VOLVER);
        print "    <p>Error en la consulta.</p>";
        print "\n";
    } elseif ($result->fetchColumn() != 0) {
        header("Location:registrar-1.php?aviso=Error: El nombre de usuario ya está registrado");
        exit();
    } else {
        $consulta = "SELECT COUNT(*) FROM $dbUsuarios";
        $result = $db->query($consulta);
        if (!$result) {
            cabecera("Registrar nuevo usuario 2", MENU_VOLVER);
            print "    <p>Error en la consulta.</p>";
            print "\n";
        } elseif ($result->fetchColumn() >= MAX_REG_USUARIOS) {
            header("Location:registrar-1.php?aviso=Error: Se ha alcanzado el número máximo de usuarios");
            exit();
        } else {
            $consulta = "INSERT INTO $dbUsuarios
                VALUES (NULL, '$usuario', '$password')";
            if (!$db->query($consulta)) {
                cabecera("Registrar nuevo usuario 2", MENU_VOLVER);
                print "    <p>Error al crear el registro.<p>\n";
                print "\n";
            } else {
                cabecera("Registrar nuevo usuario 2", MENU_VOLVER);
                print "    <p>Bienvenido/a, <strong>$usuario</strong>. Ya es usted un usuario registrado.</p>\n";
                print "\n";
                print "    <p>Vuelva a la página de inicio.</p>\n";
                print "\n";
            }
        }
        $db = null;
        pie();
    }
}
?>
