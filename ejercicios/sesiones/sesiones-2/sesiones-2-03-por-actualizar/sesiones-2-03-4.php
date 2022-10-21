<?php
/**
 * Sesiones (2) 03 - sesiones-2-03-4.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2018 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2018-11-14
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

session_name("sesiones-2-03");
session_start();

if (!isset($_SESSION["paso"])) {
    $_SESSION["paso"] = 1;
    header("Location:sesiones-2-03-1.php");
} elseif (isset($_SESSION["paso"]) && $_SESSION["paso"] != 4) {
    header("Location:sesiones-2-03-$_SESSION[paso].php");
    exit;
}

function recoge($var, $m = "")
{
    if (!isset($_REQUEST[$var])) {
        $tmp = is_array($m) ? [] : "";
    } elseif (!is_array($_REQUEST[$var])) {
        $tmp = trim(htmlspecialchars($_REQUEST[$var]));
    } else {
        $tmp = $_REQUEST[$var];
        array_walk_recursive($tmp, function (&$valor) {
            $valor = trim(htmlspecialchars($valor));
        });
    }
    return $tmp;
}

$apellido1 = recoge("apellido1");

if ($apellido1 == "") {
    $_SESSION["avisoApellido1"] = "No ha escrito su primer apellido";
    $_SESSION["paso"] = 3;
    header("Location:sesiones-2-03-3.php");
    exit;
} else {
    unset($_SESSION["avisoApellido1"]);
    $_SESSION["apellido1"] = $apellido1;
    $_SESSION["paso"] = 5;
    header("Location:sesiones-2-03-5.php");
    exit;
}
