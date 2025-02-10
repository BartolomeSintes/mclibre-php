<?php
/**
 * funciones (1) 1 - funciones-1-01.php
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
    Contar puntos.
    Funciones (1). Sin formularios.
    Ejercicios. PHP. Bartolomé Sintes Marco. www.mclibre.org
  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="mclibre-php-ejercicios.css" title="Color">
</head>

<body>
  <h1>Contar puntos</h1>

  <p>Actualice la página para mostrar una nueva tirada.</p>

<?php
function extraeSinRepeticion($m, $n)
{
    shuffle($m);
    $m2 = array_slice($m, 0, $n);
    shuffle($m2);
    return $m2;
}

$m  = range(1, 100);
$m2 = extraeSinRepeticion($m, 10);
print_r($m2);

$carasW10 = array_merge(range(128512, 128580), range(128577, 128580), range(129296, 129301), [129303], range(129312, 129317), range(129319, 129327), [129392, 129393, 129395, 129396, 129397, 129398, 129402, 129488]);
$carasW11 = array_merge([129394, 129400, 129401], range(129760, 129765), [129768, 129769]);

print count($carasW10);
exit;

print "<p style=\"font-size: 200%;\">";
foreach ($carasW10 as $cara) {
    print "$cara: &#{$cara}; - ";
}
print "</p>\n";

print_r($carasW10);

$numero = rand(1, 10);
$total  = 0;

if ($numero == 1) {
    print "  <h2>$numero dado</h2>\n";
} else {
    print "  <h2>$numero dados</h2>\n";
}
print "\n";
print "  <p>\n";
print "  </p>\n";
print "\n";
print "  <p>El total de puntos obtenidos es <strong>$total</strong>.</p>\n";
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
