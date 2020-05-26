<?php
/**
 * @author    Bartolomé Sintes Marco - bartolome.sintes+mclibre@gmail.com
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @link      https://www.mclibre.org
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

$_SESSION["conectado"] = $valor["nivel"];
$db                    = null;
header("Location:../index.php");
exit();
