<?php
/**
 * Sesiones (2) 02 - sesiones-2-02-3.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2025 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2025-01-31
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
session_name("sesiones-2-02");
session_start();

// Si accedemos a esta página sin haber guardado antes la palabra1 en la sesión ...
if (!isset($_SESSION["palabra1"])) {
    // volvemos a la página 1
    header("Location:sesiones-2-02-1.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>
    Formulario de confirmación (Formulario 2).
    Sesiones (2). Sesiones.
    Ejercicios. PHP. Bartolomé Sintes Marco. www.mclibre.org
  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="mclibre-php-ejercicios.css" title="Color">
</head>

<body>
  <h1>Formulario de confirmación (Formulario 2)</h1>

  <form action="sesiones-2-02-4.php" method="get">
    <p>Repita la palabra que acaba de escribir:</p>

<?php
// Si hay un aviso guardado en la sesión, ...
if (isset($_SESSION["aviso2"])) {
    // lo mostramos
    print "    <p>\n";
    print "      <label>Escriba de nuevo: <input type=\"text\" name=\"palabra2\" size=\"30\" maxlength=\"30\"></label>\n";
    print "      <span class=\"aviso\">$_SESSION[aviso2]</span>\n";
    print "    </p>\n";
    print "\n";
} else {
    // si no, no mostramos el aviso
    print "    <p>\n";
    print "      <label>Escriba de nuevo: <input type=\"text\" name=\"palabra2\" size=\"30\" maxlength=\"30\"></label>\n";
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
      <time datetime="2025-01-31">31 de enero de 2025</time>
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
