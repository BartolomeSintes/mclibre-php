<?php
/**
 * Biblioteca - pre_evolucion2.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2009 Bartolomé Sintes Marco
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

include('biblioteca.php');
$db = conectaDb();
cabecera('Préstamos - Devolución 2', CABECERA_SIN_CURSOR, 'menuPrestamos');

$id    = recogeParaConsulta($db, 'id');
$fecha = recogeParaConsulta($db, 'fecha');
$fechaOk = true;

if (!ctype_digit(substr($fecha, 1, 2)) ||!ctype_digit(substr($fecha, 4, 2))
    ||!ctype_digit(substr($fecha, 7, 4))) {
    $fechaOk = false;
} elseif (!checkdate((int)substr($fecha, 4, 2), (int)substr($fecha, 1, 2),
    (int)substr($fecha, 7, 4))) {
    $fechaOk = false;
}

if (!$fechaOk) {
    print "    <p>La fecha no es correcta: $fecha.</p>\n";
    print "\n";
} else {
    $consulta = "SELECT COUNT(*) FROM $dbPrestamos
        WHERE id=$id";
    $result = $db->query($consulta);
    if (!$result) {
        print "    <p>Error en la consulta.</p>\n";
        print "\n";
    } elseif ($result->fetchColumn() == 0) {
        print "    <p>El identificador de Préstamo no es correcto.</p>\n";
        print "\n";
    } else {
        $consulta = "SELECT * FROM $dbPrestamos
            WHERE id=$id";
        $result = $db->query($consulta);
        if (!$result) {
            print "    <p>Error en la consulta.</p>\n";
            print "\n";
        } else {
            $valor = $result->fetch();
            if (fechaAmd($fecha)<$valor['prestado']) {
                print "    <p>Error: fecha de devolución anterior a la de préstamo.</p>\n";
                print "\n";
            } else {
                $consulta = "UPDATE $dbPrestamos
                    SET devuelto='".fechaAmd($fecha)."'
                    WHERE id='$id'";
                if ($db->query($consulta)) {
                    print "    <p>Registro modificado correctamente.</p>\n";
                    print "\n";
                } else {
                    print "    <p>Error al crear el registro.<p>\n";
                    print "\n";
                }
            }
        }
    }
}

$db = NULL;
pie();
?>
