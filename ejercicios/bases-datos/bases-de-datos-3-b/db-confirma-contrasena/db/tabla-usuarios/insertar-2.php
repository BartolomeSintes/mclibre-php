<?php
/**
 * @author    Bartolomé Sintes Marco - bartolome.sintes+mclibre@gmail.com
 * @license   https://www.gnu.org/licenses/agpl-3.0.txt AGPL 3 or later
 * @link      https://www.mclibre.org
 */

require_once "../../comunes/biblioteca.php";

session_name($cfg["sessionName"]);
session_start();

if (!isset($_SESSION["conectado"]) || $_SESSION["nivel"] < NIVEL_ADMINISTRADOR) {
    header("Location:../../index.php");
    exit;
}

$pdo = conectaDb();

cabecera("Usuarios - Añadir 2", MENU_USUARIOS, PROFUNDIDAD_2);

$usuario  = recoge("usuario");
$password = recoge("password");
$password2 = recoge("password2");
$nivel    = recoge("nivel");

$usuarioOk  = false;
$passwordOk = false;
$nivelOk    = false;

if ($usuario == "") {
    print "    <p class=\"aviso\">Hay que escribir un nombre de usuario.</p>\n";
    print "\n";
} elseif (mb_strlen($usuario, "UTF-8") > $cfg["tablaUsuariosTamUsuario"]) {
    print "    <p class=\"aviso\">El nombre de usuario no puede tener más de $cfg[tablaUsuariosTamUsuario] caracteres.</p>\n";
    print "\n";
} else {
    $usuarioOk = true;
}

if ($password != $password2) {
    print "    <p class=\"aviso\">Las contraseñas no coinciden.</p>\n";
    print "\n";
} else {
    $passwordOk = true;
}

if ($passwordOk) {
    if (mb_strlen($password, "UTF-8") > $cfg["formUsuariosTamPassword"] || mb_strlen($password2, "UTF-8") > $cfg["formUsuariosTamPassword"]) {
        print "    <p class=\"aviso\">La contraseña no puede tener más de $cfg[formUsuariosTamPassword] caracteres.</p>\n";
        print "\n";
        $passwordOk = false;
    } else {
        $passwordOk = true;
    }
}

if ($nivel == "") {
    print "    <p class=\"aviso\">Hay que seleccionar un nivel de usuario.</p>\n";
    print "\n";
} elseif (!array_key_exists($nivel, $cfg["usuariosNiveles"])) {
    print "    <p class=\"aviso\">Nivel de usuario incorrecto.</p>\n";
    print "\n";
} else {
    $nivelOk = true;
}

$existeRegistroOk = false;

if ($usuarioOk && $passwordOk && $nivelOk) {
    $consulta = "SELECT COUNT(*) FROM $cfg[tablaUsuarios]
                 WHERE usuario = :usuario";

    $resultado = $pdo->prepare($consulta);
    if (!$resultado) {
        print "    <p class=\"aviso\">Error al preparar la consulta. SQLSTATE[{$pdo->errorCode()}]: {$pdo->errorInfo()[2]}</p>\n";
    } elseif (!$resultado->execute([":usuario" => $usuario])) {
        print "    <p class=\"aviso\">Error al ejecutar la consulta. SQLSTATE[{$pdo->errorCode()}]: {$pdo->errorInfo()[2]}</p>\n";
    } elseif ($resultado->fetchColumn() > 0) {
        print "    <p class=\"aviso\">Ya existe un usuario con ese nombre.</p>\n";
    } else {
        $existeRegistroOk = true;
    }
}

$limiteRegistrosOk = false;

if ($usuarioOk && $passwordOk && $nivelOk && $existeRegistroOk) {
    $consulta = "SELECT COUNT(*) FROM $cfg[tablaUsuarios]";

    $resultado = $pdo->query($consulta);
    if (!$resultado) {
        print "    <p class=\"aviso\">Error en la consulta. SQLSTATE[{$pdo->errorCode()}]: {$pdo->errorInfo()[2]}</p>\n";
    } elseif ($resultado->fetchColumn() >= $cfg["tablaUsuariosMaxReg"] && $cfg["tablaUsuariosMaxReg"] > 0) {
        print "    <p class=\"aviso\">Se ha alcanzado el número máximo de registros que se pueden guardar.</p>\n";
        print "\n";
        print "    <p class=\"aviso\">Por favor, borre algún registro antes de insertar un nuevo registro.</p>\n";
    } else {
        $limiteRegistrosOk = true;
    }
}

if ($usuarioOk && $passwordOk && $nivelOk && $existeRegistroOk && $limiteRegistrosOk) {
    $consulta = "INSERT INTO $cfg[tablaUsuarios]
                 (usuario, password, nivel)
                 VALUES (:usuario, :password, :nivel)";

    $resultado = $pdo->prepare($consulta);
    if (!$resultado) {
        print "    <p class=\"aviso\">Error al preparar la consulta. SQLSTATE[{$pdo->errorCode()}]: {$pdo->errorInfo()[2]}</p>\n";
    } elseif (!$resultado->execute([":usuario" => $usuario, ":password" => encripta($password), ":nivel" => $nivel])) {
        print "    <p class=\"aviso\">Error al ejecutar la consulta. SQLSTATE[{$pdo->errorCode()}]: {$pdo->errorInfo()[2]}</p>\n";
    } else {
        print "    <p>Registro creado correctamente.</p>\n";
    }
}

pie();
