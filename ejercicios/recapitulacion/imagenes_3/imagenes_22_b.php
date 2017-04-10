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
  <link href="mclibre_php_soluciones.css" rel="stylesheet" type="text/css"
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

$colores = array(
    array("black",   "negro"),
    array("blue",    "azul"),
    array("fuchsia", "rosa"),
    array("gray",    "gris"),
    array("green",   "verde"),
    array("orange",  "naranja"),
    array("red",     "rojo"),
    array("white",   "blanco"),
    array("yellow",  "amarillo")
);

$numeroColores = count($colores);
$numeroCuadros = 3;

$coloresBarajados = $colores;
shuffle($coloresBarajados);

$imagenX     = recoge("imagen_x");
$imagenY     = recoge("imagen_y");
$valorMinimo = 1;
$valorMaximo = 150;
$unidad = $valorMaximo / 15;

print "<p><svg version=\"1.1\" id=\"Layer_1\" xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\" x=\"0px\" y=\"0px\"
     width=\"512px\" height=\"512px\" viewBox=\"0 0 512 512\" style=\"enable-background:new 0 0 512 512;\" xml:space=\"preserve\">\n";
for ($i = 0; $i < $numeroCuadros; $i++) {
    print "<path fill=\"{$coloresBarajados[$i][0]}\" stroke=\"black\" stroke-width=\"3\" "
        . "d=\"M" . (120*($i+1)) . ",110 l-100,0 l0,100 l100,0z\" />\n";
}
print "</svg></p>\n";

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
