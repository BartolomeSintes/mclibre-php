<?php
/**
 * if ... elseif ... else ... 5-2 - if-else-5-2.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2019 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2018-10-23
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
  <meta charset="utf-8">
  <title>
    Calculadora de años bisiestos (Resultado).
    if ... elseif ... else ... Con formularios.
    Ejercicios. PHP. Bartolomé Sintes Marco. www.mclibre.org
  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="mclibre-php-ejercicios.css" title="Color">
</head>

<body>
  <h1>Calculadora de años bisiestos (Resultado)</h1>

<?php
function recoge($var)
{
    if (!isset($_REQUEST[$var])) {
        $tmp = "";
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

$anyo = recoge("anyo");

$anyoOk = false;

if ($anyo == "") {
    print "  <p class=\"aviso\">No ha escrito el año.</p>\n";
    print "\n";
} elseif (!is_numeric($anyo)) {
    print "  <p class=\"aviso\">No ha escrito el año como número.</p>\n";
    print "\n";
} elseif (!ctype_digit($anyo)) {
    print "  <p class=\"aviso\">No ha escrito el año como número "
        . "entero positivo (sin parte decimal).</p>\n";
    print "\n";
} elseif ($anyo >= 10000) {
    print "  <p class=\"aviso\">El año no es inferior a 10.000.</p>\n";
    print "\n";
} else {
    $anyoOk = true;
}

if ($anyoOk) {
    if ($anyo % 400 == 0) {
        print "  <p>El año $anyo es bisiesto porque es múltiplo de 400.</p>\n";
    } elseif ($anyo % 100 == 0) {
        print "  <p>El año $anyo no es bisiesto porque es múltiplo de 100, "
            . "pero no es múltiplo de 400.</p>\n";
    } elseif ($anyo % 4 == 0) {
        print "  <p>El año $anyo es bisiesto porque es múltiplo de 4, "
            . "pero no es múltiplo de 100.</p>\n";
    } else {
        print "  <p>El año $anyo no es bisiesto porque no es múltiplo de 4.</p>\n";
    }
    print "\n";
}
?>
  <p><a href="if-else-5-1.php">Volver al formulario.</a></p>

  <footer>
    <p class="ultmod">
      Última modificación de esta página:
      <time datetime="2019-10-24">24 de octubre de 2019</time>
    </p>

    <p class="licencia">
      Este programa forma parte del curso <strong><a href="http://www.mclibre.org/consultar/php/">Programación
      web en PHP</a></strong> de <a href="http://www.mclibre.org/" rel="author">Bartolomé Sintes Marco</a>.<br>
      El programa PHP que genera esta página se distribuye bajo
      <a rel="license" href="http://www.gnu.org/licenses/agpl.txt">licencia AGPL 3 o posterior</a>.
    </p>
  </footer>
</body>
</html>
