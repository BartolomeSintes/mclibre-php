<?php
/**
 * Hucha de monedas - sesiones-2-12-2.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2018 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2018-02-21
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

session_name("sesiones-2-12-1");
session_start();

if (!isset($_SESSION["cantidad"])) {
    header("Location:sesiones-2-12-1.php");
    exit;
}

function recoge($var)
{
    $tmp = (isset($_REQUEST[$var]))
    ? trim(htmlspecialchars($_REQUEST[$var]))
    : "";
    return $tmp;
}

$moneda = recoge("moneda");
$accion = recoge("accion");

$monedaOk = false;

if ($accion == "Vaciar hucha") {
    $_SESSION["cantidad"] = 0;
} elseif ($moneda == 0.01 || $moneda == 0.02 || $moneda == 0.05 || $moneda == 0.10
    || $moneda == 0.20 || $moneda == 0.50 || $moneda == 1 || $moneda == 2) {
    $_SESSION["cantidad"] += $moneda;
}

header("Location:sesiones-2-12-1.php");
