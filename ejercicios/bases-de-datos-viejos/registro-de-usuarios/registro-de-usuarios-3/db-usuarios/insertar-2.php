<?php
/**
 * Registro de usuarios 3 - db-usuarios/insertar-2.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2019 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2019-05-07
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

session_start();

require_once "../comunes/biblioteca.php";

if (!isset($_SESSION["id"]) || $_SESSION["nivel"] != NIVEL_3) {
    header("location:../index.php");
    exit();
}

$db = conectaDb();
cabecera("Tabla Usuarios - Añadir 2", MENU_TABLA_USUARIOS_WEB, 1);

$usuario  = recoge("usuario");
$password = recoge("password");
$nivel    = recoge("nivel");

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
    $consulta = "SELECT COUNT(*) FROM $dbTablaUsuariosWeb";
    $result = $db->query($consulta);
    if (!$result) {
        print "    <p class=\"aviso\">Error en la consulta.</p>\n";
    } elseif ($result->fetchColumn() >= MAX_REG_TABLA_USUARIOS_WEB) {
        print "    <p class=\"aviso\">Se ha alcanzado el número máximo de registros que se pueden guardar.</p>\n";
        print "\n";
        print "    <p class=\"aviso\">Por favor, borre algún registro antes.</p>\n";
    } else {
        $consulta = "SELECT COUNT(*) FROM $dbTablaUsuariosWeb
            WHERE usuario=:usuario";
        $result = $db->prepare($consulta);
        $result->execute([":usuario" => $usuario]);
        if (!$result) {
            print "    <p class=\"aviso\">Error en la consulta.</p>\n";
        } elseif ($result->fetchColumn() > 0) {
            print "    <p>El registro ya existe.</p>\n";
        } else {
            $consulta = "INSERT INTO $dbTablaUsuariosWeb
                (usuario, password, nivel)
                VALUES (:usuario, :password, :nivel)";
            $result = $db->prepare($consulta);
            if ($result->execute([":usuario" => $usuario, ":password" => encripta($password), ":nivel" => $nivel])) {
                print "    <p>Registro <strong>$usuario</strong> creado correctamente.</p>\n";
            } else {
                print "    <p class=\"aviso\">Error al crear el registro <strong>$usuario</strong>.</p>\n";
            }
        }
    }
}

$db = null;
pie();
