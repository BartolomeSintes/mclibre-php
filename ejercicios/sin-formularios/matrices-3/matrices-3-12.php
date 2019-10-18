<?php
/**
 * Matrices (3) 12 - matrices-3-12.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2018 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2018-11-05
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
  <meta charset="utf-8">
  <title>
    Ordenar cartas.
    Matrices (3). Sin formularios.
    Ejercicios. PHP. Bartolomé Sintes Marco. www.mclibre.org
  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="mclibre-php-ejercicios.css" title="Color">
</head>

<body>
  <h1>Ordenar cartas</h1>

  <p>Actualice la página para mostrar una nueva mano.</p>

<?php
$numero = rand(5, 10);

// Creamos la matriz de cartas aleatorias
$cartas = [];
for ($i = 0; $i < $numero; $i++) {
    $cartas[$i] = rand(127169, 127173);
}

// Mostramos las cartas
print "  <h2>Mano de $numero cartas</h2>\n";
print "\n";
print "  <p style=\"font-size: 700%; margin: 0; line-height: 100%;\">\n";
foreach ($cartas as $carta) {
    print "    &#$carta;\n";
}
print "  </p>\n";
print "\n";

// Ordenamos las cartas
$cartas_2 = array_unique($cartas);
sort($cartas_2);

// Mostramos las cartas ordenadas
print "  <h2>Cartas distintas obtenidas (ordenadas)</h2>\n";
print "\n";
print "  <p style=\"font-size: 700%; margin: 0; line-height: 100%;\">\n";
foreach ($cartas_2 as $carta) {
    print "    &#$carta;\n";
}
print "  </p>\n";
print "\n";

// Contamos las cartas
$cartas_3 = array_count_values($cartas);

// Mostramos las cartas contadas
print "  <h2>Número de cartas obtenidas (sin ordenar)</h2>\n";
print "\n";
print "  <p style=\"line-height: 600%;\">\n";
foreach ($cartas_3 as $indice => $valor) {
    print "    <span style=\"font-size: 500%;\">$valor</span> <span style=\"font-size: 700%;\">&#$indice; - </span>\n";
}
print "  </p>\n";
print "\n";

// Ordenamos las cartas
arsort($cartas_3);

// Mostramos las cartas contadas ordenadas
print "  <h2>Número de cartas obtenidas (ordenada)</h2>\n";
print "\n";
print "  <p style=\"line-height: 600%;\">\n";
foreach ($cartas_3 as $indice => $valor) {
    print "    <span style=\"font-size: 500%;\">$valor</span> <span style=\"font-size: 700%;\">&#$indice; - </span>\n";
}
print "  </p>\n";

?>

  <footer>
    <p class="ultmod">
      Última modificación de esta página:
      <time datetime="2019-10-17">17 de octubre de 2019</time>
    </p>

    <p class="licencia">
      Este programa forma parte del curso <strong><a href="http://www.mclibre.org/consultar/php/">Programación
      web en PHP</a></strong> de <a href="http://www.mclibre.org/" rel="author">Bartolomé Sintes Marco</a>.<br>
      El programa PHP que genera esta página se distribuye bajo
      <a rel="license" href="http://www.gnu.org/licenses/agpl.txt">licencia AGPL 3 o posterior</a>.
    </p>
  </footer>
</body>
</html>
