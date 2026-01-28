<?php
/**
 * Sesiones (2) 5-1 - sesiones-2-5-1.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2026 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2026-01-28
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
session_name("sesiones-2-5");
session_start();

// Borrramos los datos guardados en intentos anteriores
// salvo el avisoNombre que puede tener que mostrarse en esta página
unset($_SESSION["nombre"]);
unset($_SESSION["apellidos"]);
unset($_SESSION["avisoApellidos"]);
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>
    Formulario en dos pasos (Formulario 1).
    Sesiones (2). Sesiones.
    Ejercicios. PHP. Bartolomé Sintes Marco. www.mclibre.org
  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="mclibre-php-ejercicios.css" title="Color">
</head>

<body>
  <h1>Formulario en dos pasos (Formulario 1)</h1>

  <form action="sesiones-2-5-2.php" method="get">
    <p>Escriba su nombre:</p>

<?php
// Si hay un aviso guardado en la sesión, ...
if (isset($_SESSION["avisoNombre"])) {
    // lo mostramos
    print "    <p>\n";
    print "      <label>Nombre: <input type=\"text\" name=\"nombre\" size=\"20\" maxlength=\"20\"></label>\n";
    print "      <span class=\"aviso\">$_SESSION[avisoNombre]</span></p>\n";
    print "    </p>\n";
    print "\n";
} else {
    // si no, no mostramos el aviso
    print "    <p>\n";
    print "      <label>Nombre: <input type=\"text\" name=\"nombre\" size=\"20\" maxlength=\"20\"></label>\n";
    print "    </p>\n";
    print "\n";
}
?>
    <p>
      <input type="submit" value="Siguiente">
      <input type="reset">
    </p>
  </form>

  <footer>
    <p class="ultmod">
      Última modificación de esta página:
      <time datetime="2026-01-28">28 de enero de 2026</time>
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
