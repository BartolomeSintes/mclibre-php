<?php
/**
 * Matrices (3) 2 - matrices-3-02.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2021 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2021-10-31
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
    La carta más alta.
    Matrices (3). Sin formularios.
    Ejercicios. PHP. Bartolomé Sintes Marco. www.mclibre.org
  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="mclibre-php-ejercicios.css" title="Color">
</head>

<body>
  <h1>La carta más alta</h1>

<?php
// Guardamos los valores de las cartas en la matriz $cartas
$n = rand(5, 10);
for ($i = 0; $i < $n; $i++) {
    $cartas[] = rand(1, 10);
}

// Mostramos las imágenes de las cartas obtenidas
print "  <h2>Cartas</h2>\n";
print "\n";
print "  <p>\n";
foreach ($cartas as $carta) {
    print "    <img src=\"img/cartas/t$carta.svg\" alt=\"$carta de tréboles\" width=\"100\">\n";
}
print "  </p>\n";
print "\n";

// Calculamos el valor máximo
$eliminar = max($cartas);

// Mostramos el valor máximo
print "<p>La carta más alta es un $eliminar.</p>\n";
print "\n";

// Mostramos la carta de valor máximo
print "  <h2>Carta a eliminar</h2>\n";
print "\n";
print "  <p>\n";
print "    <img src=\"img/cartas/t$eliminar.svg\" alt=\"$eliminar de tréboles\" width=\"100\">\n";
print "  </p>\n";
print "\n";

// Recorremos la matriz de valores de cartas y eliminamos los elementos que coinciden con el máximo
for ($i = 0; $i < $n; $i++) {
    if ($cartas[$i] == $eliminar) {
        unset($cartas[$i]);
    }
}

// Mostramos las imágenes de las cartas (las eliminadas ya no se mostrarán)
print "  <h2>Cartas restantes</h2>\n";
print "\n";
print "  <p>\n";
foreach ($cartas as $carta) {
    print "    <img src=\"img/cartas/t$carta.svg\" alt=\"$carta de tréboles\" width=\"100\">\n";
}
print "  </p>\n";
print "\n";

// Calculamos y mostramos el valor máximo actual
print "<p>La carta más alta es ahora un " . max($cartas) . ".</p>\n";
print "\n";

?>
  <footer>
    <p class="ultmod">
      Última modificación de esta página:
      <time datetime="2021-10-31">31 de octubre de 2021</time>
    </p>

    <p class="licencia">
      Este programa forma parte del curso <strong><a href="http://www.mclibre.org/consultar/php/">Programación
      web en PHP</a></strong> de <a href="http://www.mclibre.org/" rel="author" >Bartolomé Sintes Marco</a>.<br>
      El programa PHP que genera esta página se distribuye bajo
      <a rel="license" href="http://www.gnu.org/licenses/agpl.txt">licencia AGPL 3 o posterior</a>.
    </p>
  </footer>
</body>
</html>
