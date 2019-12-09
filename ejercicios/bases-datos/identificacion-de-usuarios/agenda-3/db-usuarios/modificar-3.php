<?php
/**
 * Identificación de usuarios (1) - Agenda (3) - db-usuarios/modificar-3.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2019 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2019-12-09
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

require_once "../comunes/biblioteca.php";

session_name(SESSION_NAME);
session_start();
if (!isset($_SESSION["conectado"])) {
    header("Location:../index.php");
    exit;
}

$db = conectaDb();
cabecera("Usuarios - Modificar 3", MENU_USUARIOS, 1);

$usuario  = recoge("usuario");
$password = recoge("password");
$id       = recoge("id");

$usuarioOk  = false;
$passwordOk = false;

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

if ($usuarioOk && $passwordOk) {
    if ($id == "") {
        print "    <p>No se ha seleccionado ningún registro.</p>\n";
    } elseif ($usuario == "" || $password == "") {
        print "    <p>Hay que rellenar los dos campos. No se ha guardado el registro.</p>\n";
    } else {
        $consulta = "SELECT * FROM $dbTablaUsuarios
            WHERE id=:id";
        $result = $db->prepare($consulta);
        $result->execute([":id" => $id]);
        if (!$result) {
            print "    <p>Error en la consulta.</p>\n";
        } else {
            $valor = $result->fetch();
            if ($valor["usuario"] == ROOT_NAME) {
                print "    <p>Este usuario no se puede modificar.</p>\n";
            } else {
                $consulta = "SELECT COUNT(*) FROM $dbTablaUsuarios
                    WHERE id=:id";
                $result = $db->prepare($consulta);
                $result->execute([":id" => $id]);
                if (!$result) {
                    print "    <p>Error en la consulta.</p>\n";
                } elseif ($result->fetchColumn() == 0) {
                    print "    <p>Registro no encontrado.</p>\n";
                } else {
                    // La consulta cuenta los registros con un id diferente porque MySQL no distingue
                    // mayúsculas de minúsculas y si en un registro sólo se cambian mayúsculas por
                    // minúsculas MySQL diría que ya hay un registro como el que se quiere guardar.
                    $consulta = "SELECT COUNT(*) FROM $dbTablaUsuarios
                        WHERE usuario=:usuario
                        AND password=:password
                        AND id<>:id";
                    $result = $db->prepare($consulta);
                    $result->execute([":usuario" => $usuario, ":password" => $password, ":id" => $id]);
                    if (!$result) {
                        print "    <p>Error en la consulta.</p>\n";
                    } elseif ($result->fetchColumn() > 0) {
                        print "    <p>Ya existe un registro con esos mismos valores. "
                            . "No se ha guardado la modificación.</p>\n";
                    } else {
                        $consulta = "UPDATE $dbTablaUsuarios
                            SET usuario=:usuario, password=:password
                            WHERE id=:id";
                        $result = $db->prepare($consulta);
                        if ($result->execute([":usuario" => $usuario, ":password" => encripta($password),
                            ":id" => $id, ])) {
                            print "    <p>Registro modificado correctamente.</p>\n";
                        } else {
                            print "    <p>Error al modificar el registro.</p>\n";
                        }
                    }
                }
            }
        }
    }
}

$db = null;
pie();
