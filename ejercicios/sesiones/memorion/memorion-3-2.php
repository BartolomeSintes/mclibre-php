<?php
/**
 * Memorión (3) - memorion-3-2.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2017 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2017-11-13
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

session_name("memorion-3");
session_start();

if (!isset($_SESSION["numeroFichas"])) {
    header("Location:memorion-3-1.php");
    exit;
}

function recoge($var)
{
    $tmp = (isset($_REQUEST[$var]))
    ? trim(htmlspecialchars($_REQUEST[$var], ENT_QUOTES, "UTF-8"))
    : "";
    return $tmp;
}

$accion = recoge("accion");

$accionOk = false;

if ($accion != "numero" && $accion != "nuevo") {
    header("Location:memorion-3-1.php");
    exit;
} else {
    $accionOk = true;
}

if ($accionOk) {
    if ($accion == "numero") {
        header("Location:memorion-3-3.php");
        exit;
    } elseif ($accion == "nuevo") {
        unset($_SESSION["fichas"]);
        header("Location:memorion-3-1.php");
        exit;
    }
}
