<?php
/**
 * @author    Bartolomé Sintes Marco - bartolome.sintes+mclibre@gmail.com
 * @license   https://www.gnu.org/licenses/agpl-3.0.txt AGPL 3 or later
 * @link      https://www.mclibre.org
 */

require_once "../comunes/biblioteca.php";

session_name($cfg["sessionName"]);
session_start();

if (isset($_SESSION["conectado"])) {
    header("Location:../index.php");
    exit;
}

$usuario  = recoge("usuario");
$password = recoge("password");

if ($usuario != $cfg["rootName"] || encripta($password) != $cfg["rootPassword"]) {
    header("Location:login-1.php?aviso=Error: Nombre de usuario y/o contraseña incorrectos");
    exit;
}

$_SESSION["conectado"] = true;

header("Location:../index.php");

exit;
