<?php

/**
 * Sesiones (2) 02 - sesiones-2-6-2.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2026 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2026-01-29
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
session_name("sesiones-2-6");
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

// Recogemos la palabra1
$palabra1 = recoge("palabra1");

// Comprobamos la palabra1
if ($palabra1 == "") {
    // Si no hay palabra1, guardamos el aviso en la sesión
    $_SESSION["aviso1"] = "No ha escrito nada";
    // y volvemos a la página 1
    header("Location:sesiones-2-6-1.php");
    exit;
} elseif (!ctype_alnum($palabra1)) {
    // Si la palabra1 no son todo letras o números, guardamos el aviso en la sesión
    $_SESSION["aviso1"] = "No ha escrito una sola palabra con letras y números";
    // y volvemos a la página 1
    header("Location:sesiones-2-6-1.php");
    exit;
} else {
    // Si hay palabra1, borramos el aviso que se podría haber generado en intentos anteriores,
    unset($_SESSION["aviso1"]);
    // guardamos la palabra1 en la sesión
    $_SESSION["palabra1"] = $palabra1;
    // y pasamos a la página 3
    header("Location:sesiones-2-6-3.php");
    exit;
}
