<?php
/**
 * Biblioteca - pre-insertar-1.php
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

date_default_timezone_set(ZONA_HORARIA);

$consulta = "SELECT COUNT(*) FROM $dbPrestamos";
$result = $db->query($consulta);
if (!$result) {
    cabecera("Préstamos - Nuevo préstamo 1", "menuPrestamos");
    print "    <p>Error en la consulta.</p>\n";
    print "\n";
} elseif ($result->fetchColumn() >= MAX_REG_PRESTAMOS) {
    cabecera("Préstamos - Nuevo préstamo 1", "menuPrestamos");
    print "    <p>Se ha alcanzado el número máximo de registros que se pueden guardar.</p>\n";
    print "\n";
    print "    <p>Por favor, borre algún registro antes.</p>\n";
    print "\n";
} else {
    $consultaObras = "SELECT COUNT(*) FROM $dbObras";
    $resultObras = $db->query($consultaObras);
    $consultaUsuarios = "SELECT COUNT(*) FROM $dbUsuarios";
    $resultUsuarios = $db->query($consultaUsuarios);
    if (!$resultObras) {
        cabecera("Préstamos - Nuevo préstamo 1", "menuPrestamos");
        print "    <p>Error en la consulta de Obras.</p>\n";
        print "\n";
    } elseif (!$resultUsuarios) {
        cabecera("Préstamos - Nuevo préstamo 1", "menuPrestamos");
        print "    <p>Error en la consulta de Usuarios.</p>\n";
        print "\n";
    } elseif ($resultObras->fetchColumn() == 0) {
        cabecera("Préstamos - Nuevo préstamo 1", "menuPrestamos");
        print "    <p>No se ha creado todavía ningún registro de Obras.</p>\n";
        print "\n";
    } elseif ($resultUsuarios->fetchColumn() == 0) {
        cabecera("Préstamos - Nuevo préstamo 1", "menuPrestamos");
        print "    <p>No se ha creado todavía ningún registro de Usuarios.</p>\n";
        print "\n";
    } else {
        $consultaUsuarios = "SELECT * FROM $dbUsuarios
            ORDER BY apellidos ASC";
        $resultUsuarios = $db->query($consultaUsuarios);
        $consultaObras = "SELECT * FROM $dbObras
            ORDER BY autor ASC";
        $resultObras = $db->query($consultaObras);
        if (!$resultObras) {
            cabecera("Préstamos - Nuevo préstamo 1", "menuPrestamos");
            print "    <p>Error en la consulta de Obras.</p>\n";
            print "\n";
        } elseif (!$resultUsuarios) {
            cabecera("Préstamos - Nuevo préstamo 1", "menuPrestamos");
            print "    <p>Error en la consulta de Usuarios.</p>\n";
            print "\n";
        } else {
            cabecera("Préstamos - Nuevo préstamo 1", "menuPrestamos");
            print "    <form action=\"pre-insertar-2.php\" method=\"" . FORM_METHOD . "\">\n";
            print "      <p>Seleccione obra y usuario e indique la fecha del préstamo:</p>\n";
            print "\n";
            print "      <table border=\"1\">\n";
            print "        <thead>\n";
            print "          <tr class=\"neg\">\n";
            print "            <th>Usuario</th>\n";
            print "            <th>Obra</th>\n";
            print "            <th>Fecha de préstamo (dd-mm-aaaa)</th>\n";
            print "          </tr>\n";
            print "        </thead>\n";
            print "        <tbody>\n";
            print "          <tr>\n";
            print "            <td>\n";
            print "              <select name=\"id_usuario\">\n";
            foreach ($resultUsuarios as $valor) {
                print "                <option value=\"$valor[id]\">$valor[nombre] "
                    . "$valor[apellidos] - $valor[dni]</option>\n";
            }
            print "              </select>\n";
            print "            </td>\n";
            print "            <td>\n";
            print "              <select name=\"id_obra\">\n";
            foreach ($resultObras as $valor) {
                print "                <option value=\"$valor[id]\">$valor[autor] "
                    . "- $valor[titulo]</option>\n";
            }
            print "              </select>\n";
            print "            </td>\n";
            print "            <td>\n";
            print "              <input type=\"text\" name=\"fecha\" size=\"" . TAM_FECHA . "\" "
                . "maxlength=\"" . TAM_FECHA . "\" value=\"" . date("d-m-Y") . "\" autofocus>\n";
            print "            </td>\n";
            print "          </tr>\n";
            print "        </tbody>\n";
            print "      </table>\n";
            print "\n";
            print "      <p><input type=\"submit\" value=\"Añadir\"></p>\n";
            print "    </form>\n";
            print "\n";
        }
    }
}

$db = NULL;
pie();
?>
