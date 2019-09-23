<?php
/**
 * Variables. Sin formularios.(1) 5 - variables-1-5.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2018 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2018-09-24
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
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>
    Círculos de color.
    Variables. Sin formularios.
    Ejercicios. PHP. Bartolomé Sintes Marco. www.mclibre.org
  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="mclibre-php-ejercicios.css" title="Color">
</head>

<body>
  <h1>Círculos de color</h1>

  <p>Actualice la página para mostrar tres nuevos círculos.</p>

<?php
$rojo  = rand(64, 255);
$verde = rand(64, 255);
$azul  = rand(64, 255);

print "  <p>\n";
print "    <svg version=\"1.1\" xmlns=\"http://www.w3.org/2000/svg\" \n";
print "      width=\"400\" height=\"300\" viewBox=\"-200 -120 400 300\">\n";
print "      <text x=\"100\" y=\"-90\" text-anchor=\"start\" font-size=\"20\">Verde: $verde</text>\n";
print "      <text x=\"-100\" y=\"-90\" text-anchor=\"end\" font-size=\"20\">Azul: $azul</text>\n";
print "      <text x=\"0\" y=\"155\" text-anchor=\"middle\" font-size=\"20\">Rojo: $rojo</text>\n";
print "      <path fill=\"rgb($rojo, 0, 0)\" stroke=\"black\" stroke-width=\"1\" d=\"M -73.85 36.92 A 75 75, 0, 1, 0, 73.85 36.92 A 75 75 0, 0, 1, 0 33.44 A 75 75 0, 0, 1, -73.85 36.92\" />\n";
print "      <path fill=\"rgb(0, $verde, 0)\" stroke=\"black\" stroke-width=\"1\" d=\"M 73.85 36.92 A 75 75, 0, 1, 0, 0 -93.44 A 75 75 0, 0, 1, 33.85 -16.92 A 75 75 0, 0, 1, 73.85 36.92\" />\n";
print "      <path fill=\"rgb(0, 0, $azul)\" stroke=\"black\" stroke-width=\"1\" d=\"M 0 -93.44 A 75 75, 0, 1, 0, -73.85 36.92 A 75 75 0, 0, 1, -33.85 -16.92 A 75 75 0, 0, 1, 0 -93.44\" />\n";
print "      <path fill=\"rgb($rojo, $verde, 0)\" stroke=\"black\" stroke-width=\"1\" d=\"M 73.85 36.92 A 75 75, 0, 0, 0, 33.85 -16.92 A 75 75 0, 0, 1, 0 33.44 A 75 75 0, 0, 0, 73.85 36.92\" />\n";
print "      <path fill=\"rgb($rojo, 0, $azul)\" stroke=\"black\" stroke-width=\"1\" d=\"M -73.85 36.92 A 75 75, 0, 0, 0, 0 33.44 A 75 75 0, 0, 1, -33.85 -16.92 A 75 75 0, 0, 0, -73.85 36.92\" />\n";
print "      <path fill=\"rgb(0, $verde, $azul)\" stroke=\"black\" stroke-width=\"1\" d=\"M 0 -93.44 A 75 75, 0, 0, 0, -33.85 -16.92 A 75 75 0, 0, 1, 33.85 -16.92 A 75 75 0, 0, 0, 0 -93.44\" />\n";
print "      <path fill=\"rgb($rojo, $verde, $azul)\" stroke=\"black\" stroke-width=\"1\" d=\"M 0 33.44 A 75 75, 0, 0, 0, 33.85 -16.92 A 75 75 0, 0, 0, -33.85 -16.92 A 75 75 0, 0, 0, 0 33.44\" />\n";
print "    </svg>\n";
print "  </p>\n";
?>

  <footer>
    <p class="ultmod">
      Última modificación de esta página:
      <time datetime="2018-09-24">24 de septiembre de 2018</time>
    </p>

    <p class="licencia">
      Este programa forma parte del curso <strong><a href="http://www.mclibre.org/consultar/php/">Programación
      web en PHP</a></strong> de <a href="http://www.mclibre.org/" rel="author">Bartolomé Sintes Marco</a>.<br>
      El programa PHP que genera esta página se distribuye bajo
      <a rel="license" href="http://www.gnu.org/licenses/agpl.txt">licencia AGPL 3 o posterior</a>.
    </p>
  </footer>
</body>
</html>
