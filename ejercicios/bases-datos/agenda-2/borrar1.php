<?php
/**
 * Multiagenda -  borrar1.php
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
session_start();

if (!isset($_SESSION['multiagendaUsuario'])) {
    header('Location:index.php');
    exit();
} else {
    $db = conectaDb();
    cabecera('Borrar 1', CABECERA_SIN_CURSOR, $_SESSION['multiagendaUsuario']);

    $campo = recogeParaConsulta($db, 'campo', 'apellidos');
    $campo = quitaComillasExteriores($campo);
    $orden = recogeParaConsulta($db, 'orden', 'ASC');
    $orden = quitaComillasExteriores($orden);

    $consulta = "SELECT COUNT(*) FROM $dbAgenda
         WHERE id_usuario='$_SESSION[multiagendaIdUsuario]'";
    $result = $db->query($consulta);
    if (!$result) {
        print "<p>Error en la consulta.</p>\n";
    } elseif ($result->fetchColumn()==0) {
        print "<p>No se ha creado todav�a ning�n registro.</p>\n";
    } else {
        $consulta = "SELECT * FROM $dbAgenda
            WHERE id_usuario='$_SESSION[multiagendaIdUsuario]'
            ORDER BY $campo $orden";
        $result = $db->query($consulta);
        if (!$result) {
            print "<p>Error en la consulta.</p>\n";
        } else {
            print "<form action=\"borrar2.php\" method=\"".FORM_METHOD."\">
      <p>Marque los registros que quiera borrar:</p>
      <table border=\"1\">
        <thead>
          <tr class=\"neg\">
            <th>Borrar</th>
            <th><a href=\"$_SERVER[PHP_SELF]?campo=nombre&amp;orden=ASC\">
              <img src=\"abajo.png\" alt=\"A-Z\" title=\"A-Z\" /></a>
              Nombre
              <a href=\"$_SERVER[PHP_SELF]?campo=nombre&amp;orden=DESC\">
              <img src=\"arriba.png\" alt=\"Z-A\" title=\"Z-A\" /></a></th>
            <th><a href=\"$_SERVER[PHP_SELF]?campo=apellidos&amp;orden=ASC\">
              <img src=\"abajo.png\" alt=\"A-Z\" title=\"A-Z\" /></a>
              Apellidos
              <a href=\"$_SERVER[PHP_SELF]?campo=apellidos&amp;orden=DESC\">
              <img src=\"arriba.png\" alt=\"Z-A\" title=\"Z-A\" /></a></th>
            <th><a href=\"$_SERVER[PHP_SELF]?campo=telefono&amp;orden=ASC\">
              <img src=\"abajo.png\" alt=\"0-9\" title=\"0-9\" /></a>
              Tel�fono
              <a href=\"$_SERVER[PHP_SELF]?campo=telefono&amp;orden=DESC\">
              <img src=\"arriba.png\" alt=\"9-0\" title=\"9-0\" /></a></th>
            <th><a href=\"$_SERVER[PHP_SELF]?campo=correo&amp;orden=ASC\">
              <img src=\"abajo.png\" alt=\"A-Z\" title=\"A-Z\" /></a>
              Correo
              <a href=\"$_SERVER[PHP_SELF]?campo=correo&amp;orden=DESC\">
              <img src=\"arriba.png\" alt=\"Z-A\" title=\"Z-A\" /></a></th>
          </tr>
        </thead>
        <tbody>\n";
            $tmp = TRUE;
            foreach ($result as $valor) {
                if ($tmp) {
                    print "      <tr>\n";
                } else {
                    print "      <tr class=\"neg\">\n";
                }
                $tmp = !$tmp;
                print "        <td align=\"center\"><input type=\"checkbox\" "
              ."name=\"id[$valor[id]]\" /></td>
            <td>$valor[nombre]</td>
            <td>$valor[apellidos]</td>
            <td>$valor[telefono]</td>
            <td>$valor[correo]</td>
          </tr>\n";
            }
            print "    </tbody>\n  </table>
      <p><input type=\"submit\" value=\"Borrar\" /></p>
    </form>\n";
        }
    }

    $db = NULL;
    pie();
}
?>
