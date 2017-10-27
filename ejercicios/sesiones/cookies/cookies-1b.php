<?php
/**
 * Cookies 1 - cookies_1b.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2011 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2011-05-19
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

$color = isset($_COOKIE['cookieColor'])?$_COOKIE['cookieColor']:"";

print "<?xml version=\"1.0\" encoding=\"utf-8\"?>
<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN\"
       \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd\">
<html xmlns=\"http://www.w3.org/1999/xhtml\">
<head>
  <meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />
  <title>Selección de colores (comprobación). Cookies.
  Ejercicios. PHP. Bartolomé Sintes Marco</title>
  <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\" />
  <link href=\"mclibre_php_soluciones.css\" rel=\"stylesheet\" type=\"text/css\"
    title=\"Color\" />\n";
if ($color=='rojo') {
  print "  <style type=\"text/css\">body, a { color: red; }</style>\n";
} elseif ($color=='azul') {
  print "  <style type=\"text/css\">body, a { color: blue; }</style>\n";
} elseif ($color=='verde') {
  print "  <style type=\"text/css\">body, a { color: green; }</style>\n";
}

print "</head>

<body>
<h1>Selección de colores (comprobación)</h1>\n";
if ($color=="") {
    print "<p>No se ha elegido ningún color.</p>\n";
} else {
    print "<p>Se ha elegido el color $color.</p>\n";
}

print "<p><a href=\"cookies_1a.php\">Volver a la selección de color</a></p>";

print '<address>
  Esta página forma parte del curso "Páginas web con PHP" disponible en <a
  href="http://www.mclibre.org/">http://www.mclibre.org</a><br />
  Autor: Bartolomé Sintes Marco<br />
  Última modificación de esta página: 9 de mayo de 2010
</address>

<p class="licencia">El programa PHP que genera esta página está bajo
<a rel="license" href="http://www.gnu.org/licenses/agpl.txt">licencia AGPL 3 o
posterior</a>.</p>
</body>
</html>';
/*
 * 2008-01-22
 * Este print está con comillas para poder buscar y sustituir el contenido
 * junto con el resto de ficheros.
 * También podría ponerlo fuera del bloque PHP, pero entonces Eclipse dice
 * que hay un error en la página.
 */

?>
