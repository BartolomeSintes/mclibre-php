<?php
/**
 * Hucha de monedas - sesiones-2-12-2.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2025 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2025-01-31
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

// Accedemos a la sesión
session_name("sesiones-2-12-1");
session_start();

// Si el ahorro no está guardado en la sesión, redirigimos a la primera página
if (!isset($_SESSION["ahorro"])) {
    header("Location:sesiones-2-12-1.php");
    exit;
}

// Función de recogida de datos
function recoge($key, $type = "")
{
    if (!is_string($key) && !is_int($key) || $key == "") {
        trigger_error("Function recoge(): Argument #1 (\$key) must be a non-empty string or an integer", E_USER_ERROR);
    } elseif ($type !== "" && $type !== []) {
        trigger_error("Function recoge(): Argument #2 (\$type) is optional, but if provided, it must be an empty array or an empty string", E_USER_ERROR);
    }
    $tmp = $type;
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

// Recogemos la moneda y la acción
$moneda = recoge("moneda");
$accion = recoge("accion");

if ($accion == "Vaciar hucha") {
    // Si la acción es vacíar la hucha, se vacía
    $_SESSION["ahorro"] = 0;
    // } elseif ($moneda == 0.01 || $moneda == 0.02 || $moneda == 0.05 || $moneda == 0.10
    //                                              || $moneda == 0.20 || $moneda == 0.50 || $moneda == 1 || $moneda == 2) {
} elseif (in_array($moneda, [0.01, 0.02, 0.05, 0.10, 0.20, 0.50, 1, 2])) {
    // Si llega una moneda, se añade
    $_SESSION["ahorro"] += $moneda;
}

// Volvemos a la primera página
header("Location:sesiones-2-12-1.php");
