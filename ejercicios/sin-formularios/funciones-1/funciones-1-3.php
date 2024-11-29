<?php
/**
 * funciones (1) 3 - funciones-1-03.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2024 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2024-11-29
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
    Tres filas de círculos de colores.
    Funciones (1). Sin formularios.
    Ejercicios. PHP. Bartolomé Sintes Marco. www.mclibre.org
  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="mclibre-php-ejercicios.css" title="Color">
</head>

<body>
  <h1>Tres filas de círculos de colores</h1>

  <p>Actualice la página para mostrar tres nuevas filas de círculos.</p>

<?php

function generaMatrizValoresRand(array $m, int $n): array
{
    $resultado = [];
    for ($i = 0; $i < $n; $i++) {
        $resultado[] = $m[array_rand($m)];
    }
    return $resultado;
}

function pintaCirculos(array $colores): void
{
    print "  <p>\n";
    foreach ($colores as $color) {
        print "    <svg version=\"1.1\" xmlns=\"http://www.w3.org/2000/svg\" width=\"60\" viewbox=\"-5 -5 60 60\">\n";
        print "      <circle cx=\"25\" cy=\"25\" r=\"25\" fill=\"$color\" stroke=\"black\" />\n";
        print "    </svg>\n";
        print "\n";
    }
    print "  </p>\n";
    print "\n";
}

$colores = ["black", "blue", "green", "gray", "red", "white", "yellow"];
$n       = rand(5, 10);

$valores = generaMatrizValoresRand($colores, $n);
print "<h2>$n círculos de colores</h2>\n";
print "\n";
pintaCirculos($valores);

$valores = generaMatrizValoresRand($colores, $n);
print "<h2>$n círculos de colores</h2>\n";
print "\n";
pintaCirculos($valores);

$valores = generaMatrizValoresRand($colores, $n);
print "<h2>$n círculos de colores</h2>\n";
print "\n";
pintaCirculos($valores);
?>

  <footer>
    <p class="ultmod">
      Última modificación de esta página:
      <time datetime="2024-11-29">29 de noviembre de 2024</time>
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
