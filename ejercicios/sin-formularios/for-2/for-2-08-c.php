<?php
/**
 * for (2) 08 - for-2-08-c.php
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
    Arco iris semicircular.
    for (2). Sin formularios.
    Ejercicios. PHP. Bartolomé Sintes Marco. www.mclibre.org
  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="mclibre-php-ejercicios.css" title="Color">
</head>

<body>
  <h1>Arco iris semicircular</h1>

  <p>Actualice la página para mostrar un nuevo dibujo.</p>

<?php
$semicirc = rand(3, 10);
$paso     = 360 / $semicirc;

print "  <h2>$semicirc franjas</h2>\n";
print "\n";

print "  <p>\n";
print "    <svg version=\"1.1\" xmlns=\"http://www.w3.org/2000/svg\"\n";
print "         width=\"" . 60 * $semicirc + 20 . "\" height=\"" . 30 * $semicirc + 20 . "\"\n";
print "         viewBox=\"" . -30 * $semicirc - 10 . " " . -30 * $semicirc - 10 . " " . 60 * $semicirc + 20 . " " . 30 * $semicirc + 20 . "\"\n";
print "         style=\"border: black 1px solid; background-color: white;\">\n";
for ($i = 1; $i <= $semicirc; $i++) {
    $valor = -30 * $i + 30 * $semicirc + 30;
    print "      <path d=\"M -$valor,0 L $valor,0 A $valor $valor 0 0 0 -$valor,0 z\" fill=\"hwb(" . round($paso * $i - $paso) . " 10% 10%)\" />\n";
}
print "    </svg>\n";
print "  </p>\n";
print "\n";
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
