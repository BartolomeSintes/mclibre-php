<?php
/**
 * Variables. Sin formularios.(1) 13 - variables-1-13.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2018 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2018-11-05
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
    Tres círculos.
    Variables. Sin formularios.
    Ejercicios. PHP. Bartolomé Sintes Marco. www.mclibre.org
  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="mclibre-php-ejercicios.css" title="Color">
</head>

<body>
  <h1>Tres círculos</h1>

  <p>Actualice la página para mostrar tres nuevos círculos.</p>

<?php
$r1 = rand(50, 150);
$r2 = rand(50, 150);
$r3 = rand(50, 150);
$ancho = 2 * $r1 + 2 * $r2 + 2 * $r3 + 20;
$alto  = 2 * max($r1, $r2, $r3) + 20;
$centros = max($r1, $r2, $r3);

print "  <p>\n";
print "    <svg version=\"1.1\" xmlns=\"http://www.w3.org/2000/svg\"\n";
print "      width=\"$ancho\" height=\"$alto\" viewBox=\"-10 -10 $ancho $alto\" style=\"background-color: white;\" font-family=\"sans-serif\">\n";
print "      <circle cx=\"$r1\" cy=\"$centros\" r=\"$r1\" stroke=\"black\" stroke-width=\"2\" fill=\"red\" />\n";
print "      <circle cx=\"" . (2 * $r1 + $r2) . "\" cy=\"$centros\" r=\"$r2\" stroke=\"black\" stroke-width=\"2\" fill=\"green\" />\n";
print "      <circle cx=\"" . (2 * $r1 + 2 * $r2 + $r3) . "\" cy=\"$centros\" r=\"$r3\" stroke=\"black\" stroke-width=\"2\" fill=\"blue\" />\n";
print "    </svg>\n";
print "  </p>\n";
?>

  <footer>
    <p class="ultmod">
      Última modificación de esta página:
      <time datetime="2018-11-05">5 de noviembre de 2018</time>
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
