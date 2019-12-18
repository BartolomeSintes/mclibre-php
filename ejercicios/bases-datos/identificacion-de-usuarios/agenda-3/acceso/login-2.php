<?php
/**
 * Identificación de usuarios - Agenda (3) - acceso/login-1.php
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

require_once "../comunes/biblioteca.php";

session_name(SESSION_NAME);
session_start();
if (isset($_SESSION["conectado"])) {
    header("Location:../index.php");
    exit();
}

$usuario  = recoge("usuario");
$password = recoge("password");

$db = conectaDb();

if (!$usuario) {
    header("Location:login-1.php?aviso=Error: Nombre de usuario no permitido");
    exit();
}

$consulta = "SELECT * FROM $tablaUsuarios
    WHERE usuario=:usuario";
$result = $db->prepare($consulta);
$result->execute([":usuario" => $usuario]);
if (!$result) {
    header("Location:login-1.php?aviso=Error: Error en la consulta");
    exit();
}

$valor = $result->fetch();
if ($valor["password"] != encripta($password)) {
    header("Location:login-1.php?aviso=Error: Nombre de usuario y/o contraseña incorrectos");
    exit();
}

$_SESSION["conectado"] = true;
$db = null;
header("Location:../index.php");
exit();
