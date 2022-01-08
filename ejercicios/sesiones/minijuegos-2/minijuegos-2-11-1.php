<?php
/**
 * Cartas en orden (1) - minijuegos-2-11-1.php
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
session_name("minijuegos-2-11");
session_start();

if (!isset($_SESSION["nCartas"])) {
    $_SESSION["nCartas"] = 5;
    $_SESSION["cartas"]  = range(1, $_SESSION["nCartas"]);
    shuffle($_SESSION["cartas"]);
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>
    Cartas en orden (1).
    Minijuegos (2). Sesiones.
    Ejercicios. PHP. Bartolomé Sintes Marco. www.mclibre.org
  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="mclibre-php-ejercicios.css" title="Color">
</head>

<body>
  <h1>Cartas en orden (1)</h1>

  <form action="minijuegos-2-11-2.php" method="get">
    <p>Haga clic en las cartas en orden:</p>
<?php
print "        <p>\n";
foreach ($_SESSION["cartas"] as $carta) {
    print "        <button type=\"submit\" name=\"carta\" value=\"$carta\" style=\"border: none; background-color: transparent;\" >\n";
    print "          <img src=\"img/cartas/c$carta.svg\" alt=\"$carta de corazones\" width=\"100\">\n";
    print "        </button>\n";
}
print "        </p\n";
?>
    <p><input type="submit" name="accion" value="Reiniciar"></p>
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
