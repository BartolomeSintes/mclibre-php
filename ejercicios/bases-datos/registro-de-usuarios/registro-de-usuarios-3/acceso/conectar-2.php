<?php
/**
 * Registro de usuarios 3 - conectar-2.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2019 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2019-05-05
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

require_once "../comunes/biblioteca.php";

session_start();
if (isset($_SESSION["id"])) {
    header("Location:../index.php");
    exit();
} else {
    $db = conectaDb();

    $usuario   = recoge("usuario");
    $password  = recoge("password");

    if (!$usuario) {
        header("Location:conectar-1.php?aviso=Error: Nombre de usuario no permitido");
        exit();
    } else {
        $consulta = "SELECT * FROM $dbTablaUsuariosWeb
            WHERE usuario='$usuario'";
        $result = $db->query($consulta);
        if (!$result) {
            cabecera("Identificar 2", MENU_IDENTIFICAR, 1);
            print "    <p>Error en la consulta.</p>";
            print "\n";
        } else {
            $valor = $result->fetch();
            if ($valor["password"] == encripta($password)) {
                $_SESSION["id"]      = $valor["id"];
                $_SESSION["usuario"] = $valor["usuario"];
                $_SESSION["nivel"]   = $valor["nivel"];
                header("Location:../index.php");
                exit();
            } else {
                header("Location:conectar-1.php?aviso=Error: Nombre o contraseña incorrecta");
                exit();
            }
        }
        $db = null;
        pie();
    }
}
?>
