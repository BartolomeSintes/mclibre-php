<?php
/**
 * funciones (1) 1 - funciones-1-01.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2024 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2024-11-28
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
    Genera matrices de valores aleatorios.
    Funciones (1). Sin formularios.
    Ejercicios. PHP. Bartolomé Sintes Marco. www.mclibre.org
  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="mclibre-php-ejercicios.css" title="Color">
</head>

<body>
  <h1>Genera matrices de valores aleatorios</h1>

  <p>Actualice la página para mostrar tres nuevas matrices.</p>

<?php

function generaMatrizRand(int $n, int $min, int $max)
{
    $m = [];
    for ($i = 0; $i < $n; $i++) {
        $m[] = rand($min, $max);
    }
    return $m;
}

$numero = 3;

for ($i = 0; $i < $numero; $i++) {
    $n   = rand(0, 5);
    $min = rand(0, 100);
    $max = $min + rand(1, 10);
    $m  = generaMatrizRand($n, $min, $max);
    if ($n == 1) {
        print "  <h2>$n valor - Mínimo: $min - Máximo: $max</h2>\n";
    } else {
        print "  <h2>$n valores - Mínimo: $min - Máximo: $max</h2>\n";
    }
    print "\n";
    print "  <pre>" . print_r($m, true) . "</pre>\n";
    print "\n";
}
?>

  <footer>
    <p class="ultmod">
      Última modificación de esta página:
      <time datetime="2024-11-28">28 de noviembre de 2024</time>
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
