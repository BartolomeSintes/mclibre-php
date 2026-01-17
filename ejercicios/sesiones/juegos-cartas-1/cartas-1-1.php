<?php
/**
 * Muestra y oculta cartas (1) - cartas-1-1.php
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

// AVISO:
// Este programa crea dos matrices y va pasando las cartas de una a otra matriz.
// Se podría hacer lo mismo con una sola matriz y guardando un número (el número
// de crtas que se enseñan).

// Se accede a la sesión
session_name("cartas-5");
session_start();

if (!isset($_SESSION["baraja"]) || !isset($_SESSION["cartas"])) {
    $_SESSION["baraja"] = [];
    foreach (["c", "d", "p", "t"] as $palo) {
        for ($i = 1; $i <= 13; $i++) {
            $_SESSION["baraja"][] = "$palo$i";
        }
    }
    shuffle($_SESSION["baraja"]);
    $_SESSION["cartas"] = [];
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>
    Muestra cartas.
    Juegos de cartas (1). Sesiones.
    Ejercicios. PHP. Bartolomé Sintes Marco. www.mclibre.org
  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="mclibre-php-ejercicios.css" title="Color">
</head>

<body>
  <h1>Muestra y oculta cartas</h1>

  <form action="cartas-1-2.php" method="get">
    <p>Haga clic en los botones para mostrar una carta menos, reiniciar o mostrar una carta más:</p>

    <p>
      <button type="submit" name="accion" value="menos"><span style="font-size: 4rem">&#x2796;</span></button>
      <button type="submit" name="accion" value="reiniciar"><span style="font-size: 4rem">&#x274c;</span></button>
      <button type="submit" name="accion" value="mas"><span style="font-size: 4rem">&#x2795;</span></button>
    </p>

<?php
print "        <p>\n";
print "          <img src=\"img/cartas/dorso-rojo.svg\" alt=\"dorso\" width=\"100\">\n";
foreach ($_SESSION["cartas"] as $carta) {
    print "          <img src=\"img/cartas/$carta.svg\" alt=\"$carta\" width=\"100\">\n";
}
print "        </p>\n";
?>
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
