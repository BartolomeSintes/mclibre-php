<?php
/**
 * Matrices (3) 4 - matrices-3-04.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2023 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2023-11-01
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
    Cartas sin repetición.
    Matrices (3). Sin formularios.
    Ejercicios. PHP. Bartolomé Sintes Marco. www.mclibre.org
  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="mclibre-php-ejercicios.css" title="Color">
</head>

<body>
  <h1>Cartas sin repetición</h1>

<?php
// Guardamos los valores de las cartas en la matriz $cartas
$n = rand(5, 10);
$cartas = range(1, 10);
// Barajamos las cartas
shuffle($cartas);
// Creamos una nueva matriz con los primeros valores de $cartas (el número de valores que queremos mostrar)
for ($i = 0; $i < $n; $i++) {
    $cartas2[] = $cartas[$i];
}

// Mostramos las imágenes de las cartas guardadas en $cartas2
print "  <h2>$n cartas sin repetición</h2>\n";
print "\n";
print "  <p>\n";
foreach ($cartas2 as $carta) {
    print "    <img src=\"img/cartas/c$carta.svg\" alt=\"$carta de corazones\" width=\"100\">\n";
}
print "  </p>\n";
print "\n";

?>
  <footer>
    <p class="ultmod">
      Última modificación de esta página:
      <time datetime="2023-11-01">1 de noviembre de 2023</time>
    </p>

    <p class="licencia">
      Este programa forma parte del curso <strong><a href="https://www.mclibre.org/consultar/php/">Programación
      web en PHP</a></strong> de <a href="https://www.mclibre.org/" rel="author" >Bartolomé Sintes Marco</a>.<br>
      El programa PHP que genera esta página se distribuye bajo
      <a rel="license" href="http://www.gnu.org/licenses/agpl.txt">licencia AGPL 3 o posterior</a>.
    </p>
  </footer>
</body>
</html>
