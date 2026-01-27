<?php
/**
 * Cara o cruz - sesiones-2-13-2.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2025 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2025-02-08
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
session_name("sesiones-2-13");
session_start();

// Si falta una de las tres variables de sesión, redirigimos a la primera página
if (!isset($_SESSION["g"], $_SESSION["m"], $_SESSION["moneda"])) {
    header("Location:sesiones-2-13-b-1.php");
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

// Recogemos la acción
$siguiente = recoge("siguiente");

if ($siguiente == "Lanzar moneda") {
    // Si la acción es lanzar la moneda ...
    // Lanzamos la moneda
    $_SESSION["moneda"] = rand(1, 2);
    // Calculamos quién gana la ronda
    if ($_SESSION["moneda"] == 1) {
        $_SESSION["g"] += 1;
    } else {
        $_SESSION["m"] += 1;
    }
} elseif ($siguiente == "Volver a empezar") {
    // Si la acción es volver a empezar, reiniciamos las variables de sesión
    $_SESSION["moneda"] = 0;
    $_SESSION["g"]      = 0;
    $_SESSION["m"]      = 0;
}

// Volvemos a la primera página
header("Location:sesiones-2-13-b-1.php");
