<?php
/**
 * Variables. Sin formularios.(1) 14 - variables-1-14.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2025 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2025-02-08
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
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>
    Avance de ficha.
    Variables. Sin formularios.
    Ejercicios. PHP. Bartolomé Sintes Marco. www.mclibre.org
  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="mclibre-php-ejercicios.css" title="Color">
</head>

<body>
  <h1>Avance de ficha</h1>

  <p>Actualice la página para mostrar una nueva tirada.</p>

<?php
$dado = rand(1, 6);

print "  <p>\n";
print "    <img src=\"img/$dado.svg\" alt=\"$dado\" width=\"140\" height=\"140\">\n";
print "  </p>\n";
print "\n";
print "  <p>\n";
print "    <svg version=\"1.1\" xmlns=\"http://www.w3.org/2000/svg\"\n";
print "         width=\"620\" height=\"120\" viewBox=\"-15 -15 620 120\" style=\"background-color: white;\" font-family=\"sans-serif\">\n";
print "      <rect x=\"0\" y=\"0\" width=\"100\" height=\"100\" stroke=\"black\" stroke-width=\"1\" fill=\"none\" />\n";
print "      <text x=\"50\" y=\"80\" text-anchor=\"middle\" font-size=\"80\" fill=\"lightgray\">1</text>\n";
print "      <rect x=\"100\" y=\"0\" width=\"100\" height=\"100\" stroke=\"black\" stroke-width=\"1\" fill=\"none\" />\n";
print "      <text x=\"150\" y=\"80\" text-anchor=\"middle\" font-size=\"80\" fill=\"lightgray\">2</text>\n";
print "      <rect x=\"200\" y=\"0\" width=\"100\" height=\"100\" stroke=\"black\" stroke-width=\"1\" fill=\"none\" />\n";
print "      <text x=\"250\" y=\"80\" text-anchor=\"middle\" font-size=\"80\" fill=\"lightgray\">3</text>\n";
print "      <rect x=\"300\" y=\"0\" width=\"100\" height=\"100\" stroke=\"black\" stroke-width=\"1\" fill=\"none\" />\n";
print "      <text x=\"350\" y=\"80\" text-anchor=\"middle\" font-size=\"80\" fill=\"lightgray\">4</text>\n";
print "      <rect x=\"400\" y=\"0\" width=\"100\" height=\"100\" stroke=\"black\" stroke-width=\"1\" fill=\"none\" />\n";
print "      <text x=\"450\" y=\"80\" text-anchor=\"middle\" font-size=\"80\" fill=\"lightgray\">5</text>\n";
print "      <rect x=\"500\" y=\"0\" width=\"100\" height=\"100\" stroke=\"black\" stroke-width=\"1\" fill=\"none\" />\n";
print "      <text x=\"550\" y=\"80\" text-anchor=\"middle\" font-size=\"80\" fill=\"lightgray\">6</text>\n";
print "      <circle cx=\"" . 100 * $dado - 50 . "\" cy=\"50\" r=\"30\" stroke=\"black\" stroke-width=\"2\" fill=\"red\" />\n";
print "    </svg>\n";
print "  </p>\n";
print "\n";
?>
  <footer>
    <p class="ultmod">
      Última modificación de esta página:
      <time datetime="2025-02-08">8 de febrero de 2025</time>
    </p>

    <p class="licencia">
      Este programa forma parte del curso <strong><a href="https://www.mclibre.org/consultar/php/">Programación
      web en PHP</a></strong> de <a href="https://www.mclibre.org/" rel="author">Bartolomé Sintes Marco</a>.<br>
      El programa PHP que genera esta página se distribuye bajo
      <a rel="license" href="http://www.gnu.org/licenses/agpl.txt">licencia AGPL 3 o posterior</a>.
    </p>
  </footer>
</body>
</html>
