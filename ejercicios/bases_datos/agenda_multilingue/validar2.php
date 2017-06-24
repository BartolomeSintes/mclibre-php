<?php
/**
 * Poliagenda -  validar2.php
 * 
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2008 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2008-03-02
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
include("funciones.php");
$db = conectaDb();

$usuario   = recogeParaConsulta($db,'usuario');
$usuario   = quitaComillasExteriores($usuario); 
$password  = recogeParaConsulta($db,'password');
$password  = quitaComillasExteriores($password);
$password2 = recogeParaConsulta($db,'password2');
$password2 = quitaComillasExteriores($password2);

// Comprobación inicial por si se recarga la página nada más registrar un nuevo usuario
if (isset($_SESSION['multiagendaUsuario'])) {
    header('Location:index.php');
    exit();
} else {
    $tmpIdioma = $_SESSION['multiagendaIdioma'];
    session_destroy();
    session_start();
    $_SESSION['multiagendaIdioma']    = $tmpIdioma;
    if (!$usuario||($usuario=='menu_principal')) {
        header('Location:index.php?aviso='._('Nombre de usuario no permitido'));
        exit();
    } elseif ($password!=md5($password2)) {
        header('Location:index.php?aviso='._('Error: Las contraseñas no coinciden'));
        exit();
    } else {
        $consulta = "SELECT COUNT(*) FROM $dbUsuarios 
            WHERE usuario='$usuario'";
        $result = $db->query($consulta);
        if (!$result) {
            cabecera(_('Identificación').' 3', 'menu_principal');
            print "<p>"._('Error en la consulta').".</p>";
        } elseif ($result->fetchColumn()==1) {
            cabecera(_('Identificación').' 3', 'menu_principal');
            print "<p>"._('El nombre de usuario ya está registrado').".</p>";
        } else {
            $consulta = "SELECT COUNT(*) FROM $dbUsuarios";
            $result = $db->query($consulta);
            if (!$result) {
                print "<p>"._('Error en la consulta').".</p>";
            } elseif ($result->fetchColumn()>=$maxRegUsuarios) {
                print "<p>"._('Se ha alcanzado el número máximo de Usuarios que se pueden guardar')
                  .".</p>\n<p>"._('Por favor, borre algún registro antes').".</p>\n";
            } else {
                $consulta = "INSERT INTO $dbUsuarios 
                    VALUES (NULL, '$usuario', '$password', '$tmpIdioma')";
                if (!$db->query($consulta)) {
                    cabecera(_('Identificación').' 3', 'menu_principal');
                    print "<p>"._('Error al crear el registro').".<p>\n";
                } else {
                    $consulta = "SELECT * FROM $dbUsuarios 
                        WHERE usuario='$usuario'";
                    $result = $db->query($consulta);
                    if (!$result) {
                        cabecera(_('Identificación').' 3', 'menu_principal');
                        print "<p>"._('Error en la consulta').".</p>";
                    } else {
                        $valor = $result->fetch();
                        $_SESSION['multiagendaIdUsuario'] = $valor['id'];
                        $_SESSION['multiagendaUsuario']   = $valor['usuario'];
                        cabecera(_('Identificación').' 3', $usuario);
                        print "  <p>"._('Bienvenido/a').", <strong>$usuario</strong>. "._('Ya es usted un usuario registrado y puede crear su agenda').".</p>"; 
                    }
                }
            }
        }
        $db = NULL;
        pie();
    }
}
?>
