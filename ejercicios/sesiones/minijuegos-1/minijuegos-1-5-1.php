<?php
/**
 * Sesiones Minijuegos (1) 3 - minijuegos-1-5-1.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2022 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2022-11-17
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

session_name("minijuegos-1-5");
session_start();

if (!isset($_SESSION["carta1"])) {
    header("location:minijuegos-1-5-2.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>
    Jugada de tres cartas.
    Minijuegos (1). Sesiones.
    Ejercicios. PHP. Bartolomé Sintes Marco. www.mclibre.org
  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="mclibre-php-ejercicios.css" title="Color">
</head>

<body>
  <h1>Jugada de tres cartas</h1>

  <form action="minijuegos-1-5-2.php">
<?php
print "    <p>\n";
print "      <svg version=\"1.1\" xmlns=\"http://www.w3.org/2000/svg\" \n";
print "           width=\"260\" height=\"190\" viewBox=\"-50 -10 260 190\">\n";
print "        <image href=\"img/cartas/c$_SESSION[carta1].svg\" x=\"0\" y=\"0\" height=\"150\" transform=\"rotate(-15, 0, 150)\"/>\n";
print "        <image href=\"img/cartas/c$_SESSION[carta2].svg\" x=\"0\" y=\"0\" height=\"150\" transform=\"rotate(0, 0, 150)\"/>\n";
print "        <image href=\"img/cartas/c$_SESSION[carta3].svg\" x=\"0\" y=\"0\" height=\"150\" transform=\"rotate(15, 0, 150)\"/>\n";
print "      </svg>\n";
print "    </p>\n";
print "\n";
print "    <p>Ha obtenido $_SESSION[mano] $_SESSION[valor].</p>\n";
print "\n";
?>
    <p><button type="submit" name="accion" value="nuevas">Nuevas cartas</button></p>
  </form>

  <footer>
    <p class="ultmod">
      Última modificación de esta página:
      <time datetime="2022-11-17">17 de noviembre de 2022</time>
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
