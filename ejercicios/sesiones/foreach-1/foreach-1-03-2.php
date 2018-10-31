<?php
/**
 * Elimine dibujos en orden - foreach-1-03-2.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2018 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2018-10-31
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

session_name("foreach-1-03");
session_start();

if (!isset($_SESSION["dibujos"])) {
    header("Location:foreach-1-03-1.php");
    exit;
}

function recoge($var)
{
    $tmp = (isset($_REQUEST[$var]))
    ? trim(htmlspecialchars($_REQUEST[$var], ENT_QUOTES, "UTF-8"))
    : "";
    return $tmp;
}

$elimina= recoge("elimina");

if ($elimina == "") {
} elseif (!is_numeric($elimina)) {
} elseif (!ctype_digit($elimina)) {
} else {
    if (isset($_SESSION["dibujos"][$elimina])
        && $_SESSION["dibujos"][$elimina] == $_SESSION["deseado"]) {
        unset($_SESSION["dibujos"][$elimina]);
        unset($_SESSION["deseado"]);
    }
    // Nota: Como compara los dibujos, si hay un dibujo repetido, lo elimina siempre
}

header("Location:foreach-1-03-1.php");
exit;
