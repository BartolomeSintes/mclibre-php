<?php
/**
 * Foro - dis-insertar-2.php
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
cabecera("Discusiones - Añadir 2", "menuDiscusiones", "");

date_default_timezone_set(ZONA_HORARIA);

$titulo       = recogeParaConsulta($db, "titulo",       ANONIMO_TITULO);
$autor        = recogeParaConsulta($db, "autor",        ANONIMO_AUTOR);
$descripcion  = recogeParaConsulta($db, "descripcion",  ANONIMO_DESCRIPCION);
$fecha        = date("Y-m-d H:i:s");

if ($autor == "'" . ANONIMO_AUTOR . "'" && $titulo == "'" . ANONIMO_TITULO . "'" &&
    $descripcion == "'" . ANONIMO_DESCRIPCION . "'") {
    print "    <p>Hay que rellenar al menos uno de los campos. No se ha guardado el registro.</p>\n";
    print "\n";
} else {
    $consulta = "SELECT COUNT(*) FROM $dbDiscusiones";
    $result = $db->query($consulta);
    if (!$result) {
        print "    <p>Error en la consulta.</p>\n";
        print "\n";
    } elseif ($result->fetchColumn() >= MAX_REG_DISCUSIONES) {
        print "    <p>Se ha alcanzado el número máximo de discusión que se pueden guardar.</p>\n";
        print "\n";
        print "    <p>Por favor, borre alguna discusión antes.</p>\n";
        print "\n";
    } else {
        $consulta = "SELECT COUNT(*) FROM $dbDiscusiones
            WHERE titulo=$titulo
            AND autor=$autor
            AND descripcion=$descripcion";
        $result = $db->query($consulta);
        if (!$result) {
            print "    <p>Error en la consulta.</p>\n";
            print "\n";
        } elseif ($result->fetchColumn() != 0) {
            print "    <p>Ya existe una discusión con ese título, autor y descripción.</p>\n";
            print "\n";
        } else {
            $consulta = "INSERT INTO $dbDiscusiones
                VALUES (NULL, $titulo, $descripcion, $autor, '$fecha')";
            if ($db->query($consulta)) {
                print "    <p>Registro creado correctamente.</p>\n";
                print "\n";
            } else {
                print "    <p>Error al crear el registro.<p>\n";
                print "\n";
            }
        }
    }
}

pie();
