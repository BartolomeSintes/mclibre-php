<?php
/**
 * Cambio de cartas (1) - cartas-7-2.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2021 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2021-12-02
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

$accion = recoge("accion");
if (in_array($accion, ["0", "1", "2", "3", "4"]) && $_SESSION["cambios"] < 5) {
    $azar = array_rand($_SESSION["baraja"]);
    $_SESSION["jugador"][$accion] = $_SESSION["baraja"][$azar];
    unset($_SESSION["baraja"][$azar]);
    $_SESSION["cambios"] += 1;
    $_SESSION["puntos"] = 0;
    for ($i = 0; $i < 5; $i++) {
        $jugador2[$i] = substr($_SESSION["jugador"][$i], 1);
    }
    foreach (array_count_values($jugador2) as $indice => $valor) {
        $_SESSION["puntos"] +=  $indice * $valor * $valor;
    }
} elseif ($accion == "Reiniciar") {
    session_destroy();
}

header("Location:cartas-7-1.php");
