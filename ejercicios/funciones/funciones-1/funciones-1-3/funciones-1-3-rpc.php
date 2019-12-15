<?php
/**
 * Convertidor de distancias (3) JSON-RPC - funciones-1-3-rpc.php
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


function convierte($num, $uniOri, $uniFin) {
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
    return $numeroFinal;
}

$validParams = ["km", "m", "cm"];

$peticionOk = false;
if ($_REQUEST["method"] == "convertir") {
    if (in_array($_REQUEST["params"]["from"], $validParams)) {
        if (in_array($_REQUEST["params"]["into"], $validParams)) {
            $peticionOk = true;
        }
    }
}

if ($peticionOk == true) {
    $result = convierte($_REQUEST["params"]["value"],$_REQUEST["params"]["from"], $_REQUEST["params"]["into"]);
    print "{\"jsonrpc\" : \"2.0\", \"result\" : $result, \"id\" : $_REQUEST[id] }";
} else {
    print "{\"jsonrpc\" : \"2.0\", \"error\" : -1, \"id\" : $_REQUEST[id] }";
}
