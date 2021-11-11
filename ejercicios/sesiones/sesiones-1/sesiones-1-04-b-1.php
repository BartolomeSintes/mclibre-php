<?php
/**
 * Sesiones (1) 04 - sesiones-1-04-b-1.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2021 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2021-11-11
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
// Accedemos a la sesión
session_name("sesiones-1-04-b");
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>
    Formulario Palabras en mayúsculas y minúsculas (Formulario).
    Sesiones (1). Sesiones.
    Ejercicios. PHP. Bartolomé Sintes Marco. www.mclibre.org
  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="mclibre-php-ejercicios.css" title="Color">
</head>

<body>
  <h1>Formulario Palabras en mayúsculas y minúsculas (Formulario)</h1>

  <form action="sesiones-1-04-b-2.php" method="get">

<?php
//Si están guardadas en la sesión las dos palabras ...
if (isset($_SESSION["mayusculas"]) && isset($_SESSION["minusculas"]) ) {
    // ... mostramos las dos palabras
    print "    <p>Ha escrito una palabra en mayúsculas: <strong>$_SESSION[mayusculas]</strong>.</p>\n";
    print "\n";
    print "    <p>Ha escrito una palabra en minúsculas: <strong>$_SESSION[minusculas]</strong>.</p>\n";
    print "\n";
}

print "    <p>Escriba una palabra en mayúsculas y otra en minúsculas:</p>\n";
print "\n";

print "    <p><label>Mayúsculas: <input type=\"text\" name=\"mayusculas\" ";

if (isset($_SESSION["mayusculasIntento"])) {
    // Si hemos detectado un intento incorrecto en la palabra en mayúsculas, incluimos el intento en el control
    print "value=\"$_SESSION[mayusculasIntento]\" ";
} elseif (isset($_SESSION["minusculasError"]) && isset($_SESSION["mayusculas"])) {
    // Si la palabra en mayúsculas es correcta, pero hemos detectado un error en la palabra en minúsculas, incluimos la palabra correcta en el control
    print "value=\"$_SESSION[mayusculas]\" ";
}

print "size=\"20\" maxlength=\"20\"></label> ";

// Si hemos detectado un error en la palabra en mayúsculas
if (isset($_SESSION["mayusculasError"])) {
    // Escribimos el aviso
    print "<span class=\"aviso\">$_SESSION[mayusculasError]</span>";
}

print "</p>\n";
print "\n";

print "    <p><label>Minúsculas: <input type=\"text\" name=\"minusculas\" ";

if (isset($_SESSION["minusculasIntento"])) {
    // Si hemos detectado un intento incorrecto en la palabra en minúsculas, incluimos el intento en el control
    print "value=\"$_SESSION[minusculasIntento]\" ";
} elseif (isset($_SESSION["mayusculasError"]) && isset($_SESSION["minusculas"])) {
    // Si la palabra en minúsculas es correcta, pero hemos detectado un error en la palabra en mayúsculas, incluimos la palabra correcta en el control
    print "value=\"$_SESSION[minusculas]\" ";
}

print "size=\"20\" maxlength=\"20\"></label> ";

// Si hemos detectado un error en la palabra en minúsculas
if (isset($_SESSION["minusculasError"])) {
    // Escribimos el aviso
    print "<span class=\"aviso\">$_SESSION[minusculasError]</span>";
}

print "</p>\n";
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
      <time datetime="2018-11-17">17 de noviembre de 2018</time>
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
