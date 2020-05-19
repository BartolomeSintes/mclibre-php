<?php
/**
 * @author    Bartolomé Sintes Marco - bartolome.sintes+mclibre@gmail.com
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @link      https://www.mclibre.org
 */

require_once "../comunes/biblioteca.php";

session_name(SESSION_NAME);
session_start();
if (!isset($_SESSION["conectado"]) || $_SESSION["conectado"] != NIVEL_2) {
    header("Location:../index.php");
    exit;
}

$db = conectaDb();
cabecera("Usuarios - Modificar 3", MENU_USUARIOS, 1);

$usuario  = recoge("usuario");
$password = recoge("password");
$nivel    = recoge("nivel");
$id       = recoge("id");

$usuarioOk  = false;
$passwordOk = false;
$nivelOk    = false;

if (mb_strlen($usuario, "UTF-8") > $tamUsuariosUsuario) {
    print "    <p class=\"aviso\">El nombre usuario no puede tener más de $tamUsuariosUsuario caracteres.</p>\n";
    print "\n";
} else {
    $usuarioOk = true;
}

if (mb_strlen($password, "UTF-8") > $tamUsuariosPassword) {
    print "    <p class=\"aviso\">La contraseña no puede tener más de $tamUsuariosPassword caracteres.</p>\n";
    print "\n";
} else {
    $passwordOk = true;
}

if (!in_array($nivel, $usuariosNiveles)) {
    print "    <p class=\"aviso\">Nivel de usuario incorrecto.</p>\n";
    print "\n";
} else {
    $nivelOk = true;
}

if ($usuarioOk && $passwordOk && $nivelOk) {
    if ($id == "") {
        print "    <p class=\"aviso\">No se ha seleccionado ningún registro.</p>\n";
    } elseif ($usuario == "" || $nivel == "") {
        print "    <p class=\"aviso\">Hay que rellenar el nombre y nivel de usuario. No se ha guardado el registro.</p>\n";
    } else {
        $consulta = "SELECT * FROM $tablaUsuarios
            WHERE id=:id";
        $result = $db->prepare($consulta);
        $result->execute([":id" => $id]);
        if (!$result) {
            print "    <p class=\"aviso\">Error en la consulta.</p>\n";
        } else {
            $valor = $result->fetch();
            if ($valor["usuario"] == ROOT_NAME) {
                print "    <p>Este usuario no se puede modificar.</p>\n";
            } else {
                $consulta = "SELECT COUNT(*) FROM $tablaUsuarios
                    WHERE id=:id";
                $result = $db->prepare($consulta);
                $result->execute([":id" => $id]);
                if (!$result) {
                    print "    <p class=\"aviso\">Error en la consulta.</p>\n";
                } elseif ($result->fetchColumn() == 0) {
                    print "    <p class=\"aviso\">Registro no encontrado.</p>\n";
                } else {
                    // La consulta cuenta los registros con un id diferente porque MySQL no distingue
                    // mayúsculas de minúsculas y si en un registro sólo se cambian mayúsculas por
                    // minúsculas MySQL diría que ya hay un registro como el que se quiere guardar.
                    $consulta = "SELECT COUNT(*) FROM $tablaUsuarios
                        WHERE usuario=:usuario
                        AND id<>:id";
                    $result = $db->prepare($consulta);
                    $result->execute([":usuario" => $usuario, ":id" => $id]);
                    if (!$result) {
                        print "    <p class=\"aviso\">Error en la consulta.</p>\n";
                    } elseif ($result->fetchColumn() > 0) {
                        print "    <p class=\"aviso\">Ya existe un registro con ese nombre de usuario. "
                            . "No se ha guardado la modificación.</p>\n";
                    } else {
                        if ($password != "") {
                            $consulta = "UPDATE $tablaUsuarios
                                SET usuario=:usuario, password=:password, nivel=:nivel
                                WHERE id=:id";
                            $result = $db->prepare($consulta);
                            if ($result->execute([":usuario" => $usuario, ":password" => encripta($password),
                                ":nivel" => $nivel, ":id" => $id, ])) {
                                print "    <p>Registro modificado correctamente.</p>\n";
                            } else {
                                print "    <p class=\"aviso\">Error al modificar el registro.</p>\n";
                            }
                        } else {
                            $consulta = "UPDATE $tablaUsuarios
                                SET usuario=:usuario, nivel=:nivel
                                WHERE id=:id";
                            $result = $db->prepare($consulta);
                            if ($result->execute([":usuario" => $usuario,
                                ":nivel" => $nivel, ":id" => $id, ])) {
                                print "    <p>Registro modificado correctamente.</p>\n";
                            } else {
                                print "    <p class=\"aviso\">Error al modificar el registro.</p>\n";
                            }
                        }
                    }
                }
            }
        }
    }
}

$db = null;
pie();
