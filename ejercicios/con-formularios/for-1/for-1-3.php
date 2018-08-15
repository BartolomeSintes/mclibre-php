<?php
/**
 * Sucesiones aritméticas 3 - for-1-3.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2016 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2016-11-04
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
  <title>Sucesiones aritméticas (3). for (1).
    Ejercicios. PHP. Bartolomé Sintes Marco</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="mclibre-php-soluciones.css" rel="stylesheet" type="text/css" title="Color" />
</head>

<body>
  <h1>Sucesiones aritméticas (3)</h1>

  <p>Valores generados por bucles que imprimen $i:</p>

<?php
print "  <pre>\n";

for ($i = 2; $i <= 11; $i++) {
    printf("%6d", $i);
}
print "\n";

for ($i = 2; $i <= 18; $i = $i + 2) {
    printf("%6d", $i);
}
print "\n";

for ($i = 5; $i <= 32; $i = $i + 3) {
    printf("%6d", $i);
}
print "\n";

for ($i = 0; $i <= 25; $i = $i + 5) {
    printf("%6d", $i);
}
print "\n";

for ($i = 8; $i >= -10; $i = $i - 2) {
    printf("%6d", $i);
}
print "\n";

for ($i = 40; $i >= 10; $i = $i - 5) {
    printf("%6d", $i);
}
print "\n";

for ($i = -7; $i >= -49; $i = $i - 6) {
    printf("%6d", $i);
}
print "\n";

print "</pre>\n";
?>

  <footer>
    <p class="ultmod">
      Última modificación de esta página:
      <time datetime="2016-11-04">4 de noviembre de 2016</time>
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
