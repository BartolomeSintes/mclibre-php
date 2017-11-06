<?php
/**
 * Matrices (1) 11 - matrices-1-11.php
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
  <title>Ordenar dados. Matrices (1).
    Ejercicios. Programación web en PHP. Bartolomé Sintes Marco</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="mclibre-php-soluciones.css" rel="stylesheet" type="text/css" title="Color" />
</head>

<body>
  <h1>Ordenar dados</h1>

  <p>Actualice la página para mostrar una nueva tirada.</p>

<?php
$numero = rand(2, 7);

// Creamos la matriz de dados aleatorios
$dados = [];
for ($i = 0; $i < $numero; $i++) {
    $dados[$i] = rand(1, 6);
}

// Mostramos los dados
print "  <h2>Tirada de $numero dados</h2>\n";
print "\n";
print "  <p>\n";
for ($i = 0; $i < $numero; $i++) {
    print "    <img src=\"img/$dados[$i].svg\" alt=\"$dados[$i]\" title=\"$dados[$i]\" width=\"140\" height=\"140\" />\n";
}
print "  </p>\n";
print "\n";

// Ordenamos los dados
sort($dados);

// Mostramos los dados ordenados
print "  <h2>Tirada ordenada</h2>\n";
print "\n";
print "  <p>\n";
for ($i = 0; $i < $numero; $i++) {
    print "    <img src=\"img/$dados[$i].svg\" alt=\"$dados[$i]\" title=\"$dados[$i]\" width=\"140\" height=\"140\" />\n";
}
print "  </p>\n";
?>

  <footer>
    <p class="ultmod">
      Última modificación de esta página:
      <time datetime="2017-10-13">13 de octubre de 2017</time></p>

    <p class="licencia">
      Este programa forma parte del curso <a href="http://www.mclibre.org/consultar/php/">
      Programación web en PHP</a> por <a href="http://www.mclibre.org/">Bartolomé
      Sintes Marco</a>.<br />
      El programa PHP que genera esta página está bajo
      <a rel="license" href="http://www.gnu.org/licenses/agpl.txt">licencia AGPL 3 o posterior</a>.</p>
  </footer>
</body>
</html>
