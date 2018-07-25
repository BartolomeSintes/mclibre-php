<?php
/**
 * Imágenes - imagenes_6.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2014 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2014-10-29
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
header("Content-type: application/xhtml+xml");
print "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1 plus MathML 2.0 plus SVG 1.1//EN"
      "http://www.w3.org/2002/04/xhtml-math-svg/xhtml-math-svg.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Control imagen 1. Imágenes.
  Ejercicios. PHP. Bartolomé Sintes Marco</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="mclibre-php-soluciones.css" rel="stylesheet" type="text/css"
  title="Color" />
</head>
<body>

<h1>Selector de colores</h1>

<?php

function recoge($var)
{
    $tmp = (isset($_REQUEST[$var]))
        ? trim(htmlspecialchars($_REQUEST[$var], ENT_QUOTES, "UTF-8"))
        : "";
    return $tmp;
}

$cuadros = recoge("cuadros");
$mas     = recoge("mas");
$menos   = recoge("menos");
$ancho   = 150;

if ($cuadros == "" || !is_numeric($cuadros) || !ctype_digit($cuadros)
    || $cuadros < 0) {
    $cuadros = 1;
}

if ($mas != "") {
    $cuadros += 1;
}

if ($menos != "" && $cuadros > 1) {
    $cuadros -= 1;
}

print "<form action=\"$_SERVER[PHP_SELF]\" method=\"get\" >\n";
print "<p><input type=\"submit\" name=\"mas\" value=\"Añadir cuadro\" />\n"
     . "  <input type=\"submit\" name=\"menos\" value=\"Quitar cuadro\" />\n"
     . "  <input type=\"hidden\" name=\"cuadros\" value=\"$cuadros\" /></p>\n";
print "</form>\n\n";
print "<p>";
for ($i = 1; $i <= $cuadros; $i++) {
    $colorR = rand(1, 255);
    $colorG = rand(1, 255);
    $colorB = rand(1, 255);
    $color  = "rgb($colorR, $colorG, $colorB)";
    print "<svg version=\"1.1\" xmlns=\"http://www.w3.org/2000/svg\" \n"
        . "  width=\"{$ancho}px\" height=\"{$ancho}px\">\n";
    print "<path fill=\"$color\" stroke=\"black\" stroke-width=\"3\" "
    . "d=\"M 2,2 l" . ($ancho - 4) .",0 l0," . ($ancho - 4) . "l-" . ($ancho - 4) . ",0z\" />\n";
    print "</svg>\n";
}
print "</p>\n";

?>

<p class="ultmod">Última modificación de esta página: 29 de octubre de 2014</p>

<p class="licencia">
Este programa forma parte del curso <a href="http://www.mclibre.org/consultar/php/">
<cite>Programación web en PHP</cite></a> por <cite>Bartolomé Sintes Marco</cite>.<br />
El programa PHP que genera esta página está bajo
<a rel="license" href="http://www.gnu.org/licenses/agpl.txt">licencia AGPL 3 o
posterior</a></p>
</body>
</html>
