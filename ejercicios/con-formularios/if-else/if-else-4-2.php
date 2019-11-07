<?php
/**
 * if ... elseif ... else ... 4-2 - if-else-4-2.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2019 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2019-10-24
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
    Comparador de tres números enteros (Resultado).
    if ... elseif ... else ... Con formularios.
    Ejercicios. PHP. Bartolomé Sintes Marco. www.mclibre.org
  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="mclibre-php-ejercicios.css" title="Color">
</head>

<body>
  <h1>Comparador de tres números enteros (Resultado)</h1>

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

$numero1 = recoge("numero1");
$numero2 = recoge("numero2");
$numero3 = recoge("numero3");

$numero1Ok = false;
$numero2Ok = false;
$numero3Ok = false;

if ($numero1 == "") {
    print "  <p class=\"aviso\">No ha escrito el primer número.</p>\n";
    print "\n";
} elseif (!is_numeric($numero1)) {
    print "  <p class=\"aviso\">No ha escrito el primer número como número.</p>\n";
    print "\n";
} elseif ($numero1 != round($numero1)) {
    print "  <p class=\"aviso\">No ha escrito el primer número como número entero.</p>\n";
    print "\n";
} elseif ($numero1 <= -1000 || $numero1 >= 1000) {
    print "  <p class=\"aviso\">El primer número no está entre -1.000 y 1.000.</p>\n";
    print "\n";
} else {
    $numero1Ok = true;
}

if ($numero2 == "") {
    print "  <p class=\"aviso\">No ha escrito el segundo numero.</p>\n";
    print "\n";
} elseif (!is_numeric($numero2)) {
    print "  <p class=\"aviso\">No ha escrito el segundo número como número.</p>\n";
    print "\n";
} elseif ($numero2 != round($numero2)) {
    print "  <p class=\"aviso\">No ha escrito el segundo número como número entero.</p>\n";
    print "\n";
} elseif ($numero2 <= -1000 || $numero2 >= 1000) {
    print "  <p class=\"aviso\">El segundo número no está entre -1.000 y 1.000.</p>\n";
    print "\n";
} else {
    $numero2Ok = true;
}

if ($numero3 == "") {
    print "  <p class=\"aviso\">No ha escrito el tercer numero.</p>\n";
    print "\n";
} elseif (!is_numeric($numero3)) {
    print "  <p class=\"aviso\">No ha escrito el tercer número como número.</p>\n";
    print "\n";
} elseif ($numero3 != round($numero3)) {
    print "  <p class=\"aviso\">No ha escrito el tercer número como número entero.</p>\n";
    print "\n";
} elseif ($numero3 <= -1000 || $numero3 >= 1000) {
    print "  <p class=\"aviso\">El tercer número no está entre -1.000 y 1.000.</p>\n";
    print "\n";
} else {
    $numero3Ok = true;
}

if ($numero1Ok && $numero2Ok && $numero3Ok) {
    print "  <p>Primer número: <strong>$numero1</strong></p>\n";
    print "\n";
    print "  <p>Segundo número: <strong>$numero2</strong></p>\n";
    print "\n";
    print "  <p>Tercer número: <strong>$numero3</strong></p>\n";
    print "\n";
    if ($numero1 == $numero2 && $numero2 == $numero3) {
        print "  <p>Has escrito tres números iguales.</p>\n";
    } elseif ($numero1 == $numero2 || $numero2 == $numero3 || $numero1 == $numero3) {
        print "  <p>Has escrito dos números iguales.</p>\n";
    } else {
        print "  <p>Has escrito tres números distintos.</p>\n";
    }
    print "\n";
}
?>
  <p><a href="if-else-4-1.php">Volver al formulario.</a></p>

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
