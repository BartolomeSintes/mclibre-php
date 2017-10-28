<?php
/**
 * Multiagenda -  validar2.php
 *
 * @author    Bartolom� Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2009 Bartolom� Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2009-05-21
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

include("funciones.php");
$db = conectaDb();

$usuario   = recogeParaConsulta($db,'usuario');
$usuario   = quitaComillasExteriores($usuario);
$password  = recogeParaConsulta($db,'password');
$password  = quitaComillasExteriores($password);
$password2 = recogeParaConsulta($db,'password2');
$password2 = quitaComillasExteriores($password2);
// Comprobaci�n inicial por si se recarga la p�gina nada m�s registrar un nuevo usuario
session_start();
if (isset($_SESSION['multiagendaUsuario'])) {
    header('Location:index.php');
    exit();
} else {
    session_destroy();
    if (!$usuario|| ($usuario=='menu_principal')) {
        header('Location:index.php?aviso=Nombre de usuario no permitido');
        exit();
    } elseif ($password!=md5($password2)) {
        header('Location:index.php?aviso=Error: Las contrase�as no coinciden');
        exit();
    } else {
        $consulta = "SELECT COUNT(*) FROM $dbUsuarios
            WHERE usuario='$usuario'";
        $result = $db->query($consulta);
        if (!$result) {
            cabecera('Identificaci�n 3', CABECERA_SIN_CURSOR, 'menu_principal');
            print "<p>Error en la consulta.</p>";
        } elseif ($result->fetchColumn()!=0) {
            cabecera('Identificaci�n 3', CABECERA_SIN_CURSOR, 'menu_principal');
            print "<p>El nombre de usuario ya est� registrado.</p>";
        } else {
            $consulta = "SELECT COUNT(*) FROM $dbUsuarios";
            $result = $db->query($consulta);
            if (!$result) {
                cabecera('Identificaci�n 3', CABECERA_SIN_CURSOR, 'menu_principal');
                print "<p>Error en la consulta.</p>";
            } elseif ($result->fetchColumn()>=MAX_REG_USUARIOS) {
                cabecera('Identificaci�n 3', CABECERA_SIN_CURSOR, 'menu_principal');
                print "<p>Se ha alcanzado el n�mero m�ximo de Usuarios que se pueden "
                    ."guardar.</p>\n<p>Por favor, borre alg�n registro antes.</p>\n";
            } else {
                $consulta = "INSERT INTO $dbUsuarios
                    VALUES (NULL, '$usuario', '$password')";
                if (!$db->query($consulta)) {
                    cabecera('Identificaci�n 3', CABECERA_SIN_CURSOR, 'menu_principal');
                    print "<p>Error al crear el registro.<p>\n";
                } else {
                    $consulta = "SELECT * FROM $dbUsuarios
                        WHERE usuario='$usuario'";
                    $result = $db->query($consulta);
                    if (!$result) {
                        cabecera('Identificaci�n 3', CABECERA_SIN_CURSOR, 'menu_principal');
                        print "<p>Error en la consulta.</p>";
                    } else {
                        $valor = $result->fetch();
                        session_start();
                        $_SESSION['multiagendaIdUsuario'] = $valor['id'];
                        $_SESSION['multiagendaUsuario']   = $valor['usuario'];
                        cabecera('Identificaci�n 3', CABECERA_SIN_CURSOR, $usuario);
                        print "  <p>Bienvenido/a, <strong>$usuario</strong>. Ya es usted "
                            ."un usuario registrado y puede crear su agenda.</p>";
                    }
                }
            }
        }
        $db = NULL;
        pie();
    }
}
?>
