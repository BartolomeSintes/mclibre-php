<?php
/**
 * Matrices (3) 6 - matrices-3-06.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2019 Bartolomé Sintes Marco
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
    Todos los emoticonos.
    Matrices (3). Sin formularios.
    Ejercicios. PHP. Bartolomé Sintes Marco. www.mclibre.org
  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="mclibre-php-ejercicios.css" title="Color">
</head>

<body>
  <h1>Todos los emoticonos</h1>

  <p>Actualice la página para mostrar un nuevo emoticono seleccionado al azar.</p>

<?php
// Definimos las matrices con los rangos de emoticonos
$emoticonos_1 = range(128512, 128580);
$emoticonos_2 = range(129296, 129303);
$emoticonos_3 = range(129312, 129327);
$emoticonos_4 = [129392, 129393];
$emoticonos_5 = range(129395, 129398);
$emoticonos_6 = [129402, 129488];

// Unimos las matrices en una sola
$emoticonos = array_merge($emoticonos_1, $emoticonos_2, $emoticonos_3, $emoticonos_4, $emoticonos_5, $emoticonos_6);

// Mostramos las imágenes de los emoticonos obtenidos
print "  <h2>". count($emoticonos) . " emoticonos</h2>\n";
print "\n";
print "  <p style=\"font-size: 400%; margin: 0;\">\n";
foreach ($emoticonos as $emoticono) {
    print "    &#$emoticono;\n";
}
print "  </p>\n";
print "\n";

// Mostramos un emoticono al azar
print "  <h2>Uno al azar</h2>\n";
print "\n";
print "  <p style=\"font-size: 400%; margin: 0;\">&#". $emoticonos[rand(0, count($emoticonos)-1)] . ";</p>\n";

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
