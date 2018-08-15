<?php
/**
 * Imágenes - imagenes-32.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2014 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2014-10-27
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
  <title>Tiro al plato (2). Imágenes.
    Ejercicios. PHP. Bartolomé Sintes Marco</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="mclibre-php-soluciones.css" rel="stylesheet" type="text/css" title="Color" />
</head>

<body>
  <h1>Tiro al plato (2)</h1>

<?php
function recoge($var)
{
    $tmp = (isset($_REQUEST[$var]))
        ? trim(htmlspecialchars($_REQUEST[$var], ENT_QUOTES, "UTF-8"))
        : "";
    return $tmp;
}

function microtime_float()
{
    list($usec, $sec) = explode(" ", microtime());
    return ((float)$usec + (float)$sec);
}

$tiroX     = recoge("tiro_x");
$tiroY     = recoge("tiro_y");
$circuloX  = recoge("circuloX");
$circuloY  = recoge("circuloY");
$circuloR  = recoge("circuloR");
$tiempo    = recoge("tiempo");
$tamX      = 800;
$tamY      = 400;
$minRadio  = 5;
$maxRadio  = 20;

if ($tiempo == "") {
    $tiempo = microtime_float();
}

// print "  <p>" . microtime_float() . " " . $tiempo . "</p>\n";

if ($tiroX == "" && $tiroY == "" && $circuloX == "" && $circuloY == ""
    && $circuloR == "") {
    print "  <p>Haga clic en el punto negro.</p>\n";
} else {
    if ($circuloX - $circuloR <= $tiroX && $tiroX <= $circuloX + $circuloR
        && $circuloY - $circuloR <= $tiroY && $tiroY <= $circuloY + $circuloR) {
        print "  <p><strong>¡Correcto!</strong> Ha tardado " . round(microtime_float() - $tiempo, 1) . " s. Haga clic en el punto negro.</p>\n";
    } else {
        print "  <p><strong>¡Ha fallado!</strong> Haga clic en el punto negro.</p>\n";
    }
}

$circuloR = rand($minRadio, $maxRadio);
$circuloX = rand(2 + $circuloR, $tamX - 4 - $circuloR);
$circuloY = rand(2 + $circuloR, $tamY - 4 - $circuloR);

print "  <form action=\"$_SERVER[PHP_SELF]\" method=\"get\">\n";
print "    <p>\n";
print "      <input type=\"image\" name=\"tiro\" alt=\"Tiro al plato\" "
    . "src=\"imagenes-32-img.php?tamX=$tamX&tamY=$tamY&circuloR=$circuloR"
    . "&circuloX=$circuloX&circuloY=$circuloY\" height=\"$tamY\" />\n";
print "    </p>\n";
print "\n";
print "    <p>\n";
print "      <input type=\"hidden\" name=\"circuloX\" value=\"$circuloX\" />\n";
print "      <input type=\"hidden\" name=\"circuloY\" value=\"$circuloY\" />\n";
print "      <input type=\"hidden\" name=\"circuloR\" value=\"$circuloR\" />\n";
print "      <input type=\"hidden\" name=\"tiempo\" value=\"" . microtime_float() . "\" />\n";
print "    </p>\n";
print "\n";
print "    <p><input type=\"submit\" value=\"Reiniciar partida\" /></p>\n";
print "  </form>\n";
?>

  <footer>
    <p class="ultmod">
      Última modificación de esta página:
      <time datetime="2014-10-27">27 de octubre de 2014</time>
    </p>

    <p class="licencia">
      Esta página forma parte del curso <a href="http://www.mclibre.org/consultar/php/">
      <cite>Programación web en PHP</cite></a> por <cite>Bartolomé Sintes Marco</cite>.<br />
      y se distribuye bajo una <a rel="license" href="https://creativecommons.org/licenses/by-sa/4.0/deed.es_ES">
      Licencia Creative Commons Reconocimiento-CompartirIgual 4.0 Internacional (CC BY-SA 4.0)</a>.</p>
  </footer>
</body>
</html>
