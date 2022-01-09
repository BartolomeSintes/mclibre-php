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
    exit();
}

$usuario  = recoge("usuario");
$password = recoge("password");

$pdo = conectaDb();

if (!$usuario) {
    header("Location:login-1.php?aviso=Error: Nombre de usuario no permitido");
    exit();
}

$consulta = "SELECT * FROM $cfg[dbUsuariosTabla]
             WHERE usuario=:usuario
             AND password=:password";
$resultado = $pdo->prepare($consulta);
$resultado->execute([":usuario" => $usuario, ":password" => encripta($password)]);

if (!$resultado) {
    header("Location:login-1.php?aviso=Error: Error en la consulta.");
    exit();
}

$valor = $resultado->fetch();

if (!is_array($valor)) {
    header("Location:login-1.php?aviso=Error: Nombre de usuario y/o contraseña incorrectos");
    exit();
}

$_SESSION["conectado"] = $valor["nivel"];

$pdo = null;

header("Location:../index.php");
