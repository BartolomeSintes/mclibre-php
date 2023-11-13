<?php
/**
 * Memorión (4) - memorion-4-2.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2022 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2022-12-02
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

// Nos unimos a la sesión
session_name("memorion-4");
session_start();

// Si no está definido en la sesión el número de dibujos ....
if (!isset($_SESSION["numeroDibujos"])) {
    // ... guardamos el número de dibujos en la sesión
    $_SESSION["numeroDibujos"] = 5;
}

// Si no están definidos en la sesión los dibujos de la partida ....
if (!isset($_SESSION["dibujos"])) {
    // Matriz con todos los valores posibles (61 valores)
    $valores = range(128000, 128060);
    // Los barajamos
    shuffle($valores);
    // Guardamos los N primeros (N es el número de dibujos)
    for ($i = 0; $i < $_SESSION["numeroDibujos"]; $i++) {
        $_SESSION["dibujos"][$i] = $valores[$i];
    }
    // Duplicamos los valores (creamos valores de N a 2N-1)
    for ($i = 0; $i < $_SESSION["numeroDibujos"]; $i++) {
        $_SESSION["dibujos"][$_SESSION["numeroDibujos"] + $i] = $valores[$i];
    }
    // Los barajamos de nuevo
    shuffle($_SESSION["dibujos"]);

    // Guardamos las fichas boca abajo
    for ($i = 0; $i < 2 * $_SESSION["numeroDibujos"]; $i++) {
        $_SESSION["lado"][$i] = "dorso";
    }

    // No se ha elegido ni la primera ficha ni la segunda de la jugada
    $_SESSION["primera"] = -1;
    $_SESSION["segunda"] = -1;
}

// Funciones auxiliares
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

// Recogemos los datos (botón y ficha)
$accion = recoge("accion");
$gira   = recoge("gira");

// Variables auxiliares comprobación de datos
$accionOk = false;
$giraOk   = false;

// Validamos el dato recibido, sin hacer nada si el dato no es válido
if ($gira == "") {
} elseif (!is_numeric($gira)) {
} elseif (!ctype_digit($gira)) {
} elseif ($gira < 0 || $gira > 2 * $_SESSION["numeroDibujos"] - 1) {
} else {
    $giraOk = true;
}

// Validamos el dato recibido, sin hacer nada si el dato no es válido
if ($accion != "numero" && $accion != "nueva") {
} else {
    $accionOk = true;
}

// Si el dato es válido ...
if ($giraOk || $accionOk) {
    // Si se ha pulsado "Nueva partida" ...
    if ($accion == "nueva") {
        // ... borramos la partida actual
        unset($_SESSION["dibujos"]);
        // ... y redirigimos a la primera página
        header("Location:memorion-4-1.php");
        exit;
    }

    // Si se ha pulsado "Cambiar número de dibujos" ...
    if ($accion == "numero") {
        // ... redirigimos al formulario correspondiente
        header("Location:memorion-4-3.php");
        exit;
    }

    // Si se ha pulsado una ficha que está boca abajo ...
    if ($_SESSION["lado"][$gira] == "dorso") {
        // ... la giramos
        $_SESSION["lado"][$gira] = "dibujo";
        // Si no hay ninguna ficha girada ...
        if ($_SESSION["primera"] == -1) {
            // ... guardamos qué ficha hemos girado
            $_SESSION["primera"] = $gira;
        // Si hay sólo una ficha girada ...
        } elseif ($_SESSION["primera"] != -1 && $_SESSION["segunda"] == -1) {
            // ... guardamos qué ficha hemos girado
            $_SESSION["segunda"] = $gira;
        // Si ya hay dos giradas ...
        } elseif ($_SESSION["primera"] != -1 && $_SESSION["segunda"] != -1) {
            // ... damos la vuelta a las dos fichas anteriores
            $_SESSION["lado"][$_SESSION["primera"]] = "dorso";
            $_SESSION["lado"][$_SESSION["segunda"]] = "dorso";
            // Y guardamos esa ficha como primera ficha de la jugada siguiente
            $_SESSION["primera"] = $gira;
            $_SESSION["segunda"] = -1;
        }
    }
}

// Redirigimos a la primera página
header("Location:memorion-4-1.php");
