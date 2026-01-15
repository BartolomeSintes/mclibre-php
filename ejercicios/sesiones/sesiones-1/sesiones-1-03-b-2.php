<?php
/**
 * Sesiones (1) 02 - sesiones-1-03-b-2.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2025 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2025-02-08
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
session_name("sesiones-1-03-b");
session_start();

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

// Recogemos la palabra
$palabra = recoge("palabra");

// Borramos todos los datos anteriores
unset($_SESSION["intento"]);
unset($_SESSION["error"]);
unset($_SESSION["palabra"]);

// Comprobamos la palabra
if ($palabra == "") {
    // Si no se recibe palabra, guardamos en la sesión el mensaje de error
    $_SESSION["error"] = "No ha escrito ninguna palabra";
} elseif (!ctype_upper($palabra)) {
    // Si la palabra está en minúsculas, guardamos en la sesión el mensaje de error y el intento anterior
    $_SESSION["error"]   = "No ha escrito la palabra en mayúsculas";
    $_SESSION["intento"] = $palabra;
} else {
    // Si la palabra es correcta, borramos el error anterior que pudiera haber en la sesión
    $_SESSION["palabra"] = $palabra;
}

// Volvemos al formulario
header("Location:sesiones-1-03-b-1.php");
