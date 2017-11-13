<?php
/**
 * Memorión (2) - memorion-2-3.php
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

session_name("memorion-2");
session_start();

if (!isset($_SESSION["numeroFichas"])) {
    header("Location:memorion-2-1.php");
    exit;
}

function recoge($var)
{
    $tmp = (isset($_REQUEST[$var]))
    ? trim(htmlspecialchars($_REQUEST[$var], ENT_QUOTES, "UTF-8"))
    : "";
    return $tmp;
}

$numeroFichas = recoge("numeroFichas");
$numeroFichasMinimo = 2;
$numeroFichasMaximo = 61;

$numeroFichasOk = false;

if ($numeroFichas == "") {
    header("Location:memorion-2-1.php");
    exit;
} elseif (!is_numeric($numeroFichas)) {
    header("Location:memorion-2-1.php");
    exit;
} elseif (!ctype_digit($numeroFichas)) {
    header("Location:memorion-2-1.php");
    exit;
} elseif ($numeroFichas < $numeroFichasMinimo || $numeroFichas > $numeroFichasMaximo) {
    header("Location:memorion-2-1.php");
    exit;
} else {
    $numeroFichasOk = true;
}

if ($numeroFichasOk) {
    $_SESSION["numeroFichas"] = $numeroFichas;
    header("Location:memorion-2-1.php");
    exit;
}
