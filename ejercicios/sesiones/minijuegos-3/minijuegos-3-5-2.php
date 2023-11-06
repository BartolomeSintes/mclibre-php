<?php
/**
 * Mueve fichas - minijuegos-3-5-2.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2021 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2021-11-23
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

session_name("minijuegos-3-5");
session_start();

if (!isset($_SESSION["dado"]) || !isset($_SESSION["r"]) || !isset($_SESSION["g"]) || !isset($_SESSION["b"]) || !isset($_SESSION["mensaje"])) {
    header("Location:minijuegos-3-5-1.php");
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

$ficha = recoge("ficha");

if ($ficha == "Reiniciar") {
    session_destroy();
} elseif ($ficha == "r" && $_SESSION["r"] + $_SESSION["dado"] <= 7) {
    $_SESSION["r"] += $_SESSION["dado"];
    $_SESSION["dado"] = rand(1, 6);
} elseif ($ficha == "g" && $_SESSION["g"] + $_SESSION["dado"] <= 7) {
    $_SESSION["g"] += $_SESSION["dado"];
    $_SESSION["dado"] = rand(1, 6);
} elseif ($ficha == "b" && $_SESSION["b"] + $_SESSION["dado"] <= 7) {
    $_SESSION["b"] += $_SESSION["dado"];
    $_SESSION["dado"] = rand(1, 6);
}

if ($_SESSION["r"] == 7 && $_SESSION["g"] == 7 && $_SESSION["b"] == 7) {
    $_SESSION["mensaje"] = "¡Enhorabuena! Ha ganado.";
} elseif ($_SESSION["r"] + $_SESSION["dado"] > 7 && $_SESSION["g"] + $_SESSION["dado"] > 7 && $_SESSION["b"] + $_SESSION["dado"] > 7) {
    $_SESSION["mensaje"] = "¡Lo siento! Ha perdido. Pulse Reiniciar para jugar otra partida.";
}


header("Location:minijuegos-3-5-1.php");
