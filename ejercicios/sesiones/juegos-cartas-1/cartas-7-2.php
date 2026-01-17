<?php
/**
 * Cambio de cartas (1) - cartas-7-2.php
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

// Se accede a la sesión
session_name("cartas-7");
session_start();

if (!isset($_SESSION["baraja"])) {
    header("Location:cartas-7-1.php");
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
if (in_array($accion, ["0", "1", "2", "3", "4"]) && $_SESSION["cambios"] < 5) {
    $azar                         = array_rand($_SESSION["baraja"]);
    $_SESSION["jugador"][$accion] = $_SESSION["baraja"][$azar];
    unset($_SESSION["baraja"][$azar]);
    $_SESSION["cambios"] += 1;
    $_SESSION["puntos"] = 0;
    for ($i = 0; $i < 5; $i++) {
        $jugador2[$i] = substr($_SESSION["jugador"][$i], 1);
    }
    foreach (array_count_values($jugador2) as $indice => $valor) {
        $_SESSION["puntos"] += $indice * $valor * $valor;
    }
} elseif ($accion == "Reiniciar") {
    session_destroy();
}

header("Location:cartas-7-1.php");
