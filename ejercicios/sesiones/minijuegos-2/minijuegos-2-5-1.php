<?php
/**
 * Mueve fichas - minijuegos-2-5-1.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2021 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2021-11-23
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
// Se accede a la sesión

session_name("minijuegos-2-5");
session_start();

if (!isset($_SESSION["dado"])) {
    $_SESSION["dado"] = rand(1, 6);
    $_SESSION["r"]    = 0;
    $_SESSION["g"]    = 0;
    $_SESSION["b"]    = 0;
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>
    Mueve fichas.
    Minijuegos (2). Sesiones.
    Ejercicios. PHP. Bartolomé Sintes Marco. www.mclibre.org
  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="mclibre-php-ejercicios.css" title="Color">
  <style>
      table { border-collapse: collapse; }
      td { border: black 2px solid; width: 60px; height: 60px; }
      button { background-color: transparent; border: none; }

  </style>
</head>

<body>
  <h1>Mueve fichas</h1>

  <p>El objetivo del juego es mover las tres fichas hasta la casilla de la derecha. Elija en cada turno una ficha y se desplazará hacia la meta tantas casillas como marque el dado.</p>

  <form action="minijuegos-2-5-2.php" method="get">

<?php
print "    <p>Movimiento: <img src=\"img/dados/$_SESSION[dado].svg\" alt=\"$_SESSION[dado]\" width=\"60\" height=\"60\"></p>\n";
print "\n";
print "    <table>\n";
print "      <tr>\n";
for ($i = 0; $i < 8; $i++) {
    if ($i == $_SESSION["r"]) {
        print "        <td>\n";
        print "          <button type=\"input\" name=\"ficha\" value=\"r\" />\n";
        print "            <svg version=\"1.1\" xmlns=\"http://www.w3.org/2000/svg\" width=\"50\" viewBox=\"-25 -25 50 50\">\n";
        print "              <circle cx=\"0\" cy=\"0\" r=\"20\" fill=\"red\" stroke=\"black\" />\n";
        print "            </svg>\n";
        print "          </button>\n";
        print "        </td>\n";
    } else {
        print "        <td></td>\n";
    }
}
print "      </tr>\n";
print "      <tr>\n";
for ($i = 0; $i < 8; $i++) {
    if ($i == $_SESSION["g"]) {
        print "        <td>\n";
        print "          <button type=\"input\" name=\"ficha\" value=\"g\" />\n";
        print "            <svg version=\"1.1\" xmlns=\"http://www.w3.org/2000/svg\" width=\"50\" viewBox=\"-25 -25 50 50\">\n";
        print "              <circle cx=\"0\" cy=\"0\" r=\"20\" fill=\"green\" stroke=\"black\" />\n";
        print "            </svg>\n";
        print "          </button>\n";
        print "        </td>\n";
    } else {
        print "        <td></td>\n";
    }
}
print "      </tr>\n";
print "      </tr>\n";
print "      <tr>\n";
for ($i = 0; $i < 8; $i++) {
    if ($i == $_SESSION["b"]) {
        print "        <td>\n";
        print "          <button type=\"input\" name=\"ficha\" value=\"b\" />\n";
        print "            <svg version=\"1.1\" xmlns=\"http://www.w3.org/2000/svg\" width=\"50\" viewBox=\"-25 -25 50 50\">\n";
        print "              <circle cx=\"0\" cy=\"0\" r=\"20\" fill=\"blue\" stroke=\"black\" />\n";
        print "            </svg>\n";
        print "          </button>\n";
        print "        </td>\n";
    } else {
        print "        <td></td>\n";
    }
}
print "      </tr>\n";
print "    </table>\n";
print "\n";
?>
  </form>

  <footer>
    <p class="ultmod">
      Última modificación de esta página:
      <time datetime="2021-11-23">23 de noviembre de 2021</time>
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
