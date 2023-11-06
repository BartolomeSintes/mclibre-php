<?php
/**
 * Simon (5) - simon-5-3.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2022 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2022-11-29
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
session_name("simon-5");
session_start();

if (!isset($_SESSION["longitud"]) || !isset($_SESSION["objetivo"]) || !isset($_SESSION["jugador"]) || !isset($_SESSION["fallo"]) || !isset($_SESSION["completado"])) {
    header("Location:simon-5-1.php");
    exit;
}

// Función de recogida de datos
function recoge($key, $type = "")
{
    if ($type !== "" && $type !== []) {
        trigger_error("Function recoge(): argument #2 (\$type) must be an empty array or an empty string.", E_USER_ERROR);
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

$colores = ["red", "yellow", "green", "blue"];

$eleccion = recoge("eleccion");

if ($_SESSION["fallo"] && $eleccion == "Reintentar secuencia") {
    $_SESSION["jugador"] = [];
    $_SESSION["fallo"]   = false;
    header("Location:simon-5-1.php");
    exit;
}

if ($_SESSION["fallo"] && $eleccion == "Reiniciar") {
    session_destroy();
    header("Location:simon-5-1.php");
    exit;
}

if ($_SESSION["completado"] && $eleccion == "Siguiente nivel") {
    $_SESSION["longitud"] += 1;
    unset($_SESSION["objetivo"]);
    for ($i = 0; $i < $_SESSION["longitud"]; $i++) {
        $_SESSION["objetivo"][] = $colores[array_rand($colores)];
    }
    $_SESSION["jugador"]    = [];
    $_SESSION["fallo"]      = false;
    $_SESSION["completado"] = false;
    header("Location:simon-5-1.php");
    exit;
}

if ($_SESSION["completado"] && $eleccion == "Repetir nivel") {
    unset($_SESSION["objetivo"]);
    for ($i = 0; $i < $_SESSION["longitud"]; $i++) {
        $_SESSION["objetivo"][] = $colores[array_rand($colores)];
    }
    $_SESSION["jugador"]    = [];
    $_SESSION["fallo"]      = false;
    $_SESSION["completado"] = false;
    header("Location:simon-5-1.php");
    exit;
}

if (!$_SESSION["fallo"] && !$_SESSION["completado"] && in_array($eleccion, ["red", "yellow", "green", "blue"])) {
    $_SESSION["jugador"][] = $eleccion;
    $_SESSION["fallo"]     = false;
    for ($i = 0; $i < count($_SESSION["jugador"]); $i++) {
        if ($_SESSION["jugador"][$i] != $_SESSION["objetivo"][$i]) {
            $_SESSION["fallo"] = true;
        }
    }
    if (!$_SESSION["fallo"] && count($_SESSION["jugador"]) == count($_SESSION["objetivo"])) {
        $_SESSION["completado"] = true;
    }
}

header("Location:simon-5-2.php");
