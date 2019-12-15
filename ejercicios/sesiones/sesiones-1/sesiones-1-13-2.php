<?php
/**
 * Sesiones (1) 05 - sesiones-1-13-2.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2018 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2018-11-13
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
session_name("sesiones-1-13");
session_start();

// Si alguna posición no está guardada en la sesión, pone a cero las dos
if (!isset($_SESSION["x"]) || !isset($_SESSION["y"])) {
    $_SESSION["x"] = $_SESSION["y"] = 0;
}

// Funciones auxiliares
function recoge($var, $m = "")
{
    if (!isset($_REQUEST[$var])) {
        $tmp = (is_array($m)) ? [] : "";
    } elseif (!is_array($_REQUEST[$var])) {
        $tmp = trim(htmlspecialchars($_REQUEST[$var], ENT_QUOTES, "UTF-8"));
    } else {
        $tmp = $_REQUEST[$var];
        array_walk_recursive($tmp, function (&$valor) {
            $valor = trim(htmlspecialchars($valor, ENT_QUOTES, "UTF-8"));
        });
    }
    return $tmp;
}

// Recogida de accion
$accion   = recoge("accion");

// Dependiendo de la acción recibida, modifica el número guardado
if ($accion == "centro") {
    $_SESSION["x"] = $_SESSION["y"] = 0;
} elseif ($accion == "izquierda") {
    $_SESSION["x"] -= 20;
} elseif ($accion == "derecha") {
    $_SESSION["x"] += 20;
} elseif ($accion == "arriba") {
    $_SESSION["y"] -= 20;
} elseif ($accion == "abajo") {
    $_SESSION["y"] += 20;
}

// si sale por un lado, entra por el otro
if ($_SESSION["x"] > 200) {
    $_SESSION["x"] = -200;
} elseif ($_SESSION["x"] < -200) {
    $_SESSION["x"] = 200;
}

// si sale por un lado, entra por el otro
if ($_SESSION["y"] > 200) {
    $_SESSION["y"] = -200;
} elseif ($_SESSION["y"] < -200) {
    $_SESSION["y"] = 200;
}

// y vuelve al formulario
header("Location:sesiones-1-13-1.php");
?>
