<?php
/**
 * Muestra cartas (1) - cartas-1-2.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2021 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2022-01-08
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

// Se accede a la sesión
session_name("cartas-5");
session_start();

if (!isset($_SESSION["baraja"]) || !isset( $_SESSION["cartas"])) {
    header("Location:cartas-1-1.php");
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

$accion = recoge("accion");

if ($accion == "mas" && count($_SESSION["cartas"]) < 52) {
    $_SESSION["cartas"][]  = $_SESSION["baraja"][count($_SESSION["baraja"])-1];
    unset($_SESSION["baraja"][count($_SESSION["baraja"])-1]);
} elseif ($accion == "menos" && count($_SESSION["cartas"]) > 0) {
    // array_key_last() es para PHP > PHP 7.3
    $_SESSION["baraja"][]  = $_SESSION["cartas"][count($_SESSION["cartas"]) - 1];
    unset($_SESSION["cartas"][count($_SESSION["cartas"]) - 1]);
} elseif ($accion == "reiniciar") {
    session_destroy();
}

header("Location:cartas-1-1.php");
