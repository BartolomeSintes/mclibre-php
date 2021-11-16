<?php
/**
 * Hoja de estilo  - cabeceras-11-css.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2019 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2019-11-10
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

header("Content-type: text/css");

// en vez de elegir un color al azar entre 0 y 360 he utilizado
// una fórmula para que salgan uno entre 19 valores: 0, 20, 40, etc.
$color  = 20 * rand(0, 18);
$tamano = rand(100, 300) / 100;

print "body {\n";
print "  background-color: hsl($color, 100%, 80%);\n";
print "  font-family: sans-serif;\n";
print "  font-size: {$tamano}rem;\n";
print "}\n";
print "\n";

print "h1 {\n";
print "  padding: 0 10px 5px;\n";
print "  border-radius: 10px;\n";
print "  background-color: hsl($color, 100%, 30%);\n";
print "  color: hsl($color, 100%, 60%);\n";
print "}\n";
print "\n";

?>
footer {
    border-top: black 1px solid;
    margin-top: 2em;
}
