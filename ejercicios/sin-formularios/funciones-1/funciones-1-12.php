<?php
/**
 * funciones (1) 12 - funciones-1-12.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2025 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2025-12-09
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
    Función miArraySum().
    Funciones (1). Sin formularios.
    Ejercicios. PHP. Bartolomé Sintes Marco. www.mclibre.org
  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="mclibre-php-ejercicios.css" title="Color">
</head>

<body>
  <h1>Función miArraySum()</h1>

  <p>Actualice la página para mostrar dos nuevas matrices y sus sumas.</p>

<?php
function generaMatrizEnterosRand(int $n, int $min, int $max): array
{
    for ($i = 0; $i < $n; $i++) {
        $m[] = rand($min, $max);
    }
    return $m;
}

function generaMatrizDecimalesRand(int $n, int $min, int $max): array
{
    for ($i = 0; $i < $n; $i++) {
        $m[] = rand($min * 10, $max * 10) / 10;
    }
    return $m;
}

function miArraySum(array $array): int|float
{
    $total = 0;
    foreach ($array as $valor) {
        $total += $valor;
    }
    return $total;
}

$n = rand(3, 7);
$m = generaMatrizEnterosRand($n, 1, 10);

print "  <h2>Suma de $n valores enteros</h2>\n";
print "\n";
print "  <pre>\n" . print_r($m, true) . "</pre>\n";
print   "\n";
print   "  <p>Suma de valores: " . miArraySum($m) . "</p>\n";
print   "\n";

$n = rand(3, 7);
$m = generaMatrizDecimalesRand($n, 1, 10);

print "  <h2>Suma de $n valores decimales</h2>\n";
print "\n";
print "  <pre>\n" . print_r($m, true) . "</pre>\n";
print   "\n";
print   "  <p>Suma de valores: " . miArraySum($m) . "</p>\n";
print "\n";
?>
  <footer>
    <p class="ultmod">
      Última modificación de esta página:
      <time datetime="2025-12-09">9 de diciembre de 2025</time>
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
