<?php
/**
 * Registro de usuarios 2 - conectar-2.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2013 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2013-03-10
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

session_start();
if (isset($_SESSION["id"])) {
    header("Location:index.php");
    exit();
} else {
    $db = conectaDb();

    $usuario   = recoge("usuario");
    $password  = recoge("password");

    if (!$usuario) {
        header("Location:conectar-1.php?aviso=Error: Nombre de usuario no permitido");
        exit();
    } else {
        $consulta = "SELECT * FROM $dbUsuarios
            WHERE usuario='$usuario'";
        $result = $db->query($consulta);
        if (!$result) {
            cabecera("Identificar 2", MENU_PRINCIPAL);
            print "    <p>Error en la consulta.</p>";
            print "\n";
        } else {
            $valor = $result->fetch();
            if ($valor["password"] == md5($password)) {
                $_SESSION["id"]  = $valor["id"];
                $_SESSION["usuario"]  = $valor["usuario"];
                $_SESSION["password"] = $valor["password"];
                header("Location:index.php");
                exit();
            } else {
                header("Location:conectar-1.php?aviso=Error: Nombre de usuario y/o contraseña incorrectos");
                exit();
            }
        }
        $db = null;
        pie();
    }
}
?>
