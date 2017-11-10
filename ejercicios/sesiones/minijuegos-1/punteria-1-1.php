<?php
/**
 * Puntería 1-1 - punteria-1-1.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2015 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2015-11-05
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
  <title>Puntería 1 (Formulario). Minijuegos (1).
    Ejercicios. Programación web en PHP. Bartolomé Sintes Marco</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="mclibre-php-soluciones.css" rel="stylesheet" type="text/css" title="Color" />
</head>

<body>
<h1>Puntería 1 (Formulario)</h1>

<form action="punteria-1-2.php" method="get">
  <p>Haga clic en el punto negro:</p>

<?php
$ancho = 200;
$r     = rand(10, 20);
$x     = rand($r, 200 - $r);
$y     = rand($r, 200 - $r);


print "  <p><input type=\"image\" name=\"dibujo\" src=\"punteria-1-dibujo.php?ancho=$ancho&amp;x=$x&amp;y=$y&amp;r=$r\" alt=\"punteria\" /></p>\n\n";

print "  <p><input type=\"hidden\" name=\"x\" value=\"$x\" />\n";
print "    <input type=\"hidden\" name=\"y\" value=\"$y\" />\n";
print "    <input type=\"hidden\" name=\"r\" value=\"$r\" /></p>\n";
?>

</form>

<footer>
  <p class="ultmod">
    Última modificación de esta página:
    <time datetime="2015-10-29">29 de octubre de 2015</time></p>

      <p class="licencia">
        Este programa forma parte del curso <a href="http://www.mclibre.org/consultar/php/">
        Programación web en PHP</a> por <a href="http://www.mclibre.org/">Bartolomé
        Sintes Marco</a>.<br />
        El programa PHP que genera esta página está bajo
        <a rel="license" href="http://www.gnu.org/licenses/agpl.txt">licencia AGPL 3 o posterior</a>.</p>
</footer>
</body>
</html>
