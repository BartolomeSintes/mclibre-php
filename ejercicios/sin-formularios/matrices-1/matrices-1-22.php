<?php
/**
 * Matrices (1) 22 - matrices-1-22.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2019 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2019-10-17
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
    Elimina un animal.
    Matrices (1). Sin formularios.
    Ejercicios. PHP. Bartolomé Sintes Marco. www.mclibre.org
  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="mclibre-php-ejercicios.css" title="Color">
</head>

<body>
  <h1>Elimina un animal</h1>

  <p>Actualice la página para mostrar un nuevo grupo de animales.</p>

<?php
$numero = rand(20, 30);

// Guardamos los valores de los animales en la matriz $animales
$animales = [];
for ($i = 0; $i < $numero; $i++) {
    $animales[$i] = rand(128000, 128060);
}

// Mostramos las imágenes de los animales obtenidos
print "  <h2>$numero animales</h2>\n";

print "\n";
print "  <p style=\"font-size: 400%; margin: 0;\">\n";
foreach ($animales as $animal) {
    print "    &#$animal;\n";
}
print "  </p>\n";
print "\n";

// Guardamos el valor del animal a descartar
$descarta = $animales[rand(0, $numero - 1)];

// Mostramos el animal a descartar
print "  <h2>Animal a eliminar</h2>\n";
print "\n";
print "  <p style=\"font-size: 400%; margin: 0;\">\n";
print "    &#$descarta;\n";
print "  </p>\n";
print "\n";

// Eliminamos el animal de la matriz
for ($i = 0; $i < $numero; $i++) {
    if ($animales[$i] == $descarta) {
        unset($animales[$i]);
    }
}

// Mostramos las imágenes de los animales restantes
print "  <h2>Quedan " . count($animales) . " animales</h2>\n";
print "\n";
if (count($animales) == 0) {
    print "<p>No quedan animales.</p>\n";
} else {
    print "  <p style=\"font-size: 400%; margin: 0;\">\n";
    foreach ($animales as $animal) {
        print "    &#$animal;\n";
    }
}
print "  </p>\n";
print "\n";

?>

  <footer>
    <p class="ultmod">
      Última modificación de esta página:
      <time datetime="2019-10-17">17 de octubre de 2019</time>
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
