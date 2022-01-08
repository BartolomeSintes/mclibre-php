<?php
/**
 * Siete y medio (1) - cartas-3-1.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2021 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2021-12-02
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
session_name("cartas-3");
session_start();

if (!isset($_SESSION["baraja"])) {
    $_SESSION["baraja"] = [];
    foreach (["p", "c", "d", "t"] as $palo) {
        for ($i = 1; $i <= 7; $i++) {
            $_SESSION["baraja"][] = "$palo$i";
        }
        for ($i = 11; $i <= 13; $i++) {
            $_SESSION["baraja"][] = "$palo$i";
        }
    }
    shuffle($_SESSION["baraja"]);
    $_SESSION["jugador"] = [];
    $_SESSION["total"] = 0;
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>
    Siete y medio.
    Juegos de cartas (1). Sesiones.
    Ejercicios. PHP. Bartolomé Sintes Marco. www.mclibre.org
  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="mclibre-php-ejercicios.css" title="Color">
</head>

<body>
  <h1>Siete y medio (1)</h1>

  <form action="cartas-3-2.php" method="get">
    <p>Haga clic en el dorso de la carta para pedir otra carta:</p>

<?php
print "    <p>\n";
print "      <button type=\"submit\" name=\"accion\" value=\"otra\">\n";
print "        <img src=\"img/cartas/dorso-rojo.svg\" alt=\"dorso\" width=\"100\">\n";
print "      </button>\n";
foreach ($_SESSION["jugador"] as $carta) {
    print "      <img src=\"img/cartas/$carta.svg\" alt=\"$carta\" width=\"100\">\n";
}
if ($_SESSION["total"] > 7.5) {
    print "      <span style=\"font-size: 7rem; vertical-align: text-bottom;\">&#x1f622;&#xfe0f;</span>\n";
} elseif ($_SESSION["total"] == 7.5) {
    print "      <span style=\"font-size: 7rem; vertical-align: text-bottom;\">&#x1f60e;&#xfe0f;</span>\n";
}
print "    </p>\n";
?>

    <p><input type="submit" name="accion" value="reiniciar"></p>
  </form>

  <footer>
    <p class="ultmod">
      Última modificación de esta página:
      <time datetime="2021-12-02">2 de diciembre de 2021</time>
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
