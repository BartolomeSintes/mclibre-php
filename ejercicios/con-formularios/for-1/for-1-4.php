<?php
/**
 * Sucesiones numéricas - for-1-4.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2016 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2016-11-04
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
    Sucesiones numéricas. for (1).
    Ejercicios. PHP. Bartolomé Sintes Marco. www.mclibre.org
  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="mclibre-php-ejercicios.css" title="Color">
</head>

<body>
  <h1>Sucesiones numéricas</h1>

  <p>Valores generados por bucles que suben de 1 en 1:</p>

<?php
print "  <pre>\n";

for ($i = 1; $i <= 10; $i++) {
    printf("%8d", $i * $i);
}
print "\n";

for ($i = 1; $i <= 9; $i++) {
    printf("%8d", $i * $i + 1);
}
print "\n";

for ($i = 2; $i <= 7; $i++) {
    printf("%8d", $i * $i * $i);
}
print "\n";

for ($i = 1; $i <= 8; $i++) {
    printf("   %1.3f", 1 / $i);
}
print "\n";

for ($i = 1; $i <= 7; $i++) {
    printf("%8d", $i * ($i + 1));
}
print "\n";

for ($i = 0; $i <= 5; $i++) {
    printf("%8d", 10 ** $i);
}
print "\n";

for ($i = 0; $i <= 4; $i++) {
    printf("  %1.4f", 1 / 10 ** $i);
}
print "\n";

for ($i = 0; $i <= 7; $i++) {
    printf("%8d", -1 ** $i);
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
      Este programa forma parte del curso <strong><a href="https://www.mclibre.org/consultar/php/">Programación
      web en PHP</a></strong> de <a href="https://www.mclibre.org/" rel="author">Bartolomé Sintes Marco</a>.<br>
      El programa PHP que genera esta página se distribuye bajo
      <a rel="license" href="http://www.gnu.org/licenses/agpl.txt">licencia AGPL 3 o posterior</a>.
    </p>
  </footer>
</body>
</html>
