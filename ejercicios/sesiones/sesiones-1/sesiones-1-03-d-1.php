<?php
/**
 * Sesiones (1) 03 - sesiones-1-03-d-1.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2018 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2018-11-13
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
// Accedemos a la sesión
session_name("sesiones-1-03-d");
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>
    Formulario Palabra en mayúsculas (Formulario).
    Sesiones (1). Sesiones.
    Ejercicios. PHP. Bartolomé Sintes Marco. www.mclibre.org
  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="mclibre-php-ejercicios.css" title="Color">
</head>

<body>
  <h1>Formulario Palabra en mayúsculas (Formulario)</h1>

  <form action="sesiones-1-03-d-2.php" method="get">

<?php
//Si hay guardada una palabra en la sesión ...
if (isset($_SESSION["palabra"])) {
    // ... mostramos la palabra
    print "    <p>Ha escrito una palabra en mayúsculas: <strong>$_SESSION[palabra]</strong>.</p>\n";
    print "\n";
}

print "    <p>Escriba una palabra en mayúsculas:</p>\n";
print "\n";

print "    <p><strong>Palabra:</strong> <input type=\"text\" name=\"palabra\" ";

// Si hay que incluir el intento anterior en value, lo incluimos
if (isset($_SESSION["intento"])) {
    print "value=\"$_SESSION[intento]\" ";
}

print "size=\"20\" maxlength=\"20\"> ";

// Si hay que incluir un aviso, lo incluimos
if (isset($_SESSION["error"])) {
    print "<span class=\"aviso\">$_SESSION[error]</span></p>\n";
}

print "\n";
?>

    <p>
      <input type="submit" value="Comprobar">
      <input type="reset" value="Borrar">
    </p>
  </form>

  <footer>
    <p class="ultmod">
      Última modificación de esta página:
      <time datetime="2018-11-13">13 de noviembre de 2018</time>
    </p>

    <p class="licencia">
      Esta página forma parte del curso <a href="http://www.mclibre.org/consultar/php/">
      <cite>Programación web en PHP</cite></a> por <cite>Bartolomé Sintes Marco</cite>.<br>
      y se distribuye bajo una <a rel="license" href="https://creativecommons.org/licenses/by-sa/4.0/deed.es_ES">
      Licencia Creative Commons Reconocimiento-CompartirIgual 4.0 Internacional (CC BY-SA 4.0)</a>.</p>
  </footer>
</body>
</html>
