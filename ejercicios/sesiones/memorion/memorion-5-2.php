<?php
/**
 * Memorión (5) - memorion-5-2.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2018 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2018-11-01
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
session_name("memorion-5");
session_start();

// Si no están guardado en la sesión los dibujos de la partida ....
if (!isset($_SESSION["numeroDibujos"])) {
    // ... redirigimos a la primera página
    header("Location:memorion-5-1.php");
    exit;
}

// Funciones auxiliares
function recoge($var, $m = "")
{
    $tmp = is_array($m) ? [] : "";
    if (isset($_REQUEST[$var])) {
        if (!is_array($_REQUEST[$var]) && !is_array($m)) {
            $tmp = trim(htmlspecialchars($_REQUEST[$var]));
        } elseif (is_array($_REQUEST[$var]) && is_array($m)) {
            $tmp = $_REQUEST[$var];
            array_walk_recursive($tmp, function (&$valor) {
                $valor = trim(htmlspecialchars($valor));
            });
        }
    }
    return $tmp;
}

// Recogemos los datos (botón y carta)
$accion = recoge("accion");
$gira= recoge("gira");

// Variables auxiliares comprobación de datos
$accionOk = false;
$giraOk = false;

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
        header("Location:memorion-5-1.php");
        exit;
    // Si se ha pulsado "Cambiar número de dibujos" ...
    } elseif ($accion == "numero") {
        // ... redirigimos al formulario correspondiente
        header("Location:memorion-5-3.php");
        exit;
    // Si se ha pulsado una ficha ...
    } else {
        // Si se ha pulsado una ficha que está boca abajo ...
        if ($_SESSION["lado"][$gira] == "dorso") {
            // ... la giramos
            $_SESSION["lado"][$gira] = "dibujo";
            // Si no hay ninguna carta girada ...
            if ($_SESSION["primera"] == -1) {
                // ... guardamos qué ficha hemos girado
                $_SESSION["primera"] = $gira;
            // Si hay sólo una ficha girada ...
            } elseif ($_SESSION["primera"] != -1 && $_SESSION["segunda"] == -1) {
                // ... guardamos qué ficha hemos girado
                $_SESSION["segunda"] = $gira;
                $_SESSION["jugadas"] += 1;
            // Si ya hay dos giradas ...
            } elseif ($_SESSION["primera"] != -1 && $_SESSION["segunda"] != -1) {
                // Si son diferentes
                if ($_SESSION["dibujos"][$_SESSION["primera"]] != $_SESSION["dibujos"][$_SESSION["segunda"]]) {
                    // ... damos la vuelta a las dos fichas
                    $_SESSION["lado"][$_SESSION["primera"]] = "dorso";
                    $_SESSION["lado"][$_SESSION["segunda"]] = "dorso";
                }
                // Guardamos esa ficha como primera ficha de la jugada siguiente
                $_SESSION["primera"] = $gira;
                $_SESSION["segunda"] = -1;
            }
        }
        // Redirigimos a la primera página
        header("Location:memorion-5-1.php");
        exit;
    }
// ... y si no, redirigimos a la primera página
} else {
    header("Location:memorion-5-1.php");
    exit;
}
