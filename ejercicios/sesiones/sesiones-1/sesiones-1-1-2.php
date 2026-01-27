<?php
/**
 * Sesiones (1) 1-2 - sesiones-1-1-2.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2026 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2026-01-27
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

// Accedemos a la sesión
session_name("sesiones-1-1");
session_start();

// Si la posición no está guardada en la sesión, ponemos el valor a cero
if (!isset($_SESSION["posicion"])) {
    $_SESSION["posicion"] = 0;
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

// Recogemos accion
$accion = recoge("accion");

// Dependiendo de la acción recibida, modificamos el número guardado
if ($accion == "centro") {
    $_SESSION["posicion"] = 0;
} elseif ($accion == "izquierda") {
    $_SESSION["posicion"] -= 20;
} elseif ($accion == "derecha") {
    $_SESSION["posicion"] += 20;
}

// Si el punto sale por un lado, entra por el otro
if ($_SESSION["posicion"] > 300) {
    $_SESSION["posicion"] = -300;
} elseif ($_SESSION["posicion"] < -300) {
    $_SESSION["posicion"] = 300;
}

// Volvemos al formulario
header("Location:sesiones-1-1-1.php");
