<?php
/**
 * for (2) 07 - for-2-07.php
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
    Arco iris circular.
    for (2). Sin formularios.
    Ejercicios. PHP. Bartolomé Sintes Marco. www.mclibre.org
  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="mclibre-php-ejercicios.css" title="Color">
</head>

<body>
  <h1>Arco iris circular</h1>

  <p>Actualice la página para mostrar un nuevo dibujo.</p>

<?php
$numero = rand(3,10);
$paso = 360 / $numero;

print "  <h2>$numero colores</h2>\n";
print "\n";
print "  <p>\n";
print "    <svg version=\"1.1\" xmlns=\"http://www.w3.org/2000/svg\" \n";
print "      width=\"" . 60 * $numero . "\" height=\"" . 60 * $numero . "\" "
    . " viewbox=\"" . - 30 * $numero . " " . - 30 * $numero . " " . 60 * $numero . " " . 60 * $numero . "\">\n";

for ($i = 0; $i < $numero; $i++) {
    print "      <circle cx=\"0\" cy=\"0\" r=\"" . (-30 * $i + 30 * $numero) . "\" fill=\"hsl(" . round($i * $paso) . ", 75%, 50%)\" />\n";
}

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
