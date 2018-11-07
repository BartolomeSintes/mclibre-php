<?php
/**
 * Sesiones (1) 04 - sesiones-1-04-1.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2018 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2018-11-07
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
session_name("sesiones-1-04");
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <title>
    Formulario Palabras en mayúsculas y minúsculas (Formulario).
    Sesiones (1). Sesiones.
    Ejercicios. PHP. Bartolomé Sintes Marco. www.mclibre.org
  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="mclibre-php-ejercicios.css" title="Color" />
</head>

<body>
  <h1>Formulario Palabras en mayúsculas y minúsculas (Formulario)</h1>

  <form action="sesiones-1-04-2.php" method="get">

<?php
//Si no hemos detectado error en la palabra en mayúsculas y hay guardada una palabra en la sesión ...
if (!isset($_SESSION["mayusculasError"]) && !isset($_SESSION["minusculasError"])
    && isset($_SESSION["mayusculas"]) && isset($_SESSION["minusculas"]) ) {
    // ... mostramos la palabra
    print "    <p>Ha escrito una palabra en mayúsculas: <strong>$_SESSION[mayusculas]</strong>.</p>\n";
    print "\n";
    print "    <p>Ha escrito una palabra en minúsculas: <strong>$_SESSION[minusculas]</strong>.</p>\n";
    print "\n";
}

print "    <p>Escriba una palabra en mayúsculas y otra en minúsculas:</p>\n";
print "\n";

// Si hemos detectado un error en la palabra en mayúsculas
if (isset($_SESSION["mayusculasError"])) {
    // Escribimos un aviso e incluimos el valor incorrecto en el control
    print "    <p><strong>Mayúsculas:</strong> <input type=\"text\" name=\"mayusculas\" value=\"$_SESSION[mayusculas]\" size=\"20\" maxlength=\"20\" /> "
        . "<span class=\"aviso\">$_SESSION[mayusculasError]</span></p>\n";
    print "\n";
} elseif (isset($_SESSION["minusculasError"])) {
    // Si hemos detectado un error en la palabra en minúsculas, incluimos el valor correcto en el control
    print "    <p><strong>Mayúsculas:</strong> <input type=\"text\" name=\"mayusculas\" value=\"$_SESSION[mayusculas]\" size=\"20\" maxlength=\"20\" /></p>\n";
    print "\n";
} else {
    // Si no hemos detectado un error, escribimos el control vacío
    print "    <p><strong>Mayúsculas:</strong> <input type=\"text\" name=\"mayusculas\" size=\"20\" maxlength=\"20\" /></p>\n";
    print "\n";
}

// Si hemos detectado un error en la palabra en minúsculas
if (isset($_SESSION["minusculasError"])) {
    // Escribimos un aviso e incluimos el valor incorrecto en el control
    print "    <p><strong>Minúsculas:</strong> <input type=\"text\" name=\"minusculas\" value=\"$_SESSION[minusculas]\" size=\"20\" maxlength=\"20\" /> "
    . "<span class=\"aviso\">$_SESSION[minusculasError]</span></p>\n";
    print "\n";
} elseif (isset($_SESSION["mayusculasError"])) {
    // Si hemos detectado un error en la palabra en mayúsculas, incluimos el valor correcto en el control
    print "    <p><strong>Minúsculas:</strong> <input type=\"text\" name=\"minusculas\" value=\"$_SESSION[minusculas]\" size=\"20\" maxlength=\"20\" /></p>\n";
    print "\n";
} else {
    // Si no hemos detectado un error, escribimos el control vacío
    print "    <p><strong>Minúsculas:</strong> <input type=\"text\" name=\"minusculas\" size=\"20\" maxlength=\"20\" /></p>\n";
    print "\n";
}

?>

    <p>
      <input type="submit" value="Comprobar" />
      <input type="reset" value="Borrar" />
    </p>
  </form>

  <footer>
    <p class="ultmod">
      Última modificación de esta página:
      <time datetime="2018-11-07">7 de noviembre de 2018</time>
    </p>

    <p class="licencia">
      Esta página forma parte del curso <a href="http://www.mclibre.org/consultar/php/">
      <cite>Programación web en PHP</cite></a> por <cite>Bartolomé Sintes Marco</cite>.<br />
      y se distribuye bajo una <a rel="license" href="https://creativecommons.org/licenses/by-sa/4.0/deed.es_ES">
      Licencia Creative Commons Reconocimiento-CompartirIgual 4.0 Internacional (CC BY-SA 4.0)</a>.</p>
  </footer>
</body>
</html>
