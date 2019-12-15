<?php
/**
 * Sesiones (2) 04 - borrar-1.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2018 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2018-10-31
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

session_name("sesiones-2-04");
session_start();

?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>
    Borrar datos (1).
    Sesiones (2). Sesiones.
    Ejercicios. PHP. Bartolomé Sintes Marco. www.mclibre.org
  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="mclibre-php-ejercicios.css" title="Color">
</head>

<body>
  <h1>Borrar datos (1)</h1>

<?php
if (!count($_SESSION)) {
    print "  <p>Todavía no se ha introducido ningún dato.</p>\n";
} else {
  print "  <form action=\"borrar-2.php\" method=\"get\">\n";
  print "    <p>Marque los datos a borrar:</p>\n";
  print "\n";
  print "    <table>\n";
  print "      <tbody>\n";
    foreach ($_SESSION as $indice => $valor) {
        print "        <tr>\n";
        print "          <td><input type=\"checkbox\" name=\"c[$indice]\" value=\"$valor\"></td>\n";
        print "          <td>$indice: $valor</td>\n";
        print "        </tr>\n";
    }
    print "      </tbody>\n";
    print "    </table>\n";
    print "\n";
    print "    <p>\n";
    print "      <input type=\"submit\" value=\"Borrar\">\n";
    print "      <input type=\"reset\" value=\"Desmarcar casillas\">\n";
    print "    </p>\n";
    print "  </form>\n";
}
?>

  <p><a href="index.php">Volver al inicio.</a></p>

  <footer>
    <p class="ultmod">
      Última modificación de esta página:
      <time datetime="2018-10-31">31 de octubre de 2018</time>
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
