<?php
/**
 * Citas - cit-listar.php
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
include "biblioteca.php";
$db = conectaDb();

if (!isset($_SESSION["citasUsuario"])) {
    cabecera("Citas - Listar", "menu_principal");
} else {
    cabecera("Citas - Listar", "menu_citas");
}

$consulta = "SELECT COUNT(*) FROM $dbCitas";
$result = $db->query($consulta);
if (!$result) {
    print "    <p>Error en la consulta.</p>\n";
    print "\n";
} elseif ($result->fetchColumn() == 0) {
    print "    <p>No se han creado todavía citas.</p>\n";
    print "\n";
} else {
    // En esta consulta he tenido que añadir id_cita porque las dos
    // tablas tienen un campo id y quiero el id de la cita no del autor
    $consulta = "SELECT $dbCitas.id as id_cita, * FROM $dbCitas, $dbAutores
        WHERE $dbCitas.id_autor=$dbAutores.id
        ORDER BY apellidos ASC";
    $result = $db->query($consulta);
    if (!$result) {
        print "    <p>Error en la consulta.</p>\n";
        print "\n";
    } else {
        print "    <p>Estas son las citas creadas hasta el momento:</p>\n";
        print "\n";
        print "    <ul>\n";
        foreach ($result as $valor) {
            print "      <li>$valor[cita]. <strong>$valor[nombre] $valor[apellidos]</strong>";
            $consulta = "SELECT * FROM $dbEtiCitas, $dbEtiquetas
                WHERE $dbEtiCitas.id_cita=$valor[id_cita]
                AND $dbEtiCitas.id_etiqueta=$dbEtiquetas.id
                ORDER BY etiqueta ASC";
            $result = $db->query($consulta);
            if (!$result) {
                print "    <p>Error en la consulta.</p>\n";
                print "\n";
            } else {
                print " (";
                foreach ($result as $valor) {
                    print "$valor[etiqueta], ";
                }
                print ")";
            }
            print"</li>\n";
        }
        print "    </ul>\n";
    }
}
$db = NULL;
pie();
?>
