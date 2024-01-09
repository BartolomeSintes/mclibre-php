<?php
/**
 * Blog - editar.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2009 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2009-05-21
 * @link      https://www.mclibre.org
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

include "biblioteca.php";
$db = conectaDb();

$fecha = recogeFecha($db, "fecha");

$consulta = "SELECT COUNT(*) FROM $dbEntradas";

$result = $db->query($consulta);
if (!$result) {
    cabecera("Editar", CABECERA_SIN_CURSOR, $fecha);
    calendario($fecha, "editar");
    print "    <p>Error en la consulta.</p>\n";
    print "\n";
} elseif ($result->fetchColumn() >= MAX_REG_ENTRADAS) {
    cabecera("Editar", CABECERA_SIN_CURSOR, $fecha);
    calendario($fecha, "editar");
    print "    <p>Se ha alcanzado el número máximo de registros que se pueden guardar.</p>\n";
    print "\n";
    print "    <p>Por favor, borre algún registro antes.</p>\n";
    print "\n";
} else {
    $consulta = "SELECT * FROM $dbEntradas
        WHERE fecha='$fecha'";
    $result = $db->query($consulta);
    if (!$result) {
        cabecera("Editar", CABECERA_SIN_CURSOR, $fecha);
        calendario($fecha, "editar");
        print "    <p>Error en la consulta.</p>\n";
        print "\n";
    } else {
        $valor = $result->fetch();
        cabecera("Editar", CABECERA_CON_CURSOR, $fecha);
        calendario($fecha, "editar");
        print "    <div class=\"entrada\">\n";
        print "      <h2>$fecha</h2>\n";
        print "\n";
        print "      <form action=\"insertar.php\" method=\"" . FORM_METHOD . "\" >\n";
        print "        <p>\n";
        print "          <textarea name=\"entrada\" cols=\"70\" rows=\"12\">$valor[entrada]</textarea>\n";
        print "        </p>\n";
        print "\n";
        print "        <p>\n";
        print "          <input type=\"hidden\" name=\"fecha\" value=\"$fecha\" />\n";
        print "          <input type=\"submit\" value=\"Guardar\" />\n";
        print "        </p>\n";
        print "      </form>\n";
        print "    </div>\n";
        print "\n";
    }
}

pie();
