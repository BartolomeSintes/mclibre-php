<?php
/**
 * Convertidor de distancias y tiempos Con biblioteca - funciones-1-4-biblioteca.php
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

// Función de recogida de datos
function recoge($key, $type = "")
{
    if ($type != "" && $type != []) {
        trigger_error("Function recoge(): argument #2 (\$type) must be an empty array or an empty string.", E_USER_ERROR);
    }
    $tmp = is_array($type) ? [] : "";
    if (isset($_REQUEST[$key])) {
        if (!is_array($_REQUEST[$key]) && !is_array($type)) {
            $tmp = trim(htmlspecialchars($_REQUEST[$key]));
        } elseif (is_array($_REQUEST[$key]) && is_array($type)) {
            $tmp = $_REQUEST[$key];
            array_walk_recursive($tmp, function (&$value) {
                $value = trim(htmlspecialchars($value));
            });
        }
    }
    return $tmp;
}

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
