<?php
/**
 * Dividir 1-1 - dividir-1-1.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2015 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2015-10-27
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
  <title>Dividir 1 (Formulario). Minijuegos (1).
    Ejercicios. Programación web en PHP. Bartolomé Sintes Marco</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="mclibre-php-soluciones.css" rel="stylesheet" type="text/css" title="Color" />
  <style type="text/css">input { text-align: right; }</style>
</head>

<body>
<h1>Dividir 1 (Formulario)</h1>

<form action="dividir-1-2.php" method="get">
  <p>Escriba el resultado de la siguiente división:</p>

<?php
$a = rand(10, 99);
$b = rand(1, 9);

print "<table class=\"grande derecha\">\n";
print "  <tbody>\n";
print "    <tr>\n";
print "      <td>$a</td>\n";
print "      <td style=\"border-left: black 2px solid; border-bottom: black 2px solid;\">$b</td>\n";
print "    </tr>\n";
print "    <tr>\n";
print "      <td><input type=\"text\" name=\"resto\" size=\"3\" /></td>\n";
print "      <td><input type=\"text\" name=\"cociente\" size=\"3\" /></td>\n";
print "    </tr>\n";
print "  </tbody>\n";
print "</table>\n";

print "  <p><input type=\"hidden\" name=\"a\" value=\"$a\" />\n";
print "    <input type=\"hidden\" name=\"b\" value=\"$b\" /></p>\n";
?>

  <p><input type="submit" value="Corregir" />
    <input type="reset" value="Borrar" /></p>
</form>

<footer>
  <p class="ultmod">
    Última modificación de esta página:
    <time datetime="2015-10-27">27 de octubre de 2015</time></p>

      <p class="licencia">
        Este programa forma parte del curso <a href="http://www.mclibre.org/consultar/php/">
        Programación web en PHP</a> por <a href="http://www.mclibre.org/">Bartolomé
        Sintes Marco</a>.<br />
        El programa PHP que genera esta página está bajo
        <a rel="license" href="http://www.gnu.org/licenses/agpl.txt">licencia AGPL 3 o posterior</a>.</p>
</footer>
</body>
</html>
