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

cabecera("Usuarios - Modificar 3", MENU_USUARIOS, PROFUNDIDAD_2);

$usuario  = recoge("usuario");
$password = recoge("password");
$nivel    = recoge("nivel");
$id       = recoge("id");

$usuarioOk  = false;
$passwordOk = false;
$nivelOk    = false;
$idOk       = false;

if ($usuario == "") {
    print "    <p class=\"aviso\">Hay que escribir un nombre de usuario.</p>\n";
    print "\n";
} elseif (mb_strlen($usuario, "UTF-8") > $cfg["dbUsuariosTamUsuario"]) {
    print "    <p class=\"aviso\">El nombre de usuario no puede tener más de $cfg[dbUsuariosTamUsuario] caracteres.</p>\n";
    print "\n";
} else {
    $usuarioOk = true;
}

if (mb_strlen($password, "UTF-8") > $cfg["formUsuariosTamPassword"]) {
    print "    <p class=\"aviso\">La contraseña no puede tener más de $cfg[formUsuariosTamPassword] caracteres.</p>\n";
    print "\n";
} else {
    $passwordOk = true;
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

if ($id == "") {
    print "    <p class=\"aviso\">No se ha seleccionado ningún registro.</p>\n";
} else {
    $idOk = true;
}

if ($usuarioOk && $passwordOk && $nivelOk && $idOk) {
    $consulta = "SELECT COUNT(*) FROM $cfg[dbUsuariosTabla]
                 WHERE id = :id";

    $resultado = $pdo->prepare($consulta);
    if (!$resultado) {
        print "    <p class=\"aviso\">Error al preparar la consulta. SQLSTATE[{$pdo->errorCode()}]: {$pdo->errorInfo()[2]}</p>\n";
    } elseif (!$resultado->execute([":id" => $id])) {
        print "    <p class=\"aviso\">Error al ejecutar la consulta. SQLSTATE[{$pdo->errorCode()}]: {$pdo->errorInfo()[2]}</p>\n";
    } elseif ($resultado->fetchColumn() == 0) {
        print "    <p class=\"aviso\">Registro no encontrado.</p>\n";
    } else {
        // La consulta cuenta los registros con un id diferente porque MySQL no distingue
        // mayúsculas de minúsculas y si en un registro sólo se cambian mayúsculas por
        // minúsculas MySQL diría que ya hay un registro como el que se quiere guardar.
        $consulta = "SELECT COUNT(*) FROM $cfg[dbUsuariosTabla]
                     WHERE usuario = :usuario
                     AND id <> :id";

        $resultado = $pdo->prepare($consulta);
        if (!$resultado) {
            print "    <p class=\"aviso\">Error al preparar la consulta. SQLSTATE[{$pdo->errorCode()}]: {$pdo->errorInfo()[2]}</p>\n";
        } elseif (!$resultado->execute([":usuario" => $usuario, ":id" => $id])) {
            print "    <p class=\"aviso\">Error al ejecutar la consulta. SQLSTATE[{$pdo->errorCode()}]: {$pdo->errorInfo()[2]}</p>\n";
        } elseif ($resultado->fetchColumn() > 0) {
            print "    <p class=\"aviso\">Ya existe un registro con esos mismos valores. "
                . "No se ha guardado la modificación.</p>\n";
        } else {
            $consulta = "SELECT * FROM $cfg[dbUsuariosTabla]
                         WHERE id = :id";

            $resultado = $pdo->prepare($consulta);
            if (!$resultado) {
                print "    <p class=\"aviso\">Error al preparar la consulta. SQLSTATE[{$pdo->errorCode()}]: {$pdo->errorInfo()[2]}</p>\n";
            } elseif (!$resultado->execute([":id" => $id])) {
                print "    <p class=\"aviso\">Error al ejecutar la consulta. SQLSTATE[{$pdo->errorCode()}]: {$pdo->errorInfo()[2]}</p>\n";
            } else {
                $registro = $resultado->fetch();
                if ($registro["usuario"] == $cfg["rootName"] && (!$cfg["rootPasswordModificable"] || $registro["usuario"] != $usuario || $registro["nivel"] != $nivel)) {
                    print "    <p class=\"aviso\">Del usuario Administrador inicial sólo se puede cambiar la contraseña.</p>\n";
                } else {
                    $consulta = "UPDATE $cfg[dbUsuariosTabla]
                                 SET usuario = :usuario, password = :password, nivel = :nivel
                                 WHERE id = :id";

                    $resultado = $pdo->prepare($consulta);
                    if (!$resultado) {
                        print "    <p class=\"aviso\">Error al preparar la consulta. SQLSTATE[{$pdo->errorCode()}]: {$pdo->errorInfo()[2]}</p>\n";
                    } elseif (!$resultado->execute([":usuario" => $usuario, ":password" => encripta($password), ":nivel" => $nivel, ":id" => $id])) {
                        print "    <p class=\"aviso\">Error al ejecutar la consulta. SQLSTATE[{$pdo->errorCode()}]: {$pdo->errorInfo()[2]}</p>\n";
                    } else {
                        print "    <p>Registro modificado correctamente.</p>\n";
                    }
                }
            }
        }
    }
}

$pdo = null;

pie();
