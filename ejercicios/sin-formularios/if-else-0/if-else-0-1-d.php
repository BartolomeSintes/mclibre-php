<?php
/**
 * if ... else ... (0) 1 D - if-else-0-1-d.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2025 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2025-02-08
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
    Aviso final único. Par e impar.
    if .. elseif ... else ... (0). Sin formularios.
    Ejercicios. PHP. Bartolomé Sintes Marco. www.mclibre.org
  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="mclibre-php-ejercicios.css" title="Color">
</head>

<body>
  <h1>Par e impar (1)</h1>

  <p>Actualice la página para mostrar una nueva tirada.</p>

<?php
$dado1 = rand(1, 6);
$dado2 = rand(1, 6);

print "  <p>\n";
print "    Queremos sacar un valor par:\n";
print "    <img src=\"img/$dado1.svg\" alt=\"$dado1\" width=\"100\" height=\"100\" class=\"v-medio\">\n";
print "  </p>\n";
print "\n";

print "  <p>\n";
print "    Queremos sacar un valor impar:\n";
print "    <img src=\"img/$dado2.svg\" alt=\"$dado2\" width=\"140\" height=\"100\" class=\"v-medio\">\n";
print "  </p>\n";
print "\n";

if ($dado1 % 2 == 0 && $dado2 % 2 == 0) {       // Si el primer dado es par y el segundo dado es par
    print "  <p>!No lo hemos conseguido!</p>\n";
    print "\n";
}

if ($dado1 % 2 == 0 && $dado2 % 2 == 1) {       // Si el primer dado es par y el segundo dado es impar
    print "  <p>¡Lo hemos conseguido!</p>\n";
    print "\n";
}

if ($dado1 % 2 == 1 && $dado2 % 2 == 0) {       // Si el primer dado es impar y el segundo dado es par
    print "  <p>!No lo hemos conseguido!</p>\n";
    print "\n";
}

if ($dado1 % 2 == 1 && $dado2 % 2 == 1) {       // Si el primer dado es impar y el segundo dado es impar
    print "  <p>!No lo hemos conseguido!</p>\n";
    print "\n";
}
?>
  <footer>
    <p class="ultmod">
      Última modificación de esta página:
      <time datetime="2025-02-08">8 de febrero de 2025</time>
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
