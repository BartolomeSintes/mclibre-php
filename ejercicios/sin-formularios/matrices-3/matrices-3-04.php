<?php
/**
 * Matrices (3) 4 - matrices-3-04.php
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
    Busca emoticono.
    Matrices (3). Sin formularios.
    Ejercicios. PHP. Bartolomé Sintes Marco. www.mclibre.org
  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="mclibre-php-ejercicios.css" title="Color">
</head>

<body>
  <h1>Busca emoticono</h1>

  <p>Actualice la página para mostrar un nuevo grupo de emoticonos.</p>

<?php
$numero = rand(10, 20);

// Guardamos los valores de los emoticonos en la matriz $emoticonos
$emoticonos = [];
for ($i = 0; $i < $numero; $i++) {
    $emoticonos[$i] = rand(128512, 128580);
}

// Mostramos las imágenes de los emoticonos obtenidos
print "  <h2>$numero emoticonos ...</h2>\n";
print "\n";
print "  <p style=\"font-size: 400%; margin: 0;\">\n";
foreach ($emoticonos as $emoticono) {
    print "    &#$emoticono;\n";
}
print "  </p>\n";
print "\n";

// Emoticono a buscar
$busca = rand(128512, 128580);

// Mostramos el resultado de la búsqueda
if (in_array($busca, $emoticonos)) {
  print "  <p>El emoticono <span style=\"font-size: 400%;\">&#$busca;</span> está entre ellos.</p>\n";
} else {
  print "  <p>El emoticono <span style=\"font-size: 400%;\">&#$busca;</span> NO está entre ellos.</p>\n";
}
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
