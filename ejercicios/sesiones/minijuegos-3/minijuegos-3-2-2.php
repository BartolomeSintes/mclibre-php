<?php
/**
 * Minijuegos (3) 2 - minijuegos-3-2-2.php
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
session_name("minijuegos-3-2");
session_start();

if (!isset($_SESSION["ax"]) || !isset($_SESSION["bx"]) || !isset($_SESSION["ad"]) || !isset($_SESSION["bd"])) {
    header("Location:minijuegos-3-2-1.php");
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

if ($accion == "a") {
    $_SESSION["ad"] = rand(1, 6);
    $_SESSION["ax"] += 5 * $_SESSION["ad"] ;
} elseif ($accion == "b") {
    $_SESSION["bd"] = rand(1, 6);
    $_SESSION["bx"] += 5 * $_SESSION["bd"] ;
} elseif ($accion == "empezar") {
    $_SESSION["ad"] = $_SESSION["bd"] = 0;
    $_SESSION["ax"] = $_SESSION["bx"] = 0;
}

header("Location:minijuegos-3-2-1.php");
