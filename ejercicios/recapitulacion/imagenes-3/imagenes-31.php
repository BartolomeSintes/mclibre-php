<?php
/**
 * Imágenes - imagenes_6.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2014 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2014-10-27
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

print "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
       "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Tiro al plato. Imágenes.
  Ejercicios. PHP. Bartolomé Sintes Marco</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="mclibre-php-soluciones.css" rel="stylesheet" type="text/css"
  title="Color" />
</head>
<body>

<h1>Tiro al plato</h1>

<?php

function recoge($var)
{
    $tmp = (isset($_REQUEST[$var]))
        ? trim(htmlspecialchars($_REQUEST[$var], ENT_QUOTES, "UTF-8"))
        : "";
    return $tmp;
}
$tiroX     = recoge("tiro_x");
$tiroY     = recoge("tiro_y");
$tamX      = 800;
$tamY      = 400;

$minRadio = 5;
$maxRadio = 20;
$circuloR = rand($minRadio, $maxRadio);
$circuloX = rand(2 + $circuloR, $tamX - 4 - $circuloR);
$circuloY = rand(2 + $circuloR, $tamY - 4 - $circuloR);

print "<form action=\"$_SERVER[PHP_SELF]\" method=\"get\">\n";
print "<p><button type=\"image\" name=\"tiro\">\n";
print "<svg version=\"1.1\" id=\"Layer_1\" xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\" x=\"0px\" y=\"0px\"
     width=\"{$tamX}px\" height=\"{$tamY}px\" viewBox=\"0 0 $tamX $tamY\" style=\"enable-background:new 0 0 $tamX $tamY;\" xml:space=\"preserve\">\n";
print "<path fill=\"white\" stroke=\"black\" stroke-width=\"3\" "
        . "d=\"M 2,2 l" . ($tamX - 4) . ",0 l0," . ($tamY - 4) . " l-" . ($tamX - 4) . ",0z\" />\n";
print "<circle cx=\"$circuloX\" cy=\"$circuloY\" r=\"$circuloR\" style=\"stroke:black; fill:black\" />\n";
print "</svg></button></p>\n";
print "</form>\n";

?>

<p class="ultmod">Última modificación de esta página: 27 de octubre de 2014</p>

<p class="licencia">
Este programa forma parte del curso <a href="http://www.mclibre.org/consultar/php/">
<cite>Programación web en PHP</cite></a> por <cite>Bartolomé Sintes Marco</cite>.<br />
El programa PHP que genera esta página está bajo
<a rel="license" href="http://www.gnu.org/licenses/agpl.txt">licencia AGPL 3 o
posterior</a></p>
</body>
</html>
