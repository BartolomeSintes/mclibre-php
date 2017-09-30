<?php
/**
 * Matrices (1) 5 - matrices-1-05.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2017 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2017-09-30
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
  <title>Jugada de Risk. Matrices (1).
    Ejercicios. Programación web en PHP. Bartolomé Sintes Marco</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="mclibre-php-soluciones.css" rel="stylesheet" type="text/css" title="Color" />
</head>

<body>
  <h1>Jugada de Risk</h1>

  <p>Actualice la página para mostrar una nueva tirada de Risk.</p>

<?php
// Mostramos con cuántos dados va a jugar el Atacante
print "  <h2>Atacante</h2>\n";
print "\n";
$numero1 = rand(1, 3);
if ($numero1 == 1) {
    print "  <p>El atacante ataca con $numero1 dado:</p>\n";
} else {
    print "  <p>El atacante ataca con $numero1 dados:</p>\n";
}
print "\n";

// Guardamos los valores del Atacante en la matriz $dados1
$dados1 = array();
for ($i = 0; $i < $numero1; $i++) {
    array_push($dados1, rand(1, 6));
}

// Ordenamos la matriz  $dados2 y mostramos los resultados obtenidos por el Atacante
rsort($dados1);
print "  <p>\n";
for ($i = 0; $i < $numero1; $i++) {
    print "    <img src=\"img/$dados1[$i].svg\" alt=\"$dados1[$i]\" title=\"$dados1[$i]\" width=\"140\" height=\"140\" />\n";
}
print "  </p>\n";
print "\n";

// Mostramos con cuántos dados va a jugar el Defensor
print "  <h2>Defensor</h2>\n";
print "\n";
$numero2 = rand(1, 2);
if ($numero2 == 1) {
    print "  <p>El defensor defiende con $numero2 dado:</p>\n";
} else {
    print "  <p>El defensor defiende con $numero2 dados:</p>\n";
}
print "\n";

// Guardamos los valores del Defensor en la matriz $dados2
$dados2 = array();
for ($i = 0; $i < $numero2; $i++) {
    array_push($dados2, rand(1, 6));
}

// Ordenamos la matriz $dados2 y mostramos los resultados obtenidos por el Defensor
rsort($dados2);
print "  <p>\n";
for ($i = 0; $i < $numero2; $i++) {
    print "    <img src=\"img/$dados2[$i].svg\" alt=\"$dados2[$i]\" title=\"$dados2[$i]\" width=\"140\" height=\"140\" />\n";
}
print "    </p>\n";
print "\n";

// En los acumuladores $bajasAtacante $bajasDefensor contamos cuántas partidas ha perdido cada uno
// El número de dados que se compara es el menor de los números de dados tirados
$menor = min($numero1, $numero2);
$bajasAtacante = 0;
$bajasDefensor = 0;
for ($i = 0; $i < $menor; $i++) {
    if ($dados1[$i] > $dados2[$i]) {
        $bajasDefensor++;
    } else {
        $bajasAtacante++;
    }
}

// Mostramos cuántas partidas bajas ha tenido cada jugador
print "  <h2>Resultado</h2>\n";
print "\n";
print "  <p>El atacante pierde <strong>$bajasAtacante</strong> unidad";
if ($bajasAtacante != 1) {
    print "es";
}
print ". El defensor pierde <strong>$bajasDefensor</strong> unidad";
if ($bajasDefensor != 1) {
    print "es";
}
print ".\n";
?>

  <footer>
    <p class="ultmod">
      Última modificación de esta página:
      <time datetime="2017-09-30">30 de septiembre de 2017</time></p>

    <p class="licencia">
      Este programa forma parte del curso <a href="http://www.mclibre.org/consultar/php/">
      Programación web en PHP</a> por <a href="http://www.mclibre.org/">Bartolomé
      Sintes Marco</a>.<br />
      El programa PHP que genera esta página está bajo
      <a rel="license" href="http://www.gnu.org/licenses/agpl.txt">licencia AGPL 3 o posterior</a>.</p>
  </footer>
</body>
</html>
