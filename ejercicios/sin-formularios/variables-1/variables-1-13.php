<?php
/**
 * Variables (1) 13 - variables-1-13.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2017 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2017-09-29
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
  <meta charset="utf-8" />
  <title>Tres círculos. Variables.
    Ejercicios. Programación web en PHP. Bartolomé Sintes Marco</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="mclibre-php-soluciones.css" rel="stylesheet" type="text/css" title="Color" />
</head>

<body>
  <h1>Tres círculos</h1>

  <p>Actualice la página para mostrar tres nuevos círculos.</p>

<?php
$c1 = rand(50, 150);
$c2 = rand(50, 150);
$c3 = rand(50, 150);

print "  <p><svg version=\"1.1\" xmlns=\"http://www.w3.org/2000/svg\"\n";
print "    width=\"920\" height=\"320\" viewBox=\"-10 -10 920 320\" style=\"background-color: white;\" font-family=\"sans-serif\">\n";
print "    <circle cx=\"$c1\" cy=\"150\" r=\"$c1\" stroke=\"black\" stroke-width=\"2\" fill=\"red\" />\n";
print "    <circle cx=\"" . (2 * $c1 + $c2) . "\" cy=\"150\" r=\"$c2\" stroke=\"black\" stroke-width=\"2\" fill=\"green\" />\n";
print "    <circle cx=\"" . (2 * $c1 + 2 * $c2 + $c3) . "\" cy=\"150\" r=\"$c3\" stroke=\"black\" stroke-width=\"2\" fill=\"blue\" />\n";
print "  </svg></p>\n";
?>

  <footer>
    <p class="ultmod">
      Última modificación de esta página:
      <time datetime="2017-09-29">29 de septiembre de 2017</time>
    </p>

    <p class="licencia">
      Este programa forma parte del curso <a href="http://www.mclibre.org/consultar/php/">
      Programación web en PHP</a> por <a href="http://www.mclibre.org/">Bartolomé
      Sintes Marco</a>.<br />
      El programa PHP que genera esta página está bajo
      <a rel="license" href="http://www.gnu.org/licenses/agpl.txt">licencia AGPL 3 o posterior</a>.</p>
  </footer>
</body>
</html>
