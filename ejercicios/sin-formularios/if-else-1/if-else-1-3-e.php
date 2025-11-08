<?php
/**
 * if ... else ... (1) 3 E - if-else-1-3-e.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2025 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2025-11-08
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
    Dos dados más altos. Juego.
    if .. elseif ... else ... (1). Sin formularios.
    Ejercicios. PHP. Bartolomé Sintes Marco. www.mclibre.org
  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="mclibre-php-ejercicios.css" title="Color">
</head>

<body>
  <h1>Juego: Dos dados más altos</h1>

  <p>Actualice la página para mostrar una nueva tirada.</p>

  <table>
    <tr>
      <th>Jugador 1</th>
      <th>Jugador 2</th>
      <th>Resultado</th>
    </tr>
    <tr>
<?php
$j1d1 = rand(1, 6);
$j1d2 = rand(1, 6);
$j2d1 = rand(1, 6);
$j2d2 = rand(1, 6);

print "      <td style=\"padding: 10px; background-color: red;\">\n";
print "        <img src=\"img/$j1d1.svg\" alt=\"$j1d1\" width=\"140\" height=\"140\">\n";
print "        <img src=\"img/$j1d2.svg\" alt=\"$j1d2\" width=\"140\" height=\"140\">\n";
print "      </td>\n";
print "      <td style=\"padding: 10px; background-color: blue;\">\n";
print "        <img src=\"img/$j2d1.svg\" alt=\"$j2d1\" width=\"140\" height=\"140\">\n";
print "        <img src=\"img/$j2d2.svg\" alt=\"$j2d2\" width=\"140\" height=\"140\">\n";
print "      </td>\n";

$pareja1 = $j1d1 == $j1d2 ? $j1d1 : 0;
$pareja2 = $j2d1 == $j2d2 ? $j2d1 : 0;

$total1 = $j1d1 + $j1d2;
$total2 = $j2d1 + $j2d2;

// Si el primer jugador saca una pareja de mayor valor que el segundo
// o si el primer jugador saca pareja y el segundo no
if ($pareja1 > $pareja2) {
    print "      <td>Ha ganado el jugador 1</td>\n";
// Si el segundo jugador saca una pareja de mayor valor que el primero
// o si el primer jugador saca pareja y el segundo no
} elseif ($pareja1 < $pareja2) {
    print "      <td>Ha ganado el jugador 2</td>\n";
// Si el primer jugador saca más puntos que el segundo (por descarte, ambos sacan pareja o no)
} elseif ($total1 > $total2) {
    print "      <td>Ha ganado el jugador 1</td>\n";
// Si el segundo jugador saca más puntos que el primero (por descarte, ambos sacan pareja o no)
} elseif ($total1 < $total2) {
    print "      <td>Ha ganado el jugador 2</td>\n";
// Por descarte, ambos jugadores sacan los mismos puntos, sacando pareja o no
} else {
    print "      <td>Han empatado</td>\n";
}
?>
    </tr>
  </table>

  <footer>
    <p class="ultmod">
      Última modificación de esta página:
      <time datetime="2025-11-08">8 de noviembre de 2025</time>
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
