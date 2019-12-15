<?php
/**
 * Citas - eti-listar.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2008 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2008-06-06
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

session_start();
include "biblioteca.php";
$db = conectaDb();

if (!isset($_SESSION["citasUsuario"])) {
    cabecera("Etiquetas - Listar", "menu_principal");
} else {
    cabecera("Etiquetas - Listar", "menu_etiquetas");
}

$consulta = "SELECT COUNT(*) FROM $dbEtiquetas";
$result = $db->query($consulta);
if (!$result) {
    print "    <p>Error en la consulta.</p>\n";
    print "\n";
} elseif ($result->fetchColumn() == 0) {
    print "    <p>No se han creado todavía etiquetas.</p>\n";
    print "\n";
} else {
    $max = 0;
    $min = $maxRegUsuarios;
    $consulta = "SELECT * FROM $dbEtiquetas
        ORDER BY etiqueta ASC";
    $result = $db->query($consulta);
    if (!$result) {
        print "    <p>Error en la consulta.</p>\n";
        print "\n";
    } else {
        foreach ($result as $valor) {
        $consulta = "SELECT COUNT (*) FROM $dbEtiCitas
            WHERE id_etiqueta=$valor[id]";
        $result2 = $db->query($consulta);
        if (!$result) {
            print "    <p>Error en la consulta.</p>\n";
            print "\n";
        } else {
            $num = $result2->fetchColumn();
            if ($num>$max) {
                $max = $num;
            }
            if ($num<$min) {
                    $min = $num;
            }
        }
    }
    $consulta = "SELECT * FROM $dbEtiquetas
        ORDER BY etiqueta ASC";
    $result = $db->query($consulta);
        if (!$result) {
            print "    <p>Error en la consulta.</p>\n";
            print "\n";
        } else {
            print "    <p>Estas son las etiquetas definidas hasta el momento, con un tamaño proporcional a su popularidad:</p>\n";
            print "\n";
            print "    <p>\n";
            foreach ($result as $valor) {
                $consulta = "SELECT COUNT (*) FROM $dbEtiCitas
                    WHERE id_etiqueta=$valor[id]";
                $result2 = $db->query($consulta);
                if (!$result) {
                    print "    <p>Error en la consulta.</p>\n";
                    print "\n";
                } else {
                    $num = $result2->fetchColumn();
                    if ($max != $min) {
                        $tamanyo = $minFontSize+round(($num-$min)*($maxFontSize-$minFontSize)/($max-$min));
                    } else {
                        $tamanyo = round(($minFontSize+$maxFontSize)/2);
                    }
                    print "      <span style=\"font-size:{$tamanyo}%\">$valor[etiqueta]</span>\n";
                }
            }
            print "    </p>\n";
        }
    }
}

$db = NULL;
pie();
?>
