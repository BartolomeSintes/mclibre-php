<?php
/**
 * Registro usuarios - validar-2.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2013 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2013-03-07
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

$usuario   = recoge("usuario");
$password  = recoge("password");
$password2 = recoge("password2");

// Comprobación inicial por si se recarga la página nada más registrar un nuevo usuario
session_start();
if (isset($_SESSION["multiagendaUsuario"])) {
    header("Location:index.php");
    exit;
} else {
    session_destroy();
    if (!$usuario|| ($usuario == MENU_PRINCIPAL)) {
        header("Location:index.php?aviso=Nombre de usuario no permitido.");
        exit;
    } elseif ($password != md5($password2)) {
        header("Location:index.php?aviso=Error: Las contraseñas no coinciden.");
        exit;
    } else {
        $consulta = "SELECT COUNT(*) FROM $dbUsuarios
            WHERE usuario='$usuario'";
        $result = $db->query($consulta);
        if (!$result) {
            cabecera("Identificación 3", MENU_PRINCIPAL);
            print "    <p>Error en la consulta.</p>";
            print "\n";
        } elseif ($result->fetchColumn() != 0) {
            cabecera("Identificación 3", MENU_PRINCIPAL);
            print "    <p>El nombre de usuario ya está registrado.</p>";
            print "\n";
        } else {
            $consulta = "SELECT COUNT(*) FROM $dbUsuarios";
            $result = $db->query($consulta);
            if (!$result) {
                cabecera("Identificación 3", MENU_PRINCIPAL);
                print "    <p>Error en la consulta.</p>";
                print "\n";
            } elseif ($result->fetchColumn() >= MAX_REG_USUARIOS) {
                cabecera("Identificación 3", MENU_PRINCIPAL);
                print "    <p>Se ha alcanzado el número máximo de Usuarios que se pueden guardar.</p>\n";
                print "\n";
                print "    <p>Por favor, borre algún registro antes.</p>\n";
                print "\n";
            } else {
                $consulta = "INSERT INTO $dbUsuarios
                    VALUES (NULL, '$usuario', '$password')";
                if (!$db->query($consulta)) {
                    cabecera("Identificación 3", MENU_PRINCIPAL);
                    print "    <p>Error al crear el registro.<p>\n";
                    print "\n";
                } else {
                    $consulta = "SELECT * FROM $dbUsuarios
                        WHERE usuario='$usuario'";
                    $result = $db->query($consulta);
                    if (!$result) {
                        cabecera("Identificación 3", MENU_PRINCIPAL);
                        print "    <p>Error en la consulta.</p>";
                        print "\n";
                    } else {
                        $valor = $result->fetch();
                        session_start();
                        $_SESSION["multiagendaIdUsuario"] = $valor["id"];
                        $_SESSION["multiagendaUsuario"]   = $valor["usuario"];
                        cabecera("Identificación 3", $usuario);
                        print "    <p>Bienvenido/a, <strong>$usuario</strong>. Ya es usted un usuario registrado.</p>";
                        print "\n";
                    }
                }
            }
        }
                pie();
    }
}
?>
