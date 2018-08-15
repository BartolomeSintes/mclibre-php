<?php
/**
 * if ... else ... (1) 2 - if-else-1-2.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2017 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2017-10-12
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
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <title>Dado más alto. Juego. if .. elseif ... else ... (1).
    Ejercicios. Programación web en PHP. Bartolomé Sintes Marco</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="mclibre-php-soluciones.css" rel="stylesheet" type="text/css" title="Color" />
</head>

<body>
  <h1>Juego: Dado más alto</h1>

  <p>Actualice la página para mostrar una nueva tirada.</p>

  <table>
    <tbody>
      <tr>
        <th>Jugador 1</th>
        <th>Jugador 2</th>
        <th>Resultado</th>
      </tr>
      <tr>
<?php
$dado1 = rand(1, 6);
$dado2 = rand(1, 6);

print "        <td style=\"padding: 10px; background-color: red;\"><img src=\"img/$dado1.svg\" alt=\"$dado1\" title=\"$dado1\" width=\"140\" height=\"140\" style=\"background-color: red;\" /></td>\n";
print "        <td style=\"padding: 10px; background-color: blue;\"><img src=\"img/$dado2.svg\" alt=\"$dado2\" title=\"$dado2\" width=\"140\" height=\"140\" style=\"background-color: red;\" /></td>\n";

if ($dado1 > $dado2) {
    print "        <td>Ha ganado el jugador 1</td>\n";
} elseif ($dado1 < $dado2) {
    print "        <td>Ha ganado el jugador 2</td>\n";
} else {
    print "        <td>Han empatado</td>\n";
}
?>
      </tr>
    </tbody>
  </table>

  <footer>
    <p class="ultmod">
      Última modificación de esta página:
      <time datetime="2017-10-12">12 de octubre de 2017</time>
    </p>

    <p class="licencia">
      Este programa forma parte del curso <a href="http://www.mclibre.org/consultar/php/">
      Programación web en PHP</a> por <a href="http://www.mclibre.org/">Bartolomé
      Sintes Marco</a>.<br />
      El programa PHP que genera esta página está bajo
      <a rel="license" href="http://www.gnu.org/licenses/agpl.txt">licencia AGPL 3 o posterior</a>.</p>
  </footer>
</body>
</html>
