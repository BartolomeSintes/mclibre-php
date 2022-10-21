<?php
/**
 * Matrices (1) 12 - matrices-1-12-b.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2022 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2022-10-21
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
    Negación.
    Matrices (1). Sin formularios.
    Ejercicios. PHP. Bartolomé Sintes Marco. www.mclibre.org
  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="mclibre-php-ejercicios.css" title="Color">
</head>

<body>
  <h1>Negación de bits</h1>

  <p>Actualice la página para mostrar una secuencia aleatoria de bits y su complementaria.</p>

<?php
$numero = 10;

// Creamos la matriz de bits aleatorios
$inicial = [];
for ($i = 0; $i < $numero; $i++) {
    $inicial[$i] = rand(0, 1);
}

// Mostramos los bits aleatorios
print "  <pre style=\"font-size: 300%;\">\n";
print "A: ";
foreach ($inicial as $bit) {
    print "$bit ";
}
print "\n";
print "\n";

// Creamos la matriz con los valores complementarios
$resultado = [];
for ($i = 0; $i < $numero; $i++) {
    $resultado[$i] = $inicial[$i] == 1 ? 0 : 1;
}

// Otra forma de calcular los valores complementarios
// Creamos la matriz con los valores complementarios
// $resultado = [];
// for ($i = 0; $i < $numero; $i++) {
//     $resultado[$i] = 1 - $inicial[$i];
// }

// Mostramos los valores complementarios
print "<span style=\"text-decoration: overline\">A</span>: ";
foreach ($resultado as $bit) {
    print "$bit ";
}
print "\n";
print "</pre>\n";
?>

  <footer>
    <p class="ultmod">
      Última modificación de esta página:
      <time datetime="2021-10-21">21 de octubre de 2022</time>
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
