<?php
/**
 * Blog - leer.php
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

$fecha = recogeFecha($db, 'fecha');

cabecera('Leer', CABECERA_SIN_CURSOR, $fecha);
calendario($fecha, 'leer');

$consulta = "SELECT COUNT(*) FROM $dbEntradas
    WHERE fecha='$fecha'";
$result = $db->query($consulta);
if (!$result) {
    print "<p>Error en la consulta.</p>\n";
} else {
    print "<div class=\"entrada\">\n  <h2>$fecha</h2>\n  <p>";
    if ($result->fetchColumn()!=0) {
        $consulta = "SELECT * FROM $dbEntradas
            WHERE fecha='$fecha'";
        $result = $db->query($consulta);
        $valor = $result->fetch();
            print $valor['entrada'];
    } else {
        print "Todav�a no se ha escrito la entrada de este d�a.";
    }
    print"  </p>\n</div>\n";
}

$db = NULL;
pie();
?>
