<?php
/**
 * if ... else ... (1) 5 - if-else-1-5.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2018 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2018-11-05
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
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>
    Tres dados más altos. Juego.
    if .. elseif ... else ... (1). Sin formularios.
    Ejercicios. PHP. Bartolomé Sintes Marco. www.mclibre.org
  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="mclibre-php-ejercicios.css" title="Color">
</head>

<body>
  <h1>Juego: Tres dados más altos</h1>

  <p>Actualice la página para mostrar una nueva tirada.</p>

  <table>
    <tr>
      <th>Jugador 1</th>
      <th>Jugador 2</th>
      <th>Resultado</th>
    </tr>
    <tr>
<?php
$dado1a = rand(1, 6);
$dado1b = rand(1, 6);
$dado1c = rand(1, 6);
$dado2a = rand(1, 6);
$dado2b = rand(1, 6);
$dado2c = rand(1, 6);

print "      <td style=\"padding: 10px; background-color: red;\">\n";
print "        <img src=\"img/$dado1a.svg\" alt=\"$dado1a\" width=\"140\" height=\"140\">\n";
print "        <img src=\"img/$dado1b.svg\" alt=\"$dado1b\" width=\"140\" height=\"140\">\n";
print "        <img src=\"img/$dado1c.svg\" alt=\"$dado1c\" width=\"140\" height=\"140\">\n";
print "      </td>\n";
print "      <td style=\"padding: 10px; background-color: blue;\">\n";
print "        <img src=\"img/$dado2a.svg\" alt=\"$dado2a\" width=\"140\" height=\"140\">\n";
print "        <img src=\"img/$dado2b.svg\" alt=\"$dado2b\" width=\"140\" height=\"140\">\n";
print "        <img src=\"img/$dado2c.svg\" alt=\"$dado2c\" width=\"140\" height=\"140\">\n";
print "      </td>\n";

if ($dado1a == $dado1b && $dado1a == $dado1c) {
    $trio1 = $dado1a;
} else {
    $trio1 = 0;
}

if ($dado2a == $dado2b && $dado2a == $dado2c) {
    $trio2 = $dado2a;
} else {
    $trio2 = 0;
}

if ($dado1a == $dado1b || $dado1a == $dado1c) {
    $pareja1 = $dado1a;
} elseif ($dado1b == $dado1c) {
    $pareja1 = $dado1b;
} else {
    $pareja1 = 0;
}

if ($dado2a == $dado2b || $dado2a == $dado2c) {
    $pareja2 = $dado2a;
} elseif ($dado2b == $dado2c) {
    $pareja2 = $dado2b;
} else {
    $pareja2 = 0;
}

$total1 = $dado1a + $dado1b + $dado1c;

$total2 = $dado2a + $dado2b + $dado2c;

if ($trio1 > $trio2) {
    print "      <td>Ha ganado el jugador 1</td>\n";
} elseif ($trio1 < $trio2) {
    print "      <td>Ha ganado el jugador 2</td>\n";
} else {
    if ($pareja1 > $pareja2) {
        print "      <td>Ha ganado el jugador 1</td>\n";
    } elseif ($pareja1 < $pareja2) {
        print "      <td>Ha ganado el jugador 2</td>\n";
    } else {
        if ($total1 > $total2) {
            print "      <td>Ha ganado el jugador 1</td>\n";
        } elseif ($total1 < $total2) {
            print "      <td>Ha ganado el jugador 2</td>\n";
        } else {
            print "      <td>Han empatado</td>\n";
        }
    }
}
?>
    </tr>
  </table>

  <footer>
    <p class="ultmod">
      Última modificación de esta página:
      <time datetime="2019-10-10">10 de octubre de 2019</time>
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
