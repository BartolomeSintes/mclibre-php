<?php
/**
 * Imagen - cabeceras-12-svg.php
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

header("Content-type: image/svg+xml");

$radio = rand(10, 20);
$cx    = rand($radio + 1, 148 - $radio);
$cy    = rand($radio + 1, 148 - $radio);

print "<?xml version=\"1.0\" encoding=\"UTF-8\" ?>\n";
print "<svg version=\"1.1\" xmlns=\"http://www.w3.org/2000/svg\" \n"
    . "  width=\"150\" height=\"150\" viewBox=\"0 0 150 150\">\n";
print "  <rect fill=\"none\" stroke=\"black\" stroke-width=\"1\" "
    . "x=\"1\" y=\"1\" width=\"148\" height=\"148\" />\n";
print "  <circle cx=\"$cx\" cy=\"$cy\" r=\"$radio\" fill=\"black\" />\n";
print "</svg>";
?>
