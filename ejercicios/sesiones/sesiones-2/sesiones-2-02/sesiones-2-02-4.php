<?php
/**
 * Sesiones (2) 01 - sesiones-2-02-4.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2018 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2018-11-15
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

session_name("sesiones-2-02");
session_start();

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

$palabra2 = recoge("palabra2");

if ($palabra2 == "") {
    $_SESSION["aviso2"] = "No ha escrito nada";
    header("Location:sesiones-2-02-3.php");
    exit;
} elseif (!ctype_alnum($palabra2)) {
    $_SESSION["aviso2"] = "No ha escrito una sola palabra con letras y números";
    header("Location:sesiones-2-02-3.php");
    exit;
} elseif ($_SESSION["palabra1"] != $palabra2) {
    $_SESSION["aviso1"] = "No ha escrito la misma palabra. Comience de nuevo.";
    header("Location:sesiones-2-02-1.php");
    exit;
} else {
    unset($_SESSION["avisoApellido"]);
    $_SESSION["palabra2"] = $palabra2;
    header("Location:sesiones-2-02-5.php");
    exit;
}
