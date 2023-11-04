<?php
/**
 * Simon (2) - simon-2-2.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2021 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2021-11-30
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
session_name("simon-2");
session_start();

if (!isset($_SESSION["jugador"])) {
    header("Location:simon-2-1.php");
    exit;
}

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

$eleccion = recoge("eleccion");

if ($eleccion == "Reiniciar") {
    session_destroy();
}

if ($_SESSION["completado"] || $_SESSION["fallo"]) {
    header("Location:simon-2-1.php");
    exit;
}

if (in_array($eleccion, ["red", "yellow", "green", "blue"])) {
    $_SESSION["jugador"][] = $eleccion;
    $_SESSION["fallo"] = false;
    for ($i = 0; $i < count($_SESSION["jugador"]); $i++) {
        if ($_SESSION["jugador"][$i] != $_SESSION["objetivo"][$i]) {
            $_SESSION["fallo"] = true;
        }
    }
    if (!$_SESSION["fallo"] && count($_SESSION["jugador"]) == count($_SESSION["objetivo"])) {
        $_SESSION["completado"] = true;
    }
}

header("Location:simon-2-1.php");
