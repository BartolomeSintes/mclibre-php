<?php
/**
 * if ... elseif ... else ... 1-2 - if-else-1-2.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2016 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2016-11-04
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
  <title>Calculadora de divisiones (Resultado). if ... elseif ... else ...
    Ejercicios. PHP. Bartolomé Sintes Marco</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="mclibre-php-soluciones.css" rel="stylesheet" type="text/css" title="Color" />
</head>

<body>
  <h1>Calculadora de divisiones (Resultado)</h1>

<?php
function recoge($var)
{
    $tmp = (isset($_REQUEST[$var]))
        ? trim(htmlspecialchars($_REQUEST[$var], ENT_QUOTES, "UTF-8"))
        : "";
    return $tmp;
}

$dividendo = recoge("dividendo");
$divisor   = recoge("divisor");

$dividendoOk = false;
$divisorOk   = false;

if ($dividendo == "") {
    print "  <p class=\"aviso\">No ha escrito el dividendo.</p>\n";
    print "\n";
} elseif (!is_numeric($dividendo)) {
    print "  <p class=\"aviso\">No ha escrito el dividendo como número.</p>\n";
    print "\n";
} elseif ($dividendo < 0 || $dividendo >= 1000) {
    print "  <p class=\"aviso\">El dividendo no está entre 0 y 1000.</p>\n";
    print "\n";
} else {
    $dividendoOk = true;
}

if ($divisor == "") {
    print "  <p class=\"aviso\">No ha escrito el divisor.</p>\n";
    print "\n";
} elseif (!is_numeric($divisor)) {
    print "  <p class=\"aviso\">No ha escrito el divisor como número.</p>\n";
    print "\n";
} elseif ($divisor == 0) {
    print "  <p class=\"aviso\">En una división el divisor no puede ser cero.</p>\n";
    print "\n";
} elseif ($divisor < 0 || $divisor >= 1000) {
    print "  <p class=\"aviso\">El divisor no está entre 0 y 1000.</p>\n";
    print "\n";
} else {
    $divisorOk = true;
}

if ($dividendoOk && $divisorOk) {
    $cociente = floor($dividendo / $divisor);
    $resto = $dividendo - $cociente * $divisor;
    print "  <p>Dividendo: <strong>$dividendo</strong></p>\n";
    print "\n";
    print "  <p>Divisor: <strong>$divisor</strong></p>\n";
    print "\n";
    print "  <p>Cociente: <strong>$cociente</strong></p>\n";
    print "\n";
    print "  <p>Resto: <strong>$resto</strong></p>\n";
    print "\n";
    if ($resto) {
        print "  <p>La división <strong>no</strong> es exacta.</p>\n";
    } else {
        print "  <p>La división es exacta.</p>\n";
    }
    print "\n";
}
?>
  <p><a href="if-else-1-1.php">Volver al formulario.</a></p>

  <footer>
    <p class="ultmod">
      Última modificación de esta página:
      <time datetime="2016-11-04">4 de noviembre de 2016</time>
    </p>

    <p class="licencia">
      Este programa forma parte del curso <a href="http://www.mclibre.org/consultar/php/">
      Programación web en PHP</a> por <a href="http://www.mclibre.org/">Bartolomé
      Sintes Marco</a>.<br />
      El programa PHP que genera esta página está bajo
      <a rel="license" href="http://www.gnu.org/licenses/agpl.txt">licencia AGPL 3 o posterior</a>.</p>
  </footer>
</body>
</html>
