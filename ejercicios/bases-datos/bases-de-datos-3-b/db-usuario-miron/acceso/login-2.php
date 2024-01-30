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

$usuarioOk  = false;
$passwordOk = false;

if (mb_strlen($usuario, "UTF-8") > $cfg["tablaUsuariosTamUsuario"]) {
    header("Location:login-1.php?aviso=El nombre de usuario no puede tener más de $cfg[tablaUsuariosTamUsuario] caracteres.");
} else {
    $usuarioOk = true;
}

if (mb_strlen($password, "UTF-8") > $cfg["formUsuariosTamPassword"]) {
    header("Location:login-1.php?aviso=La contraseña no puede tener más de $cfg[formUsuariosTamPassword] caracteres.");
} else {
    $passwordOk = true;
}

$passwordCorrectoOk = false;

if ($usuarioOk && $passwordOk) {
    $consulta = "SELECT COUNT(*) FROM $cfg[tablaUsuarios]
                 WHERE usuario = :usuario
                 AND password = :password";

    $resultado = $pdo->prepare($consulta);
    if (!$resultado) {
        header("Location:login-1.php?aviso=Error al preparar la consulta. SQLSTATE[{$pdo->errorCode()}]: {$pdo->errorInfo()[2]}");
    } elseif (!$resultado->execute([":usuario" => $usuario, ":password" => encripta($password)])) {
        header("Location:login-1.php?aviso=Error al ejecutar la consulta. SQLSTATE[{$pdo->errorCode()}]: {$pdo->errorInfo()[2]}");
    } elseif ($resultado->fetchColumn() == 0) {
        header("Location:login-1.php?aviso=Error: Nombre de usuario y/o contraseña incorrectos.");
    } else {
        $passwordCorrectoOk = true;
    }
}

if ($usuarioOk && $passwordOk && $passwordCorrectoOk) {
    $consulta = "SELECT * FROM $cfg[tablaUsuarios]
                 WHERE usuario = :usuario
                 AND password = :password";

    $resultado = $pdo->prepare($consulta);
    if (!$resultado) {
        header("Location:login-1.php?aviso=Error al preparar la consulta. SQLSTATE[{$pdo->errorCode()}]: {$pdo->errorInfo()[2]}");
    } elseif (!$resultado->execute([":usuario" => $usuario, ":password" => encripta($password)])) {
        header("Location:login-1.php?aviso=Error al ejecutar la consulta. SQLSTATE[{$pdo->errorCode()}]: {$pdo->errorInfo()[2]}");
    } else {
        $registro = $resultado->fetch();

        $_SESSION["conectado"] = true;
        $_SESSION["nivel"]     = $registro["nivel"];

        header("Location:../index.php");
    }
}
