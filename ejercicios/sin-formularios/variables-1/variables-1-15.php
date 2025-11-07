<?php
/**
 * Variables. Sin formularios (1) 15 - variables-1-15.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2025 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2025-02-08
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
    Ruleta de la fortuna.
    Variables. Sin formularios.
    Ejercicios. PHP. Bartolomé Sintes Marco. www.mclibre.org
  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="mclibre-php-ejercicios.css" title="Color">
</head>

<body>
  <h1>Ruleta de la fortuna</h1>

  <p>
    <svg width="320" height="220" viewBox="-10 -10 320 220">
      <path d="M 100,100 150,13 A 100,100 0 0,1 200,100 Z" fill="hwb(0 40% 0%)" />
      <path d="M 100,100 200,100 A 100,100 0 0,1 150,187 Z" fill="hwb(60 40% 0%)" />
      <path d="M 100,100 150,187 A 100,100 0 0,1 50,187 Z" fill="hwb(120 40% 0%)" />
      <path d="M 100,100 50,187 A 100,100 0 0,1 0,100 Z" fill="hwb(180 40% 0%)" />
      <path d="M 100,100 0,100 A 100,100 0 0,1 50,13 Z" fill="hwb(240 40% 0%)" />
      <path d="M 100,100 50,13 A 100,100 0 0,1 150,13 Z" fill="hwb(300 40% 0%)" />
      <text x="100" y="37" text-anchor="middle" font-family="sans-serif" font-size="40">1</text>
      <text x="167" y="76" text-anchor="middle" font-family="sans-serif" font-size="40">2</text>
      <text x="167" y="146" text-anchor="middle" font-family="sans-serif" font-size="40">3</text>
      <text x="100" y="192" text-anchor="middle" font-family="sans-serif" font-size="40">4</text>
      <text x="32" y="146" text-anchor="middle" font-family="sans-serif" font-size="40">5</text>
      <text x="32" y="76" text-anchor="middle" font-family="sans-serif" font-size="40">6</text>
      <circle cx="100" cy="100" r="100" stroke="black" stroke-width="4" fill="none" />
<?php
$resultado = rand(1, 6);
$angulo    = $resultado * 60 + 300;
$tiempo    = $resultado * 0.2 + 1;

print "      <g>\n";
print "        <polygon points=\"100,40 115,55 105,55 105,150 115,160 105,160 100,155 95,160 85,160 95,150 95,55 85,55\" stroke=\"black\" stroke-width=\"2\" fill=\"white\" />\n";
print "        <animateTransform attributeName=\"transform\" attributeType=\"XML\" type=\"rotate\" from=\"0 100 100\" to=\"$angulo 100 100\" dur=\"{$tiempo}s\" repeatCount=\"1\" fill=\"freeze\" />\n";
print "      </g>\n";
print "      <circle cx=\"100\" cy=\"100\" r=\"8\" stroke=\"black\" stroke-width=\"2\" fill=\"#888\" />\n";
print "      <text x=\"250\" y=\"130\" text-anchor=\"middle\" font-family=\"sans-serif\" font-size=\"90\" opacity=\"0\">\n";
print "        $resultado\n";
print "        <animate dur=\"0.1s\" attributeName=\"opacity\" from=\"0\" to=\"1\" begin=\"{$tiempo}s\" fill=\"freeze\" />\n";
print "      </text>\n";
?>
    </svg>
  </p>

  <footer>
    <p class="ultmod">
      Última modificación de esta página:
      <time datetime="2025-10-23">23 de febrero de 2025</time>
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