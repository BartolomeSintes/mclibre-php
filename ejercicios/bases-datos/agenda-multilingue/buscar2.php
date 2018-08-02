<?php
/**
 * Poliagenda -  buscar2.php
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
if (!isset($_SESSION['multiagendaUsuario'])) {
    header('Location:index.php');
    exit();
} else {
    include('funciones.php');
    $db = conectaDb();
    cabecera(_('Buscar').' 2', $_SESSION['multiagendaUsuario']);

    $campo     = recogeParaConsulta($db, 'campo', 'apellidos');
    $campo     = quitaComillasExteriores($campo);
    $orden     = recogeParaConsulta($db, 'orden', 'ASC');
    $orden     = quitaComillasExteriores($orden);
    $nombre    = recogeParaConsulta($db, 'nombre');
    $nombre    = quitaComillasExteriores($nombre);
    $apellidos = recogeParaConsulta($db, 'apellidos');
    $apellidos = quitaComillasExteriores($apellidos);
    $telefono  = recogeParaConsulta($db, 'telefono');
    $telefono  = quitaComillasExteriores($telefono);
    $correo    = recogeParaConsulta($db, 'correo');
    $correo    = quitaComillasExteriores($correo);

    $consulta = "SELECT COUNT(*) FROM $dbAgenda
        WHERE id_usuario='$_SESSION[multiagendaIdUsuario]'
        AND nombre LIKE '%$nombre%'
        AND apellidos LIKE '%$apellidos%'
        AND telefono LIKE '%$telefono%'
        AND correo LIKE '%$correo%'";
    $result = $db->query($consulta);
    if (!$result) {
        print "<p>"._('Error en la consulta').".</p>\n";
    } elseif ($result->fetchColumn()==0) {
        print "<p>"._('No se han encontrado registros').".</p>\n";
    } else {
        $consulta = "SELECT * FROM $dbAgenda
            WHERE id_usuario='$_SESSION[multiagendaIdUsuario]'
            AND nombre LIKE '%$nombre%'
            AND apellidos LIKE '%$apellidos%'
            AND telefono LIKE '%$telefono%'
            AND correo LIKE '%$correo%'
            ORDER BY $campo $orden";
        $result = $db->query($consulta);
        if (!$result) {
            print "<p>"._('Error en la consulta').".</p>\n";
        } else {
            $datos = "nombre=$nombre&amp;apellidos=$apellidos&amp;"
                    ."telefono=$telefono&amp;correo=$correo&amp;campo";
            print "<p>"._('Registros encontrados').":</p>\n<table border=\"1\">
      <thead>
        <tr class=\"neg\">
          <th><a href=\"buscar2.php?$datos=nombre&amp;orden=ASC\">
            <img src=\"abajo.png\" alt=\"A-Z\" title=\"A-Z\" /></a>
            "._('Nombre')."
            <a href=\"buscar2.php?$datos=nombre&amp;orden=DESC\">
            <img src=\"arriba.png\" alt=\"Z-A\" title=\"Z-A\" /></a></th>
          <th><a href=\"buscar2.php?$datos=apellidos&amp;orden=ASC\">
            <img src=\"abajo.png\" alt=\"A-Z\" title=\"A-Z\" /></a>
            "._('Apellidos')."
            <a href=\"buscar2.php?$datos=apellidos&amp;orden=DESC\">
            <img src=\"arriba.png\" alt=\"Z-A\" title=\"Z-A\" /></a></th>
          <th><a href=\"buscar2.php?$datos=telefono&amp;orden=ASC\">
            <img src=\"abajo.png\" alt=\"0-9\" title=\"0-9\" /></a>
            "._('Teléfono')."
            <a href=\"buscar2.php?$datos=telefono&amp;orden=DESC\">
            <img src=\"arriba.png\" alt=\"9-0\" title=\"9-0\" /></a></th>
          <th><a href=\"buscar2.php?$datos=correo&amp;orden=ASC\">
            <img src=\"abajo.png\" alt=\"A-Z\" title=\"A-Z\" /></a>
            "._('Correo')."
            <a href=\"buscar2.php?$datos=correo&amp;orden=DESC\">
            <img src=\"arriba.png\" alt=\"Z-A\" title=\"Z-A\" /></a></th>
        </tr>
      </thead>
      <tbody>\n";
            $tmp = TRUE;
            foreach ($result as $valor) {
                if ($tmp) {
                    print "    <tr>\n";
                } else {
                    print "    <tr class=\"neg\">\n";
                }
                $tmp = !$tmp;
                print "      <td>$valor[nombre]</td>
          <td>$valor[apellidos]</td>\n      <td>$valor[telefono]</td>
          <td>$valor[correo]</td>\n    </tr>\n";
            }
            print "  </tbody>\n</table>\n";
        }
    }

    $db = NULL;
    pie();
}
?>
