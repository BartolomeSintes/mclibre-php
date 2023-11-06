<?php
/**
 * if ... elseif ... else ... 2-2 - if-else-2-2.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2019 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2019-10-24
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
    Comprobador de múltiplos (Resultado).
    if ... elseif ... else ... Con formularios.
    Ejercicios. PHP. Bartolomé Sintes Marco. www.mclibre.org
  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="mclibre-php-ejercicios.css" title="Color">
</head>

<body>
  <h1>Comprobador de múltiplos (Resultado)</h1>

<?php
// Función de recogida de datos
function recoge($key, $type = "")
{
    if ($type !== "" && $type !== []) {
        trigger_error("Function recoge(): argument #2 (\$type) must be an empty array or an empty string.", E_USER_ERROR);
    }
    $tmp = $type;
    if (isset($_REQUEST[$key])) {
        if (!is_array($_REQUEST[$key]) && !is_array($type)) {
            $tmp = trim(htmlspecialchars($_REQUEST[$key]));
        } elseif (is_array($_REQUEST[$key]) && is_array($type)) {
            $tmp = $_REQUEST[$key];
            array_walk_recursive($tmp, function (&$value) {
                $value = trim(htmlspecialchars($value));
            });
        }
    }
    return $tmp;
}

$numero1 = recoge("numero1");
$numero2 = recoge("numero2");

$numero1Ok = false;
$numero2Ok = false;

if ($numero1 == "") {
    print "  <p class=\"aviso\">No ha escrito el primer número.</p>\n";
    print "\n";
} elseif (!is_numeric($numero1)) {
    print "  <p class=\"aviso\">No ha escrito el primer número como número.</p>\n";
    print "\n";
} elseif (!ctype_digit($numero1)) {
    print "  <p class=\"aviso\">No ha escrito el primer número como número "
        . "entero positivo (sin parte decimal).</p>\n";
    print "\n";
} elseif ($numero1 == 0) {
    print "  <p class=\"aviso\">El primer número es cero.</p>\n";
    print "\n";
} elseif ($numero1 >= 1000) {
    print "  <p class=\"aviso\">El primer número no es inferior a 1.000.</p>\n";
    print "\n";
} else {
    $numero1Ok = true;
}

if ($numero2 == "") {
    print "  <p class=\"aviso\">No ha escrito el segundo número.</p>\n";
    print "\n";
} elseif (!is_numeric($numero2)) {
    print "  <p class=\"aviso\">No ha escrito el segundo número como número.</p>\n";
    print "\n";
} elseif (!ctype_digit($numero2)) {
    print "  <p class=\"aviso\">No ha escrito el segundo número como número "
        . "entero positivo (sin parte decimal).</p>\n";
    print "\n";
} elseif ($numero2 == 0) {
    print "  <p class=\"aviso\">El segundo número es cero.</p>\n";
    print "\n";
} elseif ($numero2 >= 1000) {
    print "  <p class=\"aviso\">El segundo número no es inferior a 1.000.</p>\n";
    print "\n";
} else {
    $numero2Ok = true;
}

if ($numero1Ok && $numero2Ok) {
    $mayor = $numero1 >= $numero2 ? $numero1 : $numero2;
    $menor = $numero1 >= $numero2 ? $numero2 : $numero1;
    print "  <p>Número 1: <strong>$numero1</strong></p>\n";
    print "\n";
    print "  <p>Número 2: <strong>$numero2</strong></p>\n";
    print "\n";
    if ($mayor % $menor == 0) {
        print "  <p>$mayor es múltiplo de $menor.</p>\n";
    } else {
        print "  <p>$mayor <strong>no</strong> es múltiplo de $menor.</p>\n";
    }
    print "\n";
}
?>
  <p><a href="if-else-2-1.php">Volver al formulario.</a></p>

  <footer>
    <p class="ultmod">
      Última modificación de esta página:
      <time datetime="2019-10-24">24 de octubre de 2019</time>
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
