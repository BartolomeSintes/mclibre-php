<?php
/**
 * Segmentos (Resultado)- for-2-2-2.php
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
    Segmentos (Resultado). for (2).
    Ejercicios. PHP. Bartolomé Sintes Marco. www.mclibre.org
  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="mclibre-php-ejercicios.css" title="Color">
</head>

<body>
  <h1>Segmentos (Resultado)</h1>

<?php
// Función de recogida de datos
function recoge($key, $type = "")
{
    if (!is_string($key) && !is_int($key) || $key == "") {
        trigger_error("Function recoge(): Argument #1 (\$key) must be a non-empty string or an integer", E_USER_ERROR);
    } elseif ($type !== "" && $type !== []) {
        trigger_error("Function recoge(): Argument #2 (\$type) is optional, but if provided, it must be an empty array or an empty string", E_USER_ERROR);
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

$tamano    = recoge("tamano");
$segmentos = recoge("segmentos");

$tamanoOk    = false;
$segmentosOk = false;

$tamanoMinimo = 5;
$tamanoMaximo = 8;

$segmentosMinimo = 2;
$segmentosMaximo = 6;

if ($tamano == "") {
    print "  <p class=\"aviso\">No ha escrito el tamaño.</p>\n";
    print "\n";
} elseif (!is_numeric($tamano)) {
    print "  <p class=\"aviso\">No ha escrito el tamaño como número.</p>\n";
    print "\n";
} elseif (!ctype_digit($tamano)) {
    print "  <p class=\"aviso\">No ha escrito el tamaño como número entero positivo.</p>\n";
    print "\n";
} elseif ($tamano < $tamanoMinimo || $tamano > $tamanoMaximo) {
    print "  <p class=\"aviso\">El tamaño debe estar entre $tamanoMinimo y $tamanoMaximo.</p>\n";
    print "\n";
} else {
    $tamanoOk = true;
}

if ($segmentos == "") {
    print "  <p class=\"aviso\">No ha escrito el número de segmentos.</p>\n";
    print "\n";
} elseif (!is_numeric($segmentos)) {
    print "  <p class=\"aviso\">No ha escrito el número de segmentos como número.</p>\n";
    print "\n";
} elseif (!ctype_digit($segmentos)) {
    print "  <p class=\"aviso\">No ha escrito el número de segmentos como número entero positivo.</p>\n";
    print "\n";
} elseif ($segmentos < $segmentosMinimo || $segmentos > $segmentosMaximo) {
    print "  <p class=\"aviso\">El número de segmentos debe estar entre $segmentosMinimo y $segmentosMaximo.</p>\n";
    print "\n";
} else {
    $segmentosOk = true;
}

if ($tamanoOk && $segmentosOk) {
    print "  <p>Tamaño: $tamano</p>\n";
    print "\n";
    print "  <p>Número de segmentos: $segmentos</p>\n";
    print "\n";

    print "  <pre>\n";
    for ($j = 1; $j <= $segmentos; $j++) {
        for ($i = 1; $i <= $tamano; $i++) {
            print "*";
        }
        for ($i = 1; $i <= $tamano; $i++) {
            print " ";
        }
    }
    print "\n";
    print "</pre>\n";
    print "\n";
}
?>
  <p><a href="for-2-2-1.php">Volver al formulario.</a></p>

  <footer>
    <p class="ultmod">
      Última modificación de esta página:
      <time datetime="2025-02-08">8 de febrero de 2025</time>
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
