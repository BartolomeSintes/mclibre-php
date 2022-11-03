<?php
/**
 * Muestra cartas (1) - cartas-1-2.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2021 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2022-01-08
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
session_name("cartas-5");
session_start();

if (!isset($_SESSION["baraja"]) || !isset( $_SESSION["cartas"])) {
    header("Location:cartas-1-1.php");
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

if ($accion == "mas" && count($_SESSION["cartas"]) < 52) {
    $_SESSION["cartas"][]  = $_SESSION["baraja"][count($_SESSION["baraja"])-1];
    unset($_SESSION["baraja"][count($_SESSION["baraja"])-1]);
} elseif ($accion == "menos" && count($_SESSION["cartas"]) > 0) {
    // array_key_last() es para PHP > PHP 7.3
    $_SESSION["baraja"][]  = $_SESSION["cartas"][count($_SESSION["cartas"]) - 1];
    unset($_SESSION["cartas"][count($_SESSION["cartas"]) - 1]);
} elseif ($accion == "reiniciar") {
    session_destroy();
}

header("Location:cartas-1-1.php");
