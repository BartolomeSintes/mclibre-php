<?php
/**
 * Poliagenda -  listar.php
 * 
 * @author    Bartolom� Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2008 Bartolom� Sintes Marco
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
    cabecera(_('Listar'), $_SESSION['multiagendaUsuario']);

    $campo = recogeParaConsulta($db, 'campo', 'apellidos'); 
    $campo = quitaComillasExteriores($campo); 
    $orden = recogeParaConsulta($db, 'orden', 'ASC'); 
    $orden = quitaComillasExteriores($orden);
    
    $consulta = "SELECT COUNT(*) FROM $dbAgenda  
        WHERE id_usuario='$_SESSION[multiagendaIdUsuario]'";
    $result = $db->query($consulta);
    if (!$result) {
        print "<p>"._('Error en la consulta').".</p>\n";
    } elseif ($result->fetchColumn()==0) {
        print "<p>"._('No se ha creado todav�a ning�n registro').".</p>\n";
    } else {
        $consulta = "SELECT * FROM $dbAgenda 
            WHERE id_usuario='$_SESSION[multiagendaIdUsuario]'
            ORDER BY $campo $orden";
        $result = $db->query($consulta);
        if (!$result) {
            print "<p>"._('Error en la consulta').".</p>\n";
        } else {
            print "<p>"._('Listado completo de registros').":</p>\n<table border=\"1\">
      <thead>
        <tr class=\"neg\">
          <th><a href=\"$_SERVER[PHP_SELF]?campo=nombre&amp;orden=ASC\">
            <img src=\"abajo.png\" alt=\"A-Z\" title=\"A-Z\" /></a>
            "._('Nombre')."
            <a href=\"$_SERVER[PHP_SELF]?campo=nombre&amp;orden=DESC\">
            <img src=\"arriba.png\" alt=\"Z-A\" title=\"Z-A\" /></a></th>
          <th><a href=\"$_SERVER[PHP_SELF]?campo=apellidos&amp;orden=ASC\">
            <img src=\"abajo.png\" alt=\"A-Z\" title=\"A-Z\" /></a>
            "._('Apellidos')." 
            <a href=\"$_SERVER[PHP_SELF]?campo=apellidos&amp;orden=DESC\">
            <img src=\"arriba.png\" alt=\"Z-A\" title=\"Z-A\" /></a></th>
          <th><a href=\"$_SERVER[PHP_SELF]?campo=telefono&amp;orden=ASC\">
            <img src=\"abajo.png\" alt=\"0-9\" title=\"0-9\" /></a>
            "._('Tel�fono')."
            <a href=\"$_SERVER[PHP_SELF]?campo=telefono&amp;orden=DESC\">
            <img src=\"arriba.png\" alt=\"9-0\" title=\"9-0\" /></a></th>      
          <th><a href=\"$_SERVER[PHP_SELF]?campo=correo&amp;orden=ASC\">
            <img src=\"abajo.png\" alt=\"A-Z\" title=\"A-Z\" /></a>
            "._('Correo')."
            <a href=\"$_SERVER[PHP_SELF]?campo=correo&amp;orden=DESC\">
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
          <td>$valor[apellidos]</td>
          <td>$valor[telefono]</td>
          <td>$valor[correo]</td>\n    </tr>\n";
            }
            print "  </tbody>\n</table>\n";
        }
    }
    
    $db = NULL;
    pie();
}
?>
