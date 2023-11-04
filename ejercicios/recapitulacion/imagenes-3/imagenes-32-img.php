<?php
/**
 * Imágenes - imagenes_6.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2022 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2022-10-10
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

// Función de recogida de datos
function recoge($key, $type = "")
{
    if ($type != "" && $type != []) {
        trigger_error("Function recoge(): argument #2 (\$type) must be an empty array or an empty string.", E_USER_ERROR);
    }
    $tmp = is_array($type) ? [] : "";
    if (isset($_REQUEST[$key])) {
        if (!is_array($_REQUEST[$key]) && !is_array($type)) {
            $tmp = trim(htmlspecialchars($_REQUEST[$key]));
        } elseif (is_array($_REQUEST[$key]) && is_array($type)) {
            $tmp = $_REQUEST[$key];
            array_walk_recursive($tmp, function (&$value) {
                $value = trim(htmlspecialchars($value));
            });
        }
    }
    return $tmp;
}

$tamX     = recoge("tamX");
$tamY     = recoge("tamY");
$circuloR = recoge("circuloR");
$circuloX = recoge("circuloX");
$circuloY = recoge("circuloY");

header("Content-type: image/svg+xml");
print "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";
print "<!DOCTYPE svg PUBLIC \"-//W3C//DTD SVG 1.1//EN\" \"http://www.w3.org/Graphics/SVG/1.1/DTD/svg11.dtd\">\n";
print "<svg version=\"1.1\" id=\"Layer_1\" xmlns=\"http://www.w3.org/2000/svg\" "
    . "width=\"{$tamX}px\" height=\"{$tamY}px\" viewBox=\"0 0 $tamX $tamY\">\n";
print "<path fill=\"white\" stroke=\"black\" stroke-width=\"3\" "
        . "d=\"M 2,2 l" . $tamX - 4 . ",0 l0," . $tamY - 4 . " l-" . $tamX - 4 . ",0z\" />\n";
print "<circle cx=\"$circuloX\" cy=\"$circuloY\" r=\"$circuloR\" style=\"stroke:black; fill:black\" />\n";
print "</svg>";
?>
