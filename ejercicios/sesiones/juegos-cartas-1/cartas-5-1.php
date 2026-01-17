<?php
/**
 * Distribuye cartas (1) - cartas-5-1.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2025 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2025-02-08
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
session_name("cartas-1");
session_start();

if (!isset($_SESSION["baraja"])) {
    $_SESSION["baraja"] = [];
    foreach (["p", "c", "d", "t"] as $palo) {
        for ($i = 1; $i <= 13; $i++) {
            $_SESSION["baraja"][] = "$palo$i";
        }
    }
    shuffle($_SESSION["baraja"]);
    $_SESSION["picas"]     = [];
    $_SESSION["corazones"] = [];
    $_SESSION["diamantes"] = [];
    $_SESSION["treboles"]  = [];
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>
    Distribuye cartas.
    Juegos de cartas (1). Sesiones.
    Ejercicios. PHP. Bartolomé Sintes Marco. www.mclibre.org
  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="mclibre-php-ejercicios.css" title="Color">
</head>

<body>
  <h1>Distribuye cartas</h1>

  <form action="cartas-5-2.php" method="get">
    <p>Haga clic en los botones para añadir la carta a uno de los montones:</p>
<?php
print "    <table>\n";
print "      <tr>\n";
print "        <td rowspan=\"4\">\n";
if (count($_SESSION["baraja"]) > 0) {
    $carta = $_SESSION["baraja"][count($_SESSION["baraja"]) - 1];
    print "          <img src=\"img/cartas/$carta.svg\" alt=\"$carta\" width=\"150\">\n";
} else {
    print "          <span style=\"font-size: 6rem\">&#x1f600;</span>\n";
}
print "        </td>\n";
print "        <td><button type=\"submit\" name=\"accion\" value=\"picas\" style=\"width: 5rem\"><span style=\"font-size: 3rem\">&#x2660;&#xfe0f;</span></button></td>\n";
print "        <td>\n";
foreach ($_SESSION["picas"] as $carta) {
    print "          <img src=\"img/cartas/$carta.svg\" alt=\"$carta\" width=\"75\">\n";
}
print "        </td>\n";
print "      </tr>\n";
print "      <tr>\n";
print "        <td><button type=\"submit\" name=\"accion\" value=\"corazones\" style=\"width: 5rem\"><span style=\"font-size: 3rem\">&#x2665;&#xfe0f;</span></button></td>\n";
print "        <td>\n";
foreach ($_SESSION["corazones"] as $carta) {
    print "          <img src=\"img/cartas/$carta.svg\" alt=\"$carta\" width=\"75\">\n";
}
print "        </td>\n";
print "      </tr>\n";
print "      <tr>\n";
print "        <td><button type=\"submit\" name=\"accion\" value=\"diamantes\" style=\"width: 5rem\"><span style=\"font-size: 3rem\">&#x2666;&#xfe0f;</span></button></td>\n";
print "        <td>\n";
foreach ($_SESSION["diamantes"] as $carta) {
    print "          <img src=\"img/cartas/$carta.svg\" alt=\"$carta\" width=\"75\">\n";
}
print "        </td>\n";
print "      </tr>\n";
print "      <tr>\n";
print "        <td><button type=\"submit\" name=\"accion\" value=\"treboles\" style=\"width: 5rem\"><span style=\"font-size: 3rem\">&#x2663;&#xfe0f;</span></button></td>\n";
print "        <td>\n";
foreach ($_SESSION["treboles"] as $carta) {
    print "          <img src=\"img/cartas/$carta.svg\" alt=\"$carta\" width=\"75\">\n";
}
print "        </td>\n";
print "      </tr>\n";
print "    </table>\n";
print "\n";
?>
    <p><input type="submit" name="accion" value="reiniciar"></p>
  </form>

  <footer>
    <p class="ultmod">
      Última modificación de esta página:
      <time datetime="2025-02-08">8 de febrero de 2025</time>
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
