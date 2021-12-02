<?php
/**
 * Muestra cartas (1) - cartas-5-2.php
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
session_name("cartas-5");
session_start();

if (!isset($_SESSION["baraja"]) || !isset( $_SESSION["cartas"])) {
    header("Location:cartas-5-1.php");
    exit;
}

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

$accion = recoge("accion");

if ($accion == "mas" && count($_SESSION["cartas"]) < 52) {
    $nuevaCarta = array_rand($_SESSION["baraja"]);
    $_SESSION["cartas"][]  = $_SESSION["baraja"][$nuevaCarta];
    unset($_SESSION["baraja"][$nuevaCarta]);
} elseif ($accion == "menos" && count($_SESSION["cartas"]) > 0) {
    // array_key_last() es para PHP > PHP 7.3
    // $_SESSION["baraja"][]  = $_SESSION["cartas"][array_key_last($_SESSION["cartas"])];
    // unset($_SESSION["cartas"][array_key_last($_SESSION["cartas"])]);
    $_SESSION["baraja"][]  = $_SESSION["cartas"][count($_SESSION["cartas"]) - 1];
    unset($_SESSION["cartas"][count($_SESSION["cartas"]) - 1]);
} elseif ($accion == "reiniciar") {
    session_destroy();
}

header("Location:cartas-5-1.php");
