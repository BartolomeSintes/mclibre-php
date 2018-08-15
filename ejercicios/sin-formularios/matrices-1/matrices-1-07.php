<?php
/**
 * Matrices (1) 7 - matrices-1-07.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2017 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2017-10-13
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
  <meta charset="utf-8" />
  <title>"Y" lógico. Matrices (1).
    Ejercicios. Programación web en PHP. Bartolomé Sintes Marco</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="mclibre-php-soluciones.css" rel="stylesheet" type="text/css" title="Color" />
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
print "\n";
print "  <pre style=\"font-size: 300%;\">\n";
print "   A   : ";
for ($i = 0; $i < $numero; $i++) {
    print "$inicial1[$i] ";
}
print "\n";

// Creamos la segunda matriz de bits aleatorios
$inicial2 = [];
for ($i = 0; $i < $numero; $i++) {
    $inicial2[$i] = rand(0, 1);
}

// Mostramos los bits aleatorios de la segunda matriz
print "\n";
print "   B   : ";
for ($i = 0; $i < $numero; $i++) {
    print "$inicial2[$i] ";
}
print "\n";

// Creamos la matriz con el resultado de la conjunción lógica
$resultado = [];
for ($i = 0; $i < $numero; $i++) {
    if ($inicial1[$i] == 1 && $inicial2[$i] == 1 ) {
        $resultado[$i] = 1;
    } else {
        $resultado[$i] = 0;
    }
}

/* Otra forma de calcular los valores complementarios
// Creamos la matriz con el resultado de la conjunción lógica
$resultado = [];
for ($i = 0; $i < $numero; $i++) {
    $resultado[$i] = (int)($inicial1[$i] && $inicial2[$i]);
}
*/

// Mostramos los valores calculados
print "\n";
print "A and B: ";
for ($i = 0; $i < $numero; $i++) {
    print "$resultado[$i] ";
}
print "</pre>\n";
?>

  <footer>
    <p class="ultmod">
      Última modificación de esta página:
      <time datetime="2017-10-13">13 de octubre de 2017</time>
    </p>

    <p class="licencia">
      Este programa forma parte del curso <a href="http://www.mclibre.org/consultar/php/">
      Programación web en PHP</a> por <a href="http://www.mclibre.org/">Bartolomé
      Sintes Marco</a>.<br />
      El programa PHP que genera esta página está bajo
      <a rel="license" href="http://www.gnu.org/licenses/agpl.txt">licencia AGPL 3 o posterior</a>.</p>
  </footer>
</body>
</html>
