<?php
/**
 * Puntería 1-1 - punteria_1_dibujo.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2015 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2015-10-28
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

function recoge($var)
{
    $tmp = (isset($_REQUEST[$var]))
        ? trim(htmlspecialchars($_REQUEST[$var], ENT_QUOTES, "UTF-8"))
        : "";
    return $tmp;
}

$ancho = recoge("ancho");
$r      = recoge("r");
$x      = recoge("x");
$y      = recoge("y");

header("Content-type: image/svg+xml");

print "  <svg version=\"1.1\" xmlns=\"http://www.w3.org/2000/svg\" \n"
    . "    width=\"{$ancho}px\" height=\"{$ancho}px\">\n";
print "  <rect fill=\"none\" stroke=\"black\" stroke-width=\"1\" "
        . "x=\"0\" y=\"0\" width=\"$ancho\" height=\"$ancho\" />\n";
print "    <circle cx=\"$x\" cy=\"$y\" r=\"$r\" stroke=\"black\" stroke-width=\"0\" fill=\"black\" />\n";
print "  </svg>";
