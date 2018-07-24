<?php
/**
 * for (1) 2 - for-1-02.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2017 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2017-10-05
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
  <title>Círculos en columna. for (1). Sin formularios.
    Ejercicios. Programación web en PHP. Bartolomé Sintes Marco</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="mclibre-php-soluciones.css" rel="stylesheet" type="text/css" title="Color" />
</head>

<body>
  <h1>Círculos en columna</h1>

  <p>Actualice la página para mostrar un nuevo dibujo.</p>

<?php
$circulos = rand(1,10);

if ($circulos == 1) {
    print "  <h2>$circulos círculo</h2>\n";
} else {
    print "  <h2>$circulos círculos</h2>\n";
}
print "\n";
print "  <table class=\"conborde\">\n";
print "    <tbody>\n";
for ($i = 0; $i < $circulos; $i++) {
    print "      <tr>\n";
    print "        <td>\n";
    print "          <svg version=\"1.1\" xmlns=\"http://www.w3.org/2000/svg\" width=\"70px\" height=\"70px\">\n";
    print "            <circle cx=\"35\" cy=\"35\" r=\"30\" fill=\"black\" />\n";
    print "          </svg>\n";
    print "        </td>\n";
    print "      </tr>\n";
}
print "    </tbody>\n";
print "  </table>\n";
?>

  <footer>
    <p class="ultmod">
      Última modificación de esta página:
      <time datetime="2017-10-05">5 de octubre de 2017</time></p>

    <p class="licencia">
      Este programa forma parte del curso <a href="http://www.mclibre.org/consultar/php/">
      Programación web en PHP</a> por <a href="http://www.mclibre.org/">Bartolomé
      Sintes Marco</a>.<br />
      El programa PHP que genera esta página está bajo
      <a rel="license" href="http://www.gnu.org/licenses/agpl.txt">licencia AGPL 3 o posterior</a>.</p>
  </footer>
</body>
</html>
