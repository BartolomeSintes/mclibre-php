<?php
/**
 * Matrices (1) 21 - matrices-1-21.php
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
    Elimina un valor.
    Matrices (1). Sin formularios.
    Ejercicios. PHP. Bartolomé Sintes Marco. www.mclibre.org
  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="mclibre-php-ejercicios.css" title="Color">
</head>

<body>
  <h1>Elimina un valor</h1>

  <p>Actualice la página para mostrar una nueva tirada.</p>

<?php
$numero = rand(1, 10);

// Guardamos los valores de los dados en la matriz $dados
$dados = [];
for ($i = 0; $i < $numero; $i++) {
    $dados[$i] = rand(1, 6);
}

// Mostramos las imágenes de los dados obtenidos
if ($numero == 1) {
    print "  <h2>Tirada de $numero dado</h2>\n";
} else {
    print "  <h2>Tirada de $numero dados</h2>\n";
}
print "\n";
print "  <p>\n";
foreach ($dados as $dado) {
    print "    <img src=\"img/$dado.svg\" alt=\"$dado\" width=\"80\" height=\"80\">\n";
}
print "  </p>\n";
print "\n";

// Guardamos el valor del dado a descartar
$descarta = rand(1, 6);

// Mostramos el dado a descartar
print "  <h2>Dado a eliminar</h2>\n";
print "\n";
print "  <p>\n";
print "    <img src=\"img/$descarta.svg\" alt=\"$descarta\" width=\"80\" height=\"80\">\n";
print "  </p>\n";
print "\n";

// Eliminamos el dado de la matriz
for ($i = 0; $i < $numero; $i++) {
    if ($dados[$i] == $descarta) {
        unset($dados[$i]);
    }
}

// Mostramos las imágenes de los dados restantes
print "  <h2>Dados restantes</h2>\n";
print "\n";
if (count($dados) == 0) {
    print "<p>No quedan dados.</p>\n";
} else {
    print "  <p>\n";
    foreach ($dados as $dado) {
        print "    <img src=\"img/$dado.svg\" alt=\"$dado\" width=\"80\" height=\"80\">\n";
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
