<?php
/**
 * funciones (1) 1 - funciones-1-01.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2024 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2024-11-13
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

function generaMatrizRand($n, $min, $max)
{
    for ($i = 0; $i < $n; $i++) {
        $m[] = rand($min, $max);
    }
    return $m;
}

function invierteMatriz($m)
{
    $m2 = array_values($m);
    for ($i = count($m2) - 1; $i >= 0; $i--) {
        $m3[] = $m2[$i];
    }
    return $m3;
}

function extraeValores($m, $n)
{
    $m2 = array_rand($m, $n);
    foreach ($m2 as $valor) {
        $m3[] = $m[$valor];
    }
    shuffle($m3);
    return $m3;
}

function valoresComunesNoRepetidos($m1, $m2)
{
    $m1b = array_unique($m1);
    $m2b = array_unique($m2);
    foreach ($m1b as $valor) {
        if (in_array($valor, $m2b)) {
            $m3[] = $valor;
        }
    }
    return $m3;
}

$m1 = generaMatrizRand(10, 10, 20);
print "<p>generaMatriz: " . print_r($m1, true) . "</p>";

$m2 = invierteMatriz($m1);
print "<p>invierteMatriz: " . print_r($m2, true) . "</p>";

$m3 = extraeValores($m1, 5);
print "<p>extraeValores: " . print_r($m3, true) . "</p>";

$m1 = generaMatrizRand(10, 10, 20);
print "<p>generaMatriz: " . print_r($m1, true) . "</p>";
$m2 = generaMatrizRand(10, 10, 20);
print "<p>generaMatriz: " . print_r($m2, true) . "</p>";
$m3 = valoresComunesNoRepetidos($m1, $m2);
print "<p>valoresComunesNoRepetidos: " . print_r($m3, true) . "</p>";

exit;

$numero = rand(1, 10);
$total  = 0;

if ($numero == 1) {
    print "  <h2>$numero dado</h2>\n";
} else {
    print "  <h2>$numero dados</h2>\n";
}
print "\n";
print "  <p>\n";
for ($i = 0; $i < $numero; $i++) {
    $dado = rand(1, 6);
    pintaDado($dado);
    $total += $dado;
}
print "  </p>\n";
print "\n";
print "  <p>El total de puntos obtenidos es <strong>$total</strong>.</p>\n";
?>

  <footer>
    <p class="ultmod">
      Última modificación de esta página:
      <time datetime="2024-11-13">13 de noviembre de 2024</time>
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
