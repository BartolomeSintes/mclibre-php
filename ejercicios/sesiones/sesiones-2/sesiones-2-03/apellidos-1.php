<?php
/**
 * Sesiones (2) 03 - apellidos-1.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2018 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2018-11-15
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

session_name("sesiones-2-03");
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>
    Apellidos (1).
    Sesiones (2). Sesiones.
    Ejercicios. PHP. Bartolomé Sintes Marco. www.mclibre.org
  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="mclibre-php-ejercicios.css" title="Color">
</head>

<body>
  <h1>Borrar datos (1)</h1>

<?php
if (isset($_SESSION["apellidos"])) {
    print "  <p>Usted ya ha escrito que sus apellidos son: <strong>$_SESSION[apellidos]</strong></p>\n";
    print "\n";
}
?>
  <form action="apellidos-2.php" method="get">
    <p>Escriba sus apellidos:</p>

<?php
if (isset($_SESSION["avisoApellido"])) {
    print "    <p><label>Apellidos: <input type=\"text\" name=\"apellidos\" size=\"30\" maxlength=\"30\"></label> "
        . "<span class=\"aviso\">$_SESSION[avisoApellido]</span></p>\n";
    print "\n";
} else {
    print "    <p><label>Apellidos: <input type=\"text\" name=\"apellidos\" size=\"30\" maxlength=\"30\"></label></p>\n";
    print "\n";
}
?>
    <p>
      <input type="submit" value="Guardar">
      <input type="reset" value="Borrar">
    </p>
  </form>

  <p><a href="index.php">Volver al inicio.</a></p>

  <footer>
    <p class="ultmod">
      Última modificación de esta página:
      <time datetime="2018-11-15">15 de noviembre de 2018</time>
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
