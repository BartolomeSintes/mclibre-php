<?php
/**
 * Identificación de usuarios - Agenda (3) - db-usuarios/insertar-2.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2019 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2019-12-11
 * @link      https://www.mclibre.org
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
cabecera("Usuarios - Añadir 2", MENU_USUARIOS, 1);

$usuario  = recoge("usuario");
$password = recoge("password");

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
    if ($usuario == "" || $password == "") {
        print "    <p>Hay que rellenar los dos campos. No se ha guardado el registro.</p>\n";
    } else {
        $consulta = "SELECT COUNT(*) FROM $tablaUsuarios";
        $result   = $db->query($consulta);
        if (!$result) {
            print "    <p>Error en la consulta.</p>\n";
        } elseif ($result->fetchColumn() >= MAX_REG_TABLE_USUARIOS) {
            print "    <p>Se ha alcanzado el número máximo de registros que se pueden guardar.</p>\n";
            print "\n";
            print "    <p>Por favor, borre algún registro antes.</p>\n";
        } else {
            $consulta = "SELECT COUNT(*) FROM $tablaUsuarios
                WHERE usuario=:usuario";
            $result = $db->prepare($consulta);
            $result->execute([":usuario" => $usuario]);
            if (!$result) {
                print "    <p>Error en la consulta.</p>\n";
            } elseif ($result->fetchColumn() > 0) {
                print "    <p>El registro ya existe.</p>\n";
            } else {
                $consulta = "INSERT INTO $tablaUsuarios
                    (usuario, password)
                    VALUES (:usuario, :password)";
                $result = $db->prepare($consulta);
                if ($result->execute([":usuario" => $usuario, ":password" => encripta($password)])) {
                    print "    <p>Registro <strong>$usuario " . encripta($password) . "</strong> creado correctamente.</p>\n";
                } else {
                    print "    <p>Error al crear el registro <strong>$usuario " . encripta($password) . "</strong>.</p>\n";
                }
            }
        }
    }
}

$db = null;
pie();
