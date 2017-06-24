<?php
/**
 * Citas -  adm_borrareti1.php
 * 
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2008 Bartolomé Sintes Marco
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

session_start();
include('funciones.php');

if (!isset($_SESSION['citasUsuario']) || ($_SESSION['citasUsuario']!=$administradorNombre)) {
    header('Location:index.php');
    exit();
} else {
    $db = conectaDb();
    cabecera('Borrar etiquetas 1', $_SESSION['citasUsuario']);
    
    $campo = recogeParaConsulta($db, 'campo', 'etiqueta'); 
    $campo = quitaComillasExteriores($campo); 
    $orden = recogeParaConsulta($db, 'orden', 'ASC'); 
    $orden = quitaComillasExteriores($orden);
    
    $consulta = "SELECT COUNT(*) FROM $dbEtiquetas";
    $result = $db->query($consulta);
    if (!$result) {
        print "<p>Error en la consulta.</p>\n";
    } elseif ($result->fetchColumn()==0) {
        print "<p>No hay ninguna etiqueta definida.</p>\n";
    } else {
        $consulta = "SELECT * FROM $dbEtiquetas
            ORDER BY $campo $orden";
        $result = $db->query($consulta);
        if (!$result) {
            print "<p>Error en la consulta.</p>\n";
        } else {
            print "<form action=\"adm_borrareti2.php\" method=\"get\">
  <p>Marque las etiquetas a borrar:</p>\n
  <table border=\"1\">
    <thead>
      <tr class=\"neg\">
        <th>Elegir</th>
        <th><a href=\"$_SERVER[PHP_SELF]?campo=etiqueta&amp;orden=ASC\">
          <img src=\"abajo.png\" alt=\"A-Z\" title=\"A-Z\" /></a>
          Etiqueta
          <a href=\"$_SERVER[PHP_SELF]?campo=etiqueta&amp;orden=DESC\">
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
        <td>$valor[etiqueta]</td>\n      </tr>\n";
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
