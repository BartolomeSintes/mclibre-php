<?php
/**
 * Puntería 1 y 2 - punteria-dibujo.php
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

session_name("punteria");
session_start();

header("Content-type: image/svg+xml");

$_SESSION["ancho"] = 200;
$_SESSION["r"]     = rand(10, 20);
$_SESSION["x"]     = rand($_SESSION["r"], $_SESSION["ancho"] - $_SESSION["r"]);
$_SESSION["y"]     = rand($_SESSION["r"], $_SESSION["ancho"] - $_SESSION["r"]);

print "<svg version=\"1.1\" xmlns=\"http://www.w3.org/2000/svg\" \n"
    . "  width=\"$_SESSION[ancho]\" height=\"$_SESSION[ancho]\">\n";
print "  <rect fill=\"none\" stroke=\"black\" stroke-width=\"1\" "
    . "x=\"0\" y=\"0\" width=\"$_SESSION[ancho]\" height=\"$_SESSION[ancho]\" />\n";
print "  <circle cx=\"$_SESSION[x]\" cy=\"$_SESSION[y]\" r=\"$_SESSION[r]\" stroke=\"black\" stroke-width=\"0\" fill=\"black\" />\n";
print "</svg>";
