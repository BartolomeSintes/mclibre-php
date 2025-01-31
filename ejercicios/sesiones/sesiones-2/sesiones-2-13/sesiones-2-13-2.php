<?php
/**
 * Cara o cruz - sesiones-2-13-2.php
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
session_name("sesiones-2-13");
session_start();

// Si falta una de los dos variables de sesión, redirigimos a la primera página
if (!isset($_SESSION["puntosG"], $_SESSION["puntosM"], $_SESSION["moneda"])) {
    header("Location:sesiones-2-13-1.php");
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
    $moneda = rand(1, 2);

    // Calculamos quién gana el turno y la imagen de la moneda
    if ($moneda == 1) {
        $_SESSION["puntosG"] += 1;
        $_SESSION["moneda"] = "<img src=\"img/a.svg\" alt=\"A\" width=\"100\" height=\"100\">";
    } else {
        $_SESSION["puntosM"] += 1;
        $_SESSION["moneda"] = "<img src=\"img/b.svg\" alt=\"B\" width=\"100\" height=\"100\">";
    }

    // Calculamos la cara del gato y del mono
    if ($_SESSION["puntosG"] > $_SESSION["puntosM"]) {
        $_SESSION["caraG"] = "&#128568;";
        $_SESSION["caraM"] = "&#128584;";
    } elseif ($_SESSION["puntosG"] < $_SESSION["puntosM"]) {
        $_SESSION["caraG"] = "&#128576;";
        $_SESSION["caraM"] = "&#128053;";
    } else {
        $_SESSION["caraG"] = "&#128572;";
        $_SESSION["caraM"] = "&#128586;";
    }
} elseif ($siguiente == "Volver a empezar") {
    // Si la acción es volver a empezar, destruimos la sesión
    session_destroy();
}

// Volvemos a la primera página
header("Location:sesiones-2-13-1.php");
