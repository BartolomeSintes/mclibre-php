<?php
/**
 * Cara o cruz - sesiones-2-13-2.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2021 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2021-11-25
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

session_name("sesiones-2-13");
session_start();

if (!isset($_SESSION["g"]) || !isset($_SESSION["m"]) || !isset($_SESSION["moneda"])) {
    header("Location:sesiones-2-13-1.php");
    exit;
}

function recoge($var)
{
    $tmp = (isset($_REQUEST[$var]))
    ? trim(htmlspecialchars($_REQUEST[$var]))
    : "";
    return $tmp;
}

$siguiente= recoge("siguiente");

if ($siguiente == "Lanzar moneda") {
    $_SESSION["moneda"] = rand(1, 2);
    if ($_SESSION["moneda"] == 1) {
        $_SESSION["g"] += 1;
    } else {
        $_SESSION["m"] += 1;
    }
} elseif ($siguiente == "Volver a empezar") {
    $_SESSION["moneda"] = 0;
    $_SESSION["g"]      = 0;
    $_SESSION["m"]      = 0;
}

header("Location:sesiones-2-13-1.php");
exit;
