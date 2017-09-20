<?php
/**
 * Ejemplo de ejercicio sin formulario 1 - ejemplo-sf-1.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2017 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2017-09-20
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
  <title>Ejemplo de ejercicio sin formulario 1.
    Ejercicios. Programación web en PHP. Bartolomé Sintes Marco</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="mclibre-php-soluciones.css" rel="stylesheet" type="text/css" title="Color" />
</head>

<body>
  <h1>Ejemplo de ejercicio sin formulario 1</h1>

  <p>Actualice la página para mostrar dos nuevos colores.</p>

  <table>
    <tbody>
<?php
$color1 = rand(0, 360);
$color2 = rand(0, 360);

print "      <tr>\n";
print "        <th>Color: hsl($color1, 100%, 50%)</th>\n";
print "        <th>Color: hsl($color2, 100%, 50%)</th>\n";
print "      </tr>\n";
print "      <tr>\n";
print "        <td style=\"height: 50px; background-color: hsl($color1, 100%, 50%)\"></td>\n";
print "        <td style=\"background-color: hsl($color2, 100%, 50%)\"></td>\n";
print "      </tr>\n";
?>
    </tbody>
  </table>

  <footer>
    <p class="ultmod">
      Última modificación de esta página:
      <time datetime="2017-09-20">20 de septiembre de 2017</time></p>
  </footer>
</body>
</html>
