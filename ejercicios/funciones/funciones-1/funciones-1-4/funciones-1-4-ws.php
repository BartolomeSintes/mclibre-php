<?php
/**
 * Convertidor de distancias y tiempos Servicio web - funciones-1-4-biblioteca.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2018 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2018-12-09
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

$num    = $_REQUEST["value"];
$uniOri = $_REQUEST["from"];
$uniFin = $_REQUEST["into"];

// La unidad intermedia es el metro
$numeroIntermedio = 0;
if ($uniOri == "km") {
    $numeroIntermedio = $num * 1000;
} elseif ($uniOri == "m") {
    $numeroIntermedio = $num;
} elseif ($uniOri == "cm") {
    $numeroIntermedio = $num / 100;
}

if ($uniFin == "km") {
    $numeroFinal = $numeroIntermedio / 1000;
} elseif ($uniFin == "m") {
    $numeroFinal = $numeroIntermedio;
} elseif ($uniFin == "cm") {
    $numeroFinal = $numeroIntermedio * 100;
}

print $numeroFinal;
