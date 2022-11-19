<?php
/**
 * Sesiones Minijuegos (1) 6 - minijuegos-1-6-2.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2022 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2022-11-17
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
session_name("minijuegos-1-6");
session_start();

// Si los valores de sesión no existen, damos valores iniciales a todas las variables de sesión
if (!isset($_SESSION["cartaN1"])) {
    $_SESSION["cartaN1"] = rand(1, 10);
    $_SESSION["cartaN2"] = rand(1, 10);
    $_SESSION["cartaN3"] = rand(1, 10);
    $_SESSION["cartaR1"] = rand(1, 10);
    $_SESSION["cartaR2"] = rand(1, 10);
    $_SESSION["cartaR3"] = rand(1, 10);
    // Más adelante comprobamos quién es el ganador
    $_SESSION["ganador"] = "";
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

// Recogemos accion
$accion = recoge("accion");

// Si recibimos "nuevas", reiniciamos los valores de las cartas
if ($accion == "nuevas") {
    $_SESSION["cartaN1"] = rand(1, 10);
    $_SESSION["cartaN2"] = rand(1, 10);
    $_SESSION["cartaN3"] = rand(1, 10);
    $_SESSION["cartaR1"] = rand(1, 10);
    $_SESSION["cartaR2"] = rand(1, 10);
    $_SESSION["cartaR3"] = rand(1, 10);
}

// Comprobamos si el primer jugador ha obtenido un trío, una pareja o cartas distintas
if ($_SESSION["cartaN1"] == $_SESSION["cartaN2"] && $_SESSION["cartaN2"] == $_SESSION["cartaN3"]) {
    $mano1  = 3;
    $valor1 = $_SESSION["cartaN1"];
} elseif ($_SESSION["cartaN1"] == $_SESSION["cartaN2"] || $_SESSION["cartaN1"] == $_SESSION["cartaN3"]) {
    $mano1  = 2;
    $valor1 = $_SESSION["cartaN1"];
} elseif ($_SESSION["cartaN2"] == $_SESSION["cartaN3"]) {
    $mano1  = 2;
    $valor1 = $_SESSION["cartaN2"];
} else {
    $mano1  = 1;
    $valor1 = max($_SESSION["cartaN1"], $_SESSION["cartaN2"], $_SESSION["cartaN3"]);
}

// Comprobamos si el segundo jugador ha obtenido un trío, una pareja o cartas distintas
if ($_SESSION["cartaR1"] == $_SESSION["cartaR2"] && $_SESSION["cartaR2"] == $_SESSION["cartaR3"]) {
    $mano2  = 3;
    $valor2 = $_SESSION["cartaR1"];
} elseif ($_SESSION["cartaR1"] == $_SESSION["cartaR2"] || $_SESSION["cartaR1"] == $_SESSION["cartaR3"]) {
    $mano2  = 2;
    $valor2 = $_SESSION["cartaR1"];
} elseif ($_SESSION["cartaR2"] == $_SESSION["cartaR3"]) {
    $mano2  = 2;
    $valor2 = $_SESSION["cartaR2"];
} else {
    $mano2  = 1;
    $valor2 = max($_SESSION["cartaR1"], $_SESSION["cartaR2"], $_SESSION["cartaR3"]);
}

// Comparamos el resultado de ambos jugadores para saber quién ha ganado
if ($mano1 > $mano2) {
    $_SESSION["ganador"] = "Ha ganado el jugador de las cartas negras.";
} elseif ($mano2 > $mano1) {
    $_SESSION["ganador"] = "Ha ganado el jugador de las cartas rojas.";
} elseif ($valor1 > $valor2) {
    $_SESSION["ganador"] = "Ha ganado el jugador de las cartas negras.";
} elseif ($valor2 > $valor1) {
    $_SESSION["ganador"] = "Ha ganado el jugador de las cartas rojas.";
} else {
    $_SESSION["ganador"] = "Han empatado.";
}

// Volvemos al formulario
header("location:minijuegos-1-6-1.php");
