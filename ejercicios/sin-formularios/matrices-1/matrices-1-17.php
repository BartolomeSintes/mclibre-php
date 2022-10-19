<?php
/**
 * Matrices (1) 17 - matrices-1-17.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2022 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2022-10-19
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
    Partida de dados.
    Matrices (1). Sin formularios.
    Ejercicios. PHP. Bartolomé Sintes Marco. www.mclibre.org
  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="mclibre-php-ejercicios.css" title="Color">
</head>

<body>
  <h1>Partida de dados</h1>

  <p>Actualice la página para mostrar una nueva partida de dados.</p>

<?php
$numero = rand(2, 7);

print "  <h2>Jugador 1</h2>\n";
print "\n";

// Guardamos los valores del Jugador 1 en la matriz $dados1
$dados1 = [];
for ($i = 0; $i < $numero; $i++) {
    $dados1[$i] = rand(1, 6);
}

// Mostramos los resultados obtenidos por el Jugador 1
print "  <p>\n";
for ($i = 0; $i < $numero; $i++) {
    print "    <img src=\"img/$dados1[$i].svg\" alt=\"$dados1[$i]\" width=\"140\" height=\"140\">\n";
}
print "  </p>\n";
print "\n";

print "  <h2>Jugador 2</h2>\n";
print "\n";

// Guardamos los valores del Jugador 2 en la matriz $dados2
$dados2 = [];
for ($i = 0; $i < $numero; $i++) {
    $dados2[$i] = rand(1, 6);
}

// Mostramos los resultados obtenidos por el Jugador 2
print "  <p>\n";
for ($i = 0; $i < $numero; $i++) {
    print "    <img src=\"img/$dados2[$i].svg\" alt=\"$dados2[$i]\" width=\"140\" height=\"140\">\n";
}
print "  </p>\n";
print "\n";

// En los acumuladores $gana1 $gana2 y $empate contamos cuántas partidas ha ganado cada uno
print "  <h2>Resultado</h2>\n";
print "\n";

$gana1  = 0;
$gana2  = 0;
$empate = 0;
for ($i = 0; $i < $numero; $i++) {
    if ($dados1[$i] > $dados2[$i]) {
        $gana1++;
    } elseif ($dados1[$i] < $dados2[$i]) {
        $gana2++;
    } else {
        $empate++;
    }
}

// Mostramos cuántas partidas ha ganado cada uno
print "  <p>El jugador 1 ha ganado <strong>$gana1</strong> ";
print $gana1 != 1 ? "veces" : "vez";
print ", el jugador 2 ha ganado <strong>$gana2</strong> ";
print $gana2 != 1 ? "veces" : "vez";
print " y los jugadores han empatado <strong>$empate</strong> ";
print $empate != 1 ? "veces" : "vez";
print ".</p>\n";
print "\n";

// Mostramos quién ha ganado la partida
if ($gana1 > $gana2) {
    print "  <p>En conjunto, ha ganado el jugador <strong>1</strong>.</p>\n";
} elseif ($gana1 < $gana2) {
    print "  <p>En conjunto, ha ganado el jugador <strong>2</strong>.</p>\n";
} else {
    print "  <p>En conjunto, han empatado.</p>\n";
}
?>

  <footer>
    <p class="ultmod">
      Última modificación de esta página:
      <time datetime="2022-10-19">19 de octubre de 2022</time>
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
