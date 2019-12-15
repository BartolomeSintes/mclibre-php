<?php
/**
 * Matrices (3) 13 - matrices-1-13.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2018 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2019-10-17
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
    Jugada de Risk.
    Matrices (3). Sin formularios.
    Ejercicios. PHP. Bartolomé Sintes Marco. www.mclibre.org
  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="mclibre-php-ejercicios.css" title="Color">
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
$dados1 = [];
for ($i = 0; $i < $numero1; $i++) {
    $dados1[$i] = rand(1, 6);
}

// Ordenamos la matriz $dados2 y mostramos los resultados obtenidos por el Atacante
rsort($dados1);
print "  <p>\n";
foreach ($dados1 as $dado) {
    print "    <img src=\"img/$dado.svg\" alt=\"$dado\" width=\"100\" height=\"100\">\n";
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
$dados2 = [];
for ($i = 0; $i < $numero2; $i++) {
    $dados2[$i] = rand(1, 6);
}

// Ordenamos la matriz $dados2 y mostramos los resultados obtenidos por el Defensor
rsort($dados2);
print "  <p>\n";
foreach ($dados2 as $dado) {
    print "    <img src=\"img/$dado.svg\" alt=\"$dado\" width=\"100\" height=\"100\">\n";
}
print "  </p>\n";
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

// Mostramos cuántas bajas ha tenido cada jugador
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
print ".</p>\n";

?>

  <footer>
    <p class="ultmod">
      Última modificación de esta página:
      <time datetime="2019-10-17">17 de octubre de 2019</time>
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
