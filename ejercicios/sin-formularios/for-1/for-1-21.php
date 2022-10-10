<?php
/**
 * for (1) 21 - for-1-21.php
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
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>
    Diana.
    for (1). Sin formularios.
    Ejercicios. PHP. Bartolomé Sintes Marco. www.mclibre.org
  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="mclibre-php-ejercicios.css" title="Color">
</head>

<body>
  <h1>Diana</h1>

  <p>Actualice la página para mostrar una nueva tirada.</p>

<?php
print "  <p>\n";
print "    <svg version=\"1.1\" xmlns=\"http://www.w3.org/2000/svg\" \n";
print "      width=\"420\" height=\"420\" viewBox=\"-210 -210 420 420\">\n";

for ($i = 0; $i < 5; $i++) {
    print "      <circle cx=\"0\" cy=\"0\" r=\"" . 200 - 40 * $i . "\" fill=\"red\" />\n";
    print "      <circle cx=\"0\" cy=\"0\" r=\"" . 200 - 40 * $i - 20 . "\" fill=\"#ddd\" />\n";
}

for ($i = 0; $i < 10; $i++) {
    print "      <text x=\"0\" y=\"" . 195 - 20 * $i
        . "\" text-anchor=\"middle\" font-size=\"13\">" . $i + 1 . "</text>\n";
}

$puntos   = 0;
$disparos = rand(1, 10);
for ($i = 0; $i < $disparos; $i++) {
    $x = rand(-200, 200);
    $y = rand(-200, 200);
    $puntos += (10 - intdiv(sqrt($x ** 2 + $y ** 2), 20) > 0) ? 10 - intdiv(sqrt($x ** 2 + $y ** 2), 20) : 0;
    print "      <path fill=\"black\" stroke=\"white\" stroke-width=\"2\" "
     . "d=\"m $x,$y m -1,-9 4.4,2.5 3.6,0.6 0.5,2.9 2.2,2.9 -2.2,3.1 "
     . "-0.1,3.6 -3.3,0.2 -1.7,2.7 -4,-1.4 -3.9,0.2 -0.9,-4.2 -2.7,-2.6 1.7,-3.4 0,-3 z\" />\n";
}
print "    </svg>\n";
print "  </p>\n";
print "\n";
print "  <h2>Estadísticas</h2>\n";
print "\n";
print "  <ul>\n";
print "    <li>Número de disparos: <strong>$disparos</strong>.</li>\n";
print "    <li>Puntuación obtenida: <strong>$puntos</strong>.</li>\n";
print "  </ul>\n";
?>

  <footer>
    <p class="ultmod">
      Última modificación de esta página:
      <time datetime="2022-10-10">10 de octubre de 2022</time>
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
