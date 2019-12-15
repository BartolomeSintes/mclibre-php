<?php
/**
 * Imágenes - imagenes-22.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2014 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2014-10-29
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
    Cuadrados de color al azar. Imágenes 3.
    Ejercicios. PHP. Bartolomé Sintes Marco. www.mclibre.org
  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="mclibre-php-ejercicios.css" title="Color">
</head>

<body>
  <h1>Cuadrados de color al azar</h1>

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

$cuadros = recoge("cuadros");
$mas     = recoge("mas");
$menos   = recoge("menos");
$ancho   = 150;

if ($cuadros == "" || !is_numeric($cuadros) || !ctype_digit($cuadros)
    || $cuadros < 0) {
    $cuadros = 1;
}

if ($mas != "") {
    $cuadros += 1;
}

if ($menos != "" && $cuadros > 1) {
    $cuadros -= 1;
}

print "  <form action=\"$_SERVER[PHP_SELF]\" method=\"get\">\n";
print "    <p>\n";
print "      <input type=\"submit\" name=\"mas\" value=\"Añadir cuadro\">\n";
print "      <input type=\"submit\" name=\"menos\" value=\"Quitar cuadro\">\n";
print "      <input type=\"hidden\" name=\"cuadros\" value=\"$cuadros\">\n";
print "    </p>\n";
print "  </form>\n";
print "\n";
print "  <p>\n";
for ($i = 1; $i <= $cuadros; $i++) {
    $colorR = rand(1, 255);
    $colorG = rand(1, 255);
    $colorB = rand(1, 255);
    $color  = "rgb($colorR, $colorG, $colorB)";
    print "    <svg version=\"1.1\" xmlns=\"http://www.w3.org/2000/svg\" "
        . "width=\"{$ancho}px\" height=\"{$ancho}px\">\n";
    print "      <path fill=\"$color\" stroke=\"black\" stroke-width=\"3\" "
    . "d=\"M 2,2 l" . ($ancho - 4) . ",0 l0," . ($ancho - 4) . "l-" . ($ancho - 4) . ",0z\" />\n";
    print "    </svg>\n";
}
print "  </p>\n";

?>

  <footer>
    <p class="ultmod">
      Última modificación de esta página:
      <time datetime="2014-10-29">29 de octubre de 2014</time>
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
