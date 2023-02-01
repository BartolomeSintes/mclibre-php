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

$pdo = conectaDb();

$usuario  = recoge("usuario");
$password = recoge("password");

if (!$usuario) {
    header("Location:login-1.php?aviso=Error: Nombre de usuario no permitido");
    exit;
}

$consulta = "SELECT * FROM $cfg[tablaUsuarios]
             WHERE usuario = :usuario
             AND password = :password";

$resultado = $pdo->prepare($consulta);
if (!$resultado) {
    header("Location:login-1.php?aviso=Error al preparar la consulta. SQLSTATE[{$pdo->errorCode()}]: {$pdo->errorInfo()[2]}");
    exit;
}

$resultado->execute([":usuario" => $usuario, ":password" => encripta($password)]);
if (!$resultado) {
    header("Location:login-1.php?aviso=Error al ejecutar la consulta. SQLSTATE[{$pdo->errorCode()}]: {$pdo->errorInfo()[2]}");
    exit;
}

$registro = $resultado->fetch();
if (!is_array($registro)) {
    header("Location:login-1.php?aviso=Error: Nombre de usuario y/o contraseña incorrectos");
    exit;
}

$_SESSION["conectado"] = true;
$_SESSION["nivel"]     = $registro["nivel"];

$consulta = "UPDATE $cfg[tablaUsuarios]
             SET conexiones = " . ($registro["conexiones"] + 1) . "
             WHERE id = :id";

$resultado = $pdo->prepare($consulta);
if (!$resultado) {
    header("Location:login-1.php?aviso=Error al preparar la consulta. SQLSTATE[{$pdo->errorCode()}]: {$pdo->errorInfo()[2]}");
    exit;
} elseif (!$resultado->execute([":id" => $registro["id"]])) {
    header("Location:login-1.php?aviso=Error al ejecutar la consulta. SQLSTATE[{$pdo->errorCode()}]: {$pdo->errorInfo()[2]}");
    exit;
}

if ($registro["conexiones"] + 1 > $cfg["numeroConexionesAviso"]) {
    cabecera("Login 2", MENU_VOLVER, PROFUNDIDAD_1);

    print "  <p>Se ha conectado ya " . ($registro["conexiones"] + 1) . " veces. Se recomienda cambiar la contraseña.</p>\n";

    pie();
} else {
    header("Location:../index.php");
}
