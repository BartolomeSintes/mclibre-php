<?php
/**
 * Imágenes - imagenes-32.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2014 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2014-10-27
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
    Tiro al plato (2). Imágenes.
    Ejercicios. PHP. Bartolomé Sintes Marco. www.mclibre.org
  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="mclibre-php-ejercicios.css" title="Color">
</head>

<body>
  <h1>Tiro al plato (2)</h1>

<?php
function recoge($var, $m = "")
{
    if (!isset($_REQUEST[$var])) {
        $tmp = (is_array($m)) ? [] : "";
    } elseif (!is_array($_REQUEST[$var])) {
        $tmp = trim(htmlspecialchars($_REQUEST[$var], ENT_QUOTES, "UTF-8"));
    } else {
        $tmp = $_REQUEST[$var];
        array_walk_recursive($tmp, function (&$valor) {
            $valor = trim(htmlspecialchars($valor, ENT_QUOTES, "UTF-8"));
        });
    }
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
    . "&circuloX=$circuloX&circuloY=$circuloY\" height=\"$tamY\">\n";
print "    </p>\n";
print "\n";
print "    <p>\n";
print "      <input type=\"hidden\" name=\"circuloX\" value=\"$circuloX\">\n";
print "      <input type=\"hidden\" name=\"circuloY\" value=\"$circuloY\">\n";
print "      <input type=\"hidden\" name=\"circuloR\" value=\"$circuloR\">\n";
print "      <input type=\"hidden\" name=\"tiempo\" value=\"" . microtime_float() . "\">\n";
print "    </p>\n";
print "\n";
print "    <p><input type=\"submit\" value=\"Reiniciar partida\"></p>\n";
print "  </form>\n";
?>

  <footer>
    <p class="ultmod">
      Última modificación de esta página:
      <time datetime="2014-10-27">27 de octubre de 2014</time>
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
