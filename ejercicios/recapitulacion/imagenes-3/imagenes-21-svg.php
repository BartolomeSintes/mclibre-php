<?php
/**
 * Imágenes - imagenes-21-svg.php
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
    if ($type !== "" && $type !== []) {
        trigger_error("Function recoge(): argument #2 (\$type) must be an empty array or an empty string.", E_USER_ERROR);
    }
    $tmp = $type;
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

$ancho = recoge("ancho");
$color = recoge("color");

$anchoPredeterminado = 100;
$colores = [
    "black",
    "blue",
    "fuchsia",
    "gray",
    "green",
    "orange",
    "red",
    "white",
    "yellow"
];

if ($ancho == "") {
    $ancho = $anchoPredeterminado;
} elseif (!is_numeric($ancho)) {
    $ancho = $anchoPredeterminado;
} elseif (!ctype_digit($ancho)) {
    $ancho = $anchoPredeterminado;
}

if (!in_array($color, $colores)) {
    $color = "white";
}

header("Content-type: image/svg+xml");
print "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";
print "<!DOCTYPE svg PUBLIC \"-//W3C//DTD SVG 1.1//EN\" \n"
    . "  \"http://www.w3.org/Graphics/SVG/1.1/DTD/svg11.dtd\">\n";
print "<svg version=\"1.1\" xmlns=\"http://www.w3.org/2000/svg\" \n"
    . "  width=\"{$ancho}px\" height=\"{$ancho}px\">\n";
print "<path fill=\"$color\" stroke=\"black\" stroke-width=\"3\" "
    . "d=\"M 2,2 l" . $ancho - 4 . ",0 l0," . $ancho - 4 . "l-" . $ancho - 4 . ",0z\" />\n";
print "</svg>\n";
?>
