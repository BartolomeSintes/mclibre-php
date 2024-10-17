<?php
/**
 * if ... else ... (0) 6 - if-else-0-6.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2024 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2024-10-17
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
    Convertidor de color: de RGB a HSL.
    if .. elseif ... else ... (0). Sin formularios.
    Ejercicios. PHP. Bartolomé Sintes Marco. www.mclibre.org
  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="mclibre-php-ejercicios.css" title="Color">
</head>

<body>
  <h1>Convertidor de color: de RGB a HSL</h1>

  <p>Actualice la página para mostrar una nueva conversión de código de color.</p>

<?php
$red   = rand(0, 255);
$green = rand(0, 255);
$blue  = rand(0, 255);

$r = $red   / 255;
$g = $green / 255;
$b = $blue  / 255;

$M = max($r, $g, $b);
$m = min($r, $g, $b);
$C = $M - $m;

if ($C == 0) {
    $h = 0;
} elseif ($M == $r) {
    $h = ($g - $b) / $C;
} elseif ($M == $g) {
    $h = ($b - $r) / $C + 2;
} elseif ($M == $b) {
    $h = ($r - $g) / $C + 4;
}
if ($h < 0) {
    $h = $h + 6;
}
$h = $h * 60;
$h = round($h);
$H = $h % 360;

$L = ($M + $m) / 2;

if ($L == 1) {
    $S = 0;
} else {
    $S = $C / (1 - abs(2 * $L - 1));
}
$L = round($L, 3) * 100;
$S = round($S, 3) * 100;

print "  <p>El color <strong>rgb($red $green $blue)</strong> es el color <strong>hsl($H $S% $L%)</strong>.</p>\n";
?>

  <footer>
    <p class="ultmod">
      Última modificación de esta página:
      <time datetime="2024-10-17">17 de octubre de 2024</time>
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
