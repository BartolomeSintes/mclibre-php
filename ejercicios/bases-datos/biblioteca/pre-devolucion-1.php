<?php
/**
 * Biblioteca - pre-devolucion-1.php
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

include('funciones.php');
$db = conectaDb();

date_default_timezone_set(ZONA_HORARIA);

$campo = recogeParaConsulta($db, 'campo', 'apellidos');
$campo = quitaComillasExteriores($campo);
$orden = recogeParaConsulta($db, 'orden', 'ASC');
$orden = quitaComillasExteriores($orden);

$consulta = "SELECT COUNT(*) FROM $dbPrestamos
    WHERE $dbPrestamos.devuelto='0000-00-00'";
$result = $db->query($consulta);
if (!$result) {
    cabecera('Pr�stamos - Devoluci�n 1', CABECERA_SIN_CURSOR, 'menuPrestamos');
    print "<p>Error en la consulta.</p>\n";
} elseif ($result->fetchColumn()==0) {
    cabecera('Pr�stamos - Devoluci�n 1', CABECERA_SIN_CURSOR, 'menuPrestamos');
    print "<p>No hay pr�stamos pendientes de devoluci�n.</p>\n";
} else {
    $consulta = "SELECT $dbPrestamos.id AS id, $dbUsuarios.nombre as nombre,
        $dbUsuarios.apellidos as apellidos, $dbObras.titulo as titulo,
        $dbPrestamos.prestado as prestado, $dbPrestamos.devuelto as devuelto
        FROM $dbPrestamos, $dbUsuarios, $dbObras
        WHERE $dbPrestamos.id_usuario=$dbUsuarios.id
        AND $dbPrestamos.id_obra=$dbObras.id
        AND $dbPrestamos.devuelto='0000-00-00'
        ORDER BY $campo $orden";
    $result = $db->query($consulta);
    if (!$result) {
        cabecera('Pr�stamos - Devoluci�n 1', CABECERA_SIN_CURSOR, 'menuPrestamos');
        print "<p>Error en la consulta.</p>\n";
    } else {
        cabecera('Pr�stamos - Devoluci�n 1', CABECERA_CON_CURSOR, 'menuPrestamos');
        print "<form action=\"pre-devolucion-2.php\" method=\"".FORM_METHOD."\">
  <p>Seleccione el pr�stamo pendiente e indique la fecha de devoluci�n:</p>
  <table border=\"1\">
    <thead>
      <tr class=\"neg\">
        <th><a href=\"$_SERVER[PHP_SELF]?campo=apellidos&amp;orden=ASC\">
          <img src=\"abajo.png\" alt=\"A-Z\" title=\"A-Z\" /></a>
          Usuario
          <a href=\"$_SERVER[PHP_SELF]?campo=apellidos&amp;orden=DESC\">
          <img src=\"arriba.png\" alt=\"Z-A\" title=\"Z-A\" /></a> &nbsp; -
          &nbsp; <a href=\"$_SERVER[PHP_SELF]?campo=titulo&amp;orden=ASC\">
          <img src=\"abajo.png\" alt=\"A-Z\" title=\"A-Z\" /></a>
          T�tulo
          <a href=\"$_SERVER[PHP_SELF]?campo=titulo&amp;orden=DESC\">
          <img src=\"arriba.png\" alt=\"Z-A\" title=\"Z-A\" /></a> &nbsp; -
          &nbsp; <a href=\"$_SERVER[PHP_SELF]?campo=prestado&amp;orden=ASC\">
          <img src=\"abajo.png\" alt=\"0-9\" title=\"0-9\" /></a>
          Fecha pr�stamo
          <a href=\"$_SERVER[PHP_SELF]?campo=prestado&amp;orden=DESC\">
          <img src=\"arriba.png\" alt=\"9-0\" title=\"9-0\" /></a></th>
        <th>Fecha de devoluci�n (dd-mm-aaaa)</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>\n          <select name=\"id\">\n";
        foreach ($result as $valor) {
            print "            <option value=\"$valor[id]\">$valor[apellidos], "
            ."$valor[nombre] - $valor[titulo] - ".fechaDma($valor['prestado'])
            ."</option>\n";
        }
        print "          </select>\n        </td>\n        <td>
          <input type=\"text\" name=\"fecha\" size=\"".TAM_FECHA."\" "
          ."maxlength=\"".TAM_FECHA."\" value=\"".date('d-m-Y')."\" id=\"cursor\" />
        </td>\n      </tr>
    </tbody>\n  </table>\n
  <p><input type=\"submit\" value=\"Guardar devoluci�n\" /></p>\n</form>\n";
    }
}

$db = NULL;
pie();
?>
