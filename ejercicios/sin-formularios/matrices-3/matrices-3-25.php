<?php
/**
 * Matrices (3) 25 - matrices-3-25.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2025 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2025-02-14
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
    Cartas pares iguales consecutivas.
    Matrices (3). Sin formularios.
    Ejercicios. PHP. Bartolomé Sintes Marco. www.mclibre.org
  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="mclibre-php-ejercicios.css" title="Color">
</head>

<body>
  <h1>Cartas pares iguales consecutivas</h1>

<?php
// Guardamos los valores de las cartas en la matriz $cartas
$n      = rand(3, 12);
$cartas = [];
for ($i = 0; $i < $n; $i++) {
    $cartas[] = rand(1, 10);
}

// Mostramos las imágenes de las cartas obtenidas
print "  <h2>Las $n cartas</h2>\n";
print "\n";
print "  <p>\n";
foreach ($cartas as $carta) {
    print "    <img src=\"img/cartas/c$carta.svg\" alt=\"$carta de corazones\" width=\"100\">\n";
}
print "  </p>\n";
print "\n";

// Recorremos la matriz de cartas y si el valor de la carta es par, eliminamos el valor
for ($i = 0; $i < $n; $i++) {
    if ($cartas[$i] % 2) {
        unset($cartas[$i]);
    }
}

// Mostramos las imágenes de las cartas (las eliminadas ya no se mostrarán)
print "  <h2>Sin cartas impares</h2>\n";
print "\n";
print "  <p>\n";
foreach ($cartas as $carta) {
    print "    <img src=\"img/cartas/c$carta.svg\" alt=\"$carta de corazones\" width=\"100\">\n";
}
print "  </p>\n";
print "\n";

// Reindexamos la matriz de cartas para poderla recorrer con un bucle for
// y que los índices sean consecutivos
$cartas = array_values($cartas);

// Recorremos la matriz de cartas (hasta el penúltimo valor)
// comparando cada valor con el siguiente y si coinciden
// damos el valor true a la variable testigo $consecutivas
$consecutivas = false;
for ($i = 0; $i < count($cartas) - 1; $i++) {
    if ($cartas[$i] == $cartas[$i + 1]) {
        $consecutivas = true;
    }
}

// Según el valor de consecutivas mostramos un mensaje distinto
print $consecutivas ? "  <p>Hay cartas iguales consecutivas</p>\n" : "  <p>No hay cartas iguales consecutivas</p>\n";
print "\n";
?>
  <footer>
    <p class="ultmod">
      Última modificación de esta página:
      <time datetime="2025-02-14">14 de febrero de 2025</time>
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
