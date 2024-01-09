<?php
/**
 * Sesiones Minijuegos (1) 5 - minijuegos-1-5-2-b.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2022 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2022-11-21
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
session_name("minijuegos-1-5-b");
session_start();

// Si los valores de sesión no existen, damos valor a las tres cartas
// Más adelante comprobamos qué jugada se ha obtenido
if (!isset($_SESSION["carta1"])) {
    $_SESSION["carta1"] = rand(1, 10);
    $_SESSION["carta2"] = rand(1, 10);
    $_SESSION["carta3"] = rand(1, 10);
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

// Si recibimos "nuevas", reiniciamos los valores de las cartas
if ($accion == "nuevas") {
    $_SESSION["carta1"] = rand(1, 10);
    $_SESSION["carta2"] = rand(1, 10);
    $_SESSION["carta3"] = rand(1, 10);
}

// Comprobamos si se ha obtenido un trío, una pareja o cartas distintas
if ($_SESSION["carta1"] == $_SESSION["carta2"] && $_SESSION["carta2"] == $_SESSION["carta3"]) {
    $_SESSION["mano"] = "un trío de $_SESSION[carta1]";
} elseif ($_SESSION["carta1"] == $_SESSION["carta2"] || $_SESSION["carta1"] == $_SESSION["carta3"]) {
    $_SESSION["mano"] = "una pareja de $_SESSION[carta1]";
} elseif ($_SESSION["carta2"] == $_SESSION["carta3"]) {
    $_SESSION["mano"] = "una pareja de $_SESSION[carta2]";
} else {
    $_SESSION["mano"] = "un " . max($_SESSION["carta1"], $_SESSION["carta2"], $_SESSION["carta3"]);
}

// Volvemos al formulario
header("Location:minijuegos-1-5-1-b.php");
