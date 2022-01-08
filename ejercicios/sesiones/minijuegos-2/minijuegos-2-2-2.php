<?php
/**
 * Sesiones (1) 12 - sesiones-1-12-2.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2018 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2018-10-31
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
session_name("sesiones-1-12");
session_start();

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

if (!isset($_SESSION["ax"]) || !isset($_SESSION["bx"]) || !isset($_SESSION["ad"]) || !isset($_SESSION["bd"])) {
    $_SESSION["ax"] = $_SESSION["bx"];
    $_SESSION["ad"] = $_SESSION["bd"] = 1;
}

$accion = recoge("accion");

if ($accion == "a") {
    $_SESSION["ad"] = rand(1, 6);
    $_SESSION["ax"] += 5 * $_SESSION["ad"] ;
} elseif ($accion == "b") {
    $_SESSION["bd"] = rand(1, 6);
    $_SESSION["bx"] += 5 * $_SESSION["bd"] ;
} elseif ($accion == "empezar") {
    $_SESSION["ad"] = $_SESSION["bd"] = 1;
    $_SESSION["ax"] = $_SESSION["bx"] = 0;
}

header("Location:sesiones-1-12-1.php");
