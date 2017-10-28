<?php
/**
 * Citas -  index.php
 *
 * @author    Bartolom� Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2008 Bartolom� Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2008-06-06
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

include('funciones.php');
$db = conectaDb();

$consulta = $consultaExisteTabla;
$result = $db->query($consulta);
if (!$result) {
    print "<p>Error en la consulta.</p>\n";
} elseif ($result->fetchColumn()==0) {
    cabecera('Primera conexi�n', 'menu_principal');
    print "<p>Aparentemente, la base de datos no existe. "
        ."Se crear� a continuaci�n.</p>";
    if ($dbMotor==MYSQL) {
        borraTodoMySQL($db);
    } elseif ($dbMotor==SQLITE) {
        borraTodoSqlite($db);
    }
} else {
    session_start();
    if (isset($_SESSION['citasUsuario'])) {
        cabecera('Inicio', $_SESSION['citasUsuario']);
    } else {
        cabecera('Identificaci�n 1', 'menu_principal');
        $aviso = recogeParaConsulta($db, 'aviso');
        $aviso = quitaComillasExteriores($aviso);
        if ($aviso) {
            print "<p style=\"color: red\">$aviso</p>\n";
        }
        print "<form action=\"validar-1.php\" method=\"get\">
  <p>Escriba su nombre de usuario y contrase�a:</p>
  <table>
    <tbody>
      <tr>
        <td>Nombre:</td>
        <td><input type=\"text\" name=\"usuario\" size=\"$tamUsuario\" id=\"cursor\" /></td>
      </tr>
      <tr>
        <td>Contrase�a:</td>
        <td><input type=\"password\" name=\"password\" size=\"$tamPassword\" /></td>
      </tr>
    </tbody>
  </table>
  <p><input type=\"submit\" value=\"A�adir\" /></p>
  <p><strong>Nota</strong>: Si no est� ya registrado, le registrar� como nuevo usuario.</p>
</form>\n";
    }
}
$db = NULL;
pie();
?>
