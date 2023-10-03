<?php
/**
 * Variables. Sin formularios.(1) 15 - variables-1-15.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2023 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2023-10-03
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
    Ataque alienígena.
    Variables. Sin formularios.
    Ejercicios. PHP. Bartolomé Sintes Marco. www.mclibre.org
  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="mclibre-php-ejercicios.css" title="Color">
</head>

<body>
  <h1>Ataque alienígena</h1>

  <p>Actualice la página para mostrar un nuevo bombardeo alienígena. Los dados determinan qué casillas son bombardeadas.</p>

<?php
$d1    = rand(1, 6);
$d2    = rand(1, 6);
$d3    = rand(1, 6);
$total = $d1 + $d2 + $d3;

print "  <p>\n";
print "    <img src=\"img/$d1.svg\" alt=\"$d1\" width=\"120\" height=\"120\">\n";
print "    <img src=\"img/$d2.svg\" alt=\"$d2\" width=\"120\" height=\"120\">\n";
print "    <img src=\"img/$d3.svg\" alt=\"$d3\" width=\"120\" height=\"120\">\n";
print "  </p>\n";
print "\n";
?>
  <p>
    <svg version="1.1" xmlns="http://www.w3.org/2000/svg"
      width="830" height="160" viewBox="-40 -50 830 160" style="background-color: white;" font-family="sans-serif">
      <polygon points="60,0 780,0 720,80 0,80" stroke="black" stroke-width="1" fill="none" />
      <text x="180" y="105" text-anchor="middle" font-size="20" fill="black">5</text>
      <text x="380" y="105" text-anchor="middle" font-size="20" fill="black">10</text>
      <text x="580" y="105" text-anchor="middle" font-size="20" fill="black">15</text>
      <line x1="100" y="0" x2="40" y2="80" stroke="black" stroke-width="1" fill="none" />
      <line x1="140" y="0" x2="80" y2="80" stroke="black" stroke-width="1" fill="none" />
      <line x1="180" y="0" x2="120" y2="80" stroke="black" stroke-width="1" fill="none" />
      <line x1="220" y="0" x2="160" y2="80" stroke="black" stroke-width="1" fill="none" />
      <line x1="260" y="0" x2="200" y2="80" stroke="black" stroke-width="1" fill="none" />
      <line x1="300" y="0" x2="240" y2="80" stroke="black" stroke-width="1" fill="none" />
      <line x1="340" y="0" x2="280" y2="80" stroke="black" stroke-width="1" fill="none" />
      <line x1="380" y="0" x2="320" y2="80" stroke="black" stroke-width="1" fill="none" />
      <line x1="420" y="0" x2="360" y2="80" stroke="black" stroke-width="1" fill="none" />
      <line x1="460" y="0" x2="400" y2="80" stroke="black" stroke-width="1" fill="none" />
      <line x1="500" y="0" x2="440" y2="80" stroke="black" stroke-width="1" fill="none" />
      <line x1="540" y="0" x2="480" y2="80" stroke="black" stroke-width="1" fill="none" />
      <line x1="580" y="0" x2="520" y2="80" stroke="black" stroke-width="1" fill="none" />
      <line x1="620" y="0" x2="560" y2="80" stroke="black" stroke-width="1" fill="none" />
      <line x1="660" y="0" x2="600" y2="80" stroke="black" stroke-width="1" fill="none" />
      <line x1="700" y="0" x2="640" y2="80" stroke="black" stroke-width="1" fill="none" />
      <line x1="740" y="0" x2="680" y2="80" stroke="black" stroke-width="1" fill="none" />
<?php
print "      <text x=\"" . $d1 * 40 + 10 . "\" y=\"45\" text-anchor=\"middle\" font-size=\"20\" fill=\"lightgray\" opacity=\"0\">\n";
print "        &#x1f4a5;\n";
print "        <animate dur=\"0.1s\" attributeName=\"opacity\" from=\"0\" to=\"1\" begin=\"" . $d1 * 0.1 + 0.5 . "s\" fill=\"freeze\" />\n";
print "      </text>\n";
print "      <text x=\"" . ($d1 + $d2) * 40 + 10 . "\" y=\"45\" text-anchor=\"middle\" font-size=\"20\" fill=\"lightgray\" opacity=\"0\">\n";
print "        &#x1f4a5;\n";
print "        <animate dur=\"0.1s\" attributeName=\"opacity\" from=\"0\" to=\"1\" begin=\"" . ($d1 + $d2) * 0.1 + 0.5 . "s\" fill=\"freeze\" />\n";
print "      </text>\n";
print "      <text x=\"" . ($d1 + $d2 + $d3) * 40 + 10 . "\" y=\"45\" text-anchor=\"middle\" font-size=\"20\" fill=\"lightgray\" opacity=\"0\">\n";
print "        &#x1f4a5;\n";
print "        <animate dur=\"0.1s\" attributeName=\"opacity\" from=\"0\" to=\"1\" begin=\"" . ($d1 + $d2 + $d3) * 0.1 + 0.5 . "s\" fill=\"freeze\" />\n";
print "      </text>\n";
?>
      <text x="0" y="20" text-anchor="middle" font-size="60" fill="lightgray">
        &#x1f6f8;
        <animateTransform attributeName="transform" attributeType="XML" type="translate" from="0 -5" to="840 -5" begin="0.5s" dur="2s" repeatCount="1" fill="freeze" />
      </text>
    </svg>
  </p>

  <footer>
    <p class="ultmod">
      Última modificación de esta página:
      <time datetime="2023-10-03">3 de octubre de 2023</time>
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
