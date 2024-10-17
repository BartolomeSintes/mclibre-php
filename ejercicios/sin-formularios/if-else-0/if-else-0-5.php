<?php
/**
 * if ... else ... (0) 5 - if-else-0-5.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2024 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2024-10-08
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
    Comprobador de años bisiestos.
    if .. elseif ... else ... (0). Sin formularios.
    Ejercicios. PHP. Bartolomé Sintes Marco. www.mclibre.org
  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="mclibre-php-ejercicios.css" title="Color">
</head>

<body>
  <h1>Comprobador de años bisiestos</h1>

  <p>Actualice la página para mostrar un nuevo año.</p>

<?php
$year = rand(1582, 2100);

if ($year % 400 == 0) {
    print "  <p>$year es un año bisiesto porque es múltiplo de 400.</p>\n";
} elseif ($year % 100 == 0) {
    print "  <p>$year no es un año bisiesto porque es múltiplo de 100 pero no de 400.</p>\n";
} elseif ($year % 4 == 0) {
    print "  <p>$year es un año bisiesto porque es múltiplo de 4 pero no de 100.</p>\n";
} else {
    print "  <p>$year no es un año bisiesto porque no es múltiplo de 4.</p>\n";
}
?>

  <footer>
    <p class="ultmod">
      Última modificación de esta página:
      <time datetime="2024-10-09">9 de octubre de 2024</time>
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
