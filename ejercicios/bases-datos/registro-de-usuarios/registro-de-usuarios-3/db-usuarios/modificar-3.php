<?php
/**
 * Registro de usuarios 3 - db-usuarios/modificar-3.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2019 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2019-05-07
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

session_start();

require_once "../comunes/biblioteca.php";

if (!isset($_SESSION["id"]) || $_SESSION["nivel"] != NIVEL_3) {
    header("location:../index.php");
    exit();
}

$db = conectaDb();
cabecera("Tabla Usuarios - Modificar 3", MENU_TABLA_USUARIOS_WEB, 1);

$usuario  = recoge("usuario");
$password = recoge("password");
$nivel    = recoge("nivel");
$id        = recoge("id");

$usuarioOk  = false;
$passwordOk = false;
$nivelOk    = false;

if ($usuario == "") {
    print "    <p class=\"aviso\">El nombre de usuario no puede estar vacío.</p>\n";
    print "\n";
} elseif (mb_strlen($usuario, "UTF-8") > $tamUsuariosWebUsuario) {
    print "    <p class=\"aviso\">El nombre de usuario no puede tener más de $tamUsuariosWebUsuario caracteres.</p>\n";
    print "\n";
} else {
    $usuarioOk = true;
}

if ($password == "") {
    print "    <p class=\"aviso\">La contraseña no puede estar vacía.</p>\n";
    print "\n";
} elseif (mb_strlen($password, "UTF-8") > $tamUsuariosWebPassword) {
    print "    <p class=\"aviso\">La contraseña no puede tener más de $tamUsuariosWebPassword caracteres.</p>\n";
    print "\n";
} else {
    $passwordOk = true;
}

if ($nivel != NIVEL_1 && $nivel != NIVEL_2 && $nivel != NIVEL_3) {
    print "    <p class=\"aviso\">Nivel incorrecto.</p>\n";
    print "\n";
} else {
    $nivelOk = true;
}

if ($usuarioOk && $passwordOk && $nivelOk) {
    if ($id == "") {
        print "    <p>No se ha seleccionado ningún registro.</p>\n";
    } else {
        $consulta = "SELECT COUNT(*) FROM $dbTablaUsuariosWeb
            WHERE id=:id";
        $result = $db->prepare($consulta);
        $result->execute([":id" => $id]);
        if (!$result) {
            print "    <p class=\"aviso\">Error en la consulta.</p>\n";
        } elseif ($result->fetchColumn() == 0) {
            print "    <p>Registro no encontrado.</p>\n";
        } else {
            // La consulta cuenta los registros con un id diferente porque MySQL no distingue
            // mayúsculas de minúsculas y si en un registro sólo se cambian mayúsculas por
            // minúsculas MySQL diría que ya hay un registro como el que se quiere guardar.
            $consulta = "SELECT COUNT(*) FROM $dbTablaUsuariosWeb
                WHERE usuario=:usuario
                AND id<>:id";
            $result = $db->prepare($consulta);
            $result->execute([":usuario" => $usuario, ":id" => $id]);
            if (!$result) {
                print "    <p class=\"aviso\">Error en la consulta.</p>\n";
            } elseif ($result->fetchColumn() > 0) {
                print "    <p>Ya existe un registro con ese nombre. "
                    . "No se ha guardado la modificación.</p>\n";
            } else {
                $consulta = "UPDATE $dbTablaUsuariosWeb
                    SET usuario=:usuario, password=:password, nivel=:nivel
                    WHERE id=:id";
                $result = $db->prepare($consulta);
                if ($result->execute([":usuario" => $usuario, ":password" => encripta($password), ":nivel" => $nivel, ":id" => $id])) {
                    print "    <p>Registro modificado correctamente.</p>\n";
                } else {
                    print "    <p class=\"aviso\">Error al modificar el registro.</p>\n";
                }
            }
        }
    }
}

$db = null;
pie();
