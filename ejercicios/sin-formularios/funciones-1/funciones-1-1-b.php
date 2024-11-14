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

function pintaDado($numero)
{
    print "    <svg version=\"1.1\" xmlns=\"http://www.w3.org/2000/svg\" width=\"140\" height=\"140\" viewBox=\"-10 -10 140 140\">\n";
    print "      <rect x=\"0\" y=\"0\" width=\"120\" height=\"120\" rx=\"10\" ry=\"10\" fill=\"#E0E0E0\"  stroke=\"black\" stroke-width=\"5\" />\n";
    if ($numero == 2 || $numero == 3 || $numero == 4 || $numero == 5 || $numero == 6) {
        print "      <circle cx=\"30\" cy=\"32\" r=\"9\" fill=\"white\" />\n";
        print "      <circle cx=\"30\" cy=\"30\" r=\"9\" fill=\"black\" />\n";
    }
    if ($numero == 6) {
        print "      <circle cx=\"30\" cy=\"62\" r=\"9\" fill=\"white\" />\n";
        print "      <circle cx=\"30\" cy=\"60\" r=\"9\" fill=\"black\" />\n";
    }
    if ($numero == 4 || $numero == 5 || $numero == 6) {
        print "      <circle cx=\"30\" cy=\"92\" r=\"9\" fill=\"white\" />\n";
        print "      <circle cx=\"30\" cy=\"90\" r=\"9\" fill=\"black\" />\n";
    }
    if ($numero == 1 || $numero == 3 || $numero == 5) {
        print "      <circle cx=\"60\" cy=\"62\" r=\"9\" fill=\"white\" />\n";
        print "      <circle cx=\"60\" cy=\"60\" r=\"9\" fill=\"black\" />\n";
    }
    if ($numero == 4 || $numero == 5 || $numero == 6) {
        print "      <circle cx=\"90\" cy=\"32\" r=\"9\" fill=\"white\" />\n";
        print "      <circle cx=\"90\" cy=\"30\" r=\"9\" fill=\"black\" />\n";
    }
    if ($numero == 6) {
        print "      <circle cx=\"90\" cy=\"62\" r=\"9\" fill=\"white\" />\n";
        print "      <circle cx=\"90\" cy=\"60\" r=\"9\" fill=\"black\" />\n";
    }
    if ($numero == 2 || $numero == 3 || $numero == 4 || $numero == 5 || $numero == 6) {
        print "      <circle cx=\"90\" cy=\"92\" r=\"9\" fill=\"white\" />\n";
        print "      <circle cx=\"90\" cy=\"90\" r=\"9\" fill=\"black\" />\n";
    }
    print "    </svg>\n";
    print "\n";
}

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
