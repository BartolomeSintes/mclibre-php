<?php
/**
 * Poliagenda -  validar1.php
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
include ("funciones.php");
$db = conectaDb();

$usuario  = recogeParaConsulta($db,'usuario');
$usuario  = quitaComillasExteriores($usuario);
$password = recogeParaConsulta($db,'password');
$password = quitaComillasExteriores($password);

if (!$usuario||($usuario=='menu_principal')) {
    header('Location:index.php?aviso='._('Nombre de usuario no permitido'));
    exit();
} else {
    $consulta = "SELECT COUNT(*) FROM $dbUsuarios 
        WHERE usuario='$usuario'";
    $result = $db->query($consulta);
    if (!$result) {
        cabecera(_('Identificación').' 2', 'menu_principal');
        print "<p>"._('Error en la consulta').".</p>";
    } elseif ($result->fetchColumn()==0) {
        cabecera(_('Identificación').' 2', 'menu_principal');
        $consulta = "SELECT COUNT(*) FROM $dbUsuarios";
        $result = $db->query($consulta);
        if (!$result) {
            print "<p>"._('Error en la consulta').".</p>";
        } elseif ($result->fetchColumn()>=$maxRegUsuarios) {
            print "<p>"._('Se ha alcanzado el número máximo de Usuarios que se pueden guardar')
              .".</p>\n<p>"._('Por favor, borre algún registro antes').".</p>\n";
        } else {
            print "  <p><strong>$usuario</strong> "._('es un nuevo usuario. Por favor, repita la contraseña para registrarse como usuario').
            ".</p>
  <form action=\"validar2.php\" method=\"get\">
    <table>
      <tbody>
        <tr>
          <td>"._('Contraseña').":</td>
          <td><input type=\"password\" name=\"password2\" id=\"cursor\" /></td>
        </tr>
      </tbody>
    </table>
    <p><input type=\"submit\" value=\""._('Añadir')."\" />
      <input type=\"hidden\" name=\"usuario\" value=\"$usuario\" />
      <input type=\"hidden\" name=\"password\" value=\"".md5($password)
      ."\" /></p>
  </form>";  
        }
    } else {
        $consulta = "SELECT * FROM $dbUsuarios 
            WHERE usuario='$usuario'";
        $result = $db->query($consulta);
        if (!$result) {
            cabecera(_('Identificación').' 2', 'menu_principal');
            print "<p>Error en la consulta.</p>";
        } else {
            $valor = $result->fetch();
            if ($valor['password']==md5($password)) {
                $_SESSION['multiagendaIdUsuario'] = $valor['id'];
                $_SESSION['multiagendaUsuario']   = $valor['usuario'];
                header('Location:index.php');
                exit();
            }
            else { 
                header('Location:index.php?aviso='._('El usuario ya existe, pero la contraseña no es correcta'));
                exit();
            }
        }
    }
    $db = NULL;
    pie();
}
?>
