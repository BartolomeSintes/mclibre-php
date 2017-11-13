<?php
/**
 * Memorión (4) - memorion-4-2.php
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

session_name("memorion-4");
session_start();

if (!isset($_SESSION["numeroFichas"])) {
    header("Location:memorion-4-1.php");
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
$muestra = recoge("muestra");

$accionOk = false;
$muestraOk = false;

if ($muestra == "") {
} elseif (!is_numeric($muestra)) {
} elseif (!ctype_digit($muestra)) {
} elseif ($muestra < 0 || $muestra > 2 * $_SESSION["numeroFichas"] - 1) {
} else {
    $muestraOk = true;
}

if ($accion != "numero" && $accion != "nuevo" && !$muestraOk) {
    header("Location:memorion-4-1.php");
    exit;
} else {
    $accionOk = true;
}


if ($muestraOk || $accionOk) {
    if ($accion == "numero") {
        header("Location:memorion-4-3.php");
        exit;
    } elseif ($accion == "nuevo") {
        unset($_SESSION["fichas"]);
        header("Location:memorion-4-1.php");
        exit;
    } else {
        if ($_SESSION["muestra1"] == -1) {
            $_SESSION["muestra1"] = $muestra;
            print "hola";
        } elseif ($_SESSION["muestra1"] != -1 && $_SESSION["muestra2"] == -1) {
            $_SESSION["muestra2"] = $muestra;
        } elseif ($_SESSION["muestra1"] != -1 && $_SESSION["muestra2"] != -1) {
            $_SESSION["muestra1"] = $muestra;
            $_SESSION["muestra2"] = -1;
        }
        header("Location:memorion-4-1.php");
        exit;
    }
}
