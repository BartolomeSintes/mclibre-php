<?php
/**
 * Matrices (1) 15 - matrices-1-15.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2021 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2021-10-27
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
    "Y" lógico.
    Matrices (1). Sin formularios.
    Ejercicios. PHP. Bartolomé Sintes Marco. www.mclibre.org
  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="mclibre-php-ejercicios.css" title="Color">
</head>

<body>
  <h1>"Y" lógico</h1>

  <p>Actualice la página para mostrar dos secuencias aleatorias de bits y su conjunción lógica.</p>

<?php
$numero = 10;

// Creamos la primera matriz de bits aleatorios
$inicial1 = [];
for ($i = 0; $i < $numero; $i++) {
    $inicial1[$i] = rand(0, 1);
}

// Mostramos los bits aleatorios de la primera matriz
print "  <pre style=\"font-size: 300%;\">\n";
print "   A   : ";
for ($i = 0; $i < $numero; $i++) {
    print "$inicial1[$i] ";
}
print "\n";
print "\n";

// Creamos la segunda matriz de bits aleatorios
$inicial2 = [];
for ($i = 0; $i < $numero; $i++) {
    $inicial2[$i] = rand(0, 1);
}

// Mostramos los bits aleatorios de la segunda matriz
print "   B   : ";
for ($i = 0; $i < $numero; $i++) {
    print "$inicial2[$i] ";
}
print "\n";
print "\n";

// Creamos la matriz con el resultado de la conjunción lógica
$resultado = [];
for ($i = 0; $i < $numero; $i++) {
    $resultado[$i] = $inicial1[$i] == 1 && $inicial2[$i] == 1 ? 1 : 0;
}

/* Otra forma de calcular los valores complementarios
// Creamos la matriz con el resultado de la conjunción lógica
$resultado = [];
for ($i = 0; $i < $numero; $i++) {
    $resultado[$i] = (int)($inicial1[$i] && $inicial2[$i]);
}
 */

// Mostramos los valores calculados
print "A and B: ";
for ($i = 0; $i < $numero; $i++) {
    print "$resultado[$i] ";
}
print "\n";
print "</pre>\n";
?>

  <footer>
    <p class="ultmod">
      Última modificación de esta página:
      <time datetime="2021-10-27">27 de octubre de 2021</time>
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
