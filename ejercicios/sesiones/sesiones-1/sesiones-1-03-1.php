<?php
/**
 * Sesiones (1) 03 - sesiones-1-03-1.php
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
session_name("sesiones-1-03");
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

  <form action="sesiones-1-03-2.php" method="get">

<?php
//Si no hemos detectado un error y hay guardada una palabra en la sesión ...
if (!isset($_SESSION["error"]) && isset($_SESSION["palabra"])) {
    // ... mostramos la palabra
    print "    <p>Ha escrito una palabra en mayúsculas: <strong>$_SESSION[palabra]</strong>.</p>\n";
    print "\n";
}

// Si hemos detectado un error
if (isset($_SESSION["error"])) {
    // Mostramos el control, añadiendo el aviso e incluyendo el valor incorrecto en el control
    print "    <p><label>Escriba una palabra en mayúsculas: <input type=\"text\" name=\"palabra\" value=\"$_SESSION[palabra]\" size=\"20\" maxlength=\"20\"></label> "
        . "<span class=\"aviso\">$_SESSION[error]</span></p>\n";
    print "\n";
} else {
    // Si no hemos detectado un error, mostramos el control
    print "    <p><label>Escriba una palabra en mayúsculas: <input type=\"text\" name=\"palabra\" size=\"20\" maxlength=\"20\"></label></p>\n";
    print "\n";
}
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
      Este programa forma parte del curso <strong><a href="https://www.mclibre.org/consultar/php/">Programación
      web en PHP</a></strong> de <a href="https://www.mclibre.org/" rel="author">Bartolomé Sintes Marco</a>.<br>
      El programa PHP que genera esta página se distribuye bajo
      <a rel="license" href="http://www.gnu.org/licenses/agpl.txt">licencia AGPL 3 o posterior</a>.
    </p>
  </footer>
</body>
</html>
