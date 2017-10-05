<?php
/**
 * for (1) 12 - for-1-12.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2017 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2017-10-05
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
  <title>Diana. for (1). Sin formularios.
    Ejercicios. Programación web en PHP. Bartolomé Sintes Marco</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="mclibre-php-soluciones.css" rel="stylesheet" type="text/css" title="Color" />
</head>

<body>
  <h1>Diana</h1>

  <p>Actualice la página para mostrar una nueva tirada.</p>

<?php
print "  <p>\n";
print "    <svg version=\"1.1\" xmlns=\"http://www.w3.org/2000/svg\" \n";
print "      width=\"400px\" height=\"400px\" viewBox=\"-200 -200 400 400\">\n";

for ($i = 0; $i < 4; $i++) {
    print "      <circle cx=\"0\" cy=\"0\" r=\"" . (200 - 50 * $i) . "\" fill=\"red\" />\n";
    print "      <circle cx=\"0\" cy=\"0\" r=\"" . (200 - 50 * $i - 25) . "\" fill=\"#ddd\" />\n";
}

$disparos = rand(1,10);
for ($i = 0; $i < $disparos; $i ++) {
    $x = rand(-180, 180);
    $y = rand(-180, 180);
    print "      <path fill=\"black\" stroke=\"white\" stroke-width=\"2\" "
     . "d=\"m $x,$y 3.5,-1.1 3.0,-2.7 4.4,2.5 3.6,0.6 0.5,2.9 2.2,2.9 -2.2,3.1 "
     . "-0.1,3.6 -3.3,0.2 -1.7,2.7 -4,-1.4 -3.9,0.2 -0.9,-4.2 -2.7,-2.6 1.7,-3.4 z\" />\n";
}
print "    </svg>\n";
print "  </p>\n";
print "\n";
print "  <h2>Estadísticas</h2>\n";
print "\n";
print "  <ul>\n";
print "    <li>Número de disparos: <strong>$disparos</strong>.</li>\n";
print "  </ul>\n";
?>

  <footer>
    <p class="ultmod">
      Última modificación de esta página:
      <time datetime="2017-10-05">5 de octubre de 2017</time></p>

    <p class="licencia">
      Este programa forma parte del curso <a href="http://www.mclibre.org/consultar/php/">
      Programación web en PHP</a> por <a href="http://www.mclibre.org/">Bartolomé
      Sintes Marco</a>.<br />
      El programa PHP que genera esta página está bajo
      <a rel="license" href="http://www.gnu.org/licenses/agpl.txt">licencia AGPL 3 o posterior</a>.</p>
  </footer>
</body>
</html>
