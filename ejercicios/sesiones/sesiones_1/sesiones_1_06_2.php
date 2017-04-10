<?php
/**
 * Sesiones (1) 06 - sesiones_1_06_2.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2016 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2016-11-17
 * @link      http://www.mclibre.org
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

session_name("sesiones_1_06");
session_start();

if (!isset($_SESSION["a"]) || !isset($_SESSION["b"])) {
    $_SESSION["a"] =  $_SESSION["b"] = 0;
}

function recoge($var)
{
    $tmp = (isset($_REQUEST[$var]))
    ? trim(htmlspecialchars($_REQUEST[$var], ENT_QUOTES, "UTF-8"))
    : "";
    return $tmp;
}

$accion = recoge("accion");

if ($accion == "a") {
    $_SESSION["a"] += 10;
} elseif ($accion == "b") {
    $_SESSION["b"] += 10;
} elseif ($accion == "cero") {
    $_SESSION["a"] = $_SESSION["b"] = 0;
}

header("location:sesiones_1_06_1.php");
