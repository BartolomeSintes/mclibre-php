<?php
/**
 * Cara o cruz - sesiones-2-13-1.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2021 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2021-11-25
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

session_name("sesiones-2-13");
session_start();

if (!isset($_SESSION["g"]) || !isset($_SESSION["m"]) || !isset($_SESSION["moneda"])) {
    $_SESSION["moneda"] = 0;
    $_SESSION["g"] = 0;
    $_SESSION["m"] = 0;
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>
    Cara o cruz.
    Sesiones (2). Sesiones.
    Ejercicios. PHP. Bartolomé Sintes Marco. www.mclibre.org
  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="mclibre-php-ejercicios.css" title="Color">
</head>

<body>
  <h1>Cara o cruz</h1>

  <p>Haga clic en uno de los botones:</p>

  <form action="sesiones-2-13-2.php">
    <p>
      <input type="submit" name="siguiente" value="Lanzar moneda">
      <input type="submit" name="siguiente" value="Volver a empezar">
    </p>
  </form>

  <table style="text-align: center;">
    <tr>
      <th>Jugador A</th>
      <th>Resultado</th>
      <th>Jugador B</th>
    </tr>
<?php
print "    <tr style=\"font-size: 400%\">\n";
print "      <td>$_SESSION[g]</td>\n";
print "      <td></td>\n";
print "      <td>$_SESSION[m]</td>\n";
print "    </tr>\n";

print "    <tr style=\"font-size: 400%\">\n";
if ($_SESSION["g"] > $_SESSION["m"]) {
    print "      <td>&#128568;</td>\n";
} elseif ($_SESSION["g"] < $_SESSION["m"]) {
    print "      <td>&#128576;</td>\n";
} else {
    print "      <td>&#128572;</td>\n";
}

if ($_SESSION["moneda"] == 0) {
    print "      <td></td>\n";
} elseif ($_SESSION["moneda"] == 1) {
    print "      <td><img src=\"img/a.svg\" alt=\"A\" width=\"100\" height=\"100\"></td>\n";
} else
    print "      <td><img src=\"img/b.svg\" alt=\"B\" width=\"100\" height=\"100\"></td>\n";

if ($_SESSION["g"] > $_SESSION["m"]) {
    print "      <td>&#128584;</td>\n";
} elseif ($_SESSION["g"] < $_SESSION["m"]) {
    print "      <td>&#128053;</td>\n";
} else {
    print "      <td>&#128586;</td>\n";
}
print "    </tr>\n";
?>
  </table>

  <footer>
    <p class="ultmod">
      Última modificación de esta página:
      <time datetime="2021-11-25">25 de noviembre de 2021</time>
    </p>

    <p class="licencia">
      Este programa forma parte del curso <strong><a href="http://www.mclibre.org/consultar/php/">Programación
      web en PHP</a></strong> de <a href="http://www.mclibre.org/" rel="author" >Bartolomé Sintes Marco</a>.<br>
      El programa PHP que genera esta página se distribuye bajo
      <a rel="license" href="http://www.gnu.org/licenses/agpl.txt">licencia AGPL 3 o posterior</a>.
    </p>
  </footer>
</body>
</html>
