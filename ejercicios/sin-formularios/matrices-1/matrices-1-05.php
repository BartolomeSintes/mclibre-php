<?php
/**
 * Matrices (1) 5 - matrices-1-05.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2021 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2021-10-19
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
    Hombres y mujeres haciendo deporte.
    Matrices (1). Sin formularios.
    Ejercicios. PHP. Bartolomé Sintes Marco. www.mclibre.org
  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="mclibre-php-ejercicios.css" title="Color">
</head>

<body>
  <h1>Hombres y mujeres haciendo deporte</h1>

  <p>Actualice la página para mostrar un nuevo dibujo.</p>

<?php
$emojis = [127939, 127940, 127946, 128675, 128692, 128693, 128694, 129336, 129337, 129341, 129342, 129495];
$actividades = ["corriendo", "surfeando", "nadando", "remando", "pedaleando", "pedaleando en la montaña", "caminando", "dando volteretas", "haciendo malabares", "jugando al waterpolo", "jugando al balonmano", "escalando"];
$generos = [9794, 9792];
$generosTextos = ["Hombre", "Mujer"];

$emoji = rand(0, count($emojis) - 1);
$genero = rand(0, 1);

print "  <h2>$generosTextos[$genero] $actividades[$emoji]</h2>\n";
print "\n";
print "  <p><span style=\"font-size: 800%\">&#$emojis[$emoji];&#8205;&#$generos[$genero];&#65039;</span></p>\n";
print "\n";
print "  <h2>Secuencia Unicode del emoji</h2>\n";
print "\n";
print "  <p>&amp;#$emojis[$emoji];&amp;#8205;&amp;#$generos[$genero];&amp;#65039;";
?>

  <footer>
    <p class="ultmod">
      Última modificación de esta página:
      <time datetime="2021-10-19">19 de octubre de 2021</time>
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
