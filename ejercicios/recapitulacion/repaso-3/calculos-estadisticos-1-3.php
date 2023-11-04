<?php
/**
 * Cálculos estadísticos (Resultado 2) calculos-estadisticos-1-3.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2011 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2011-11-16
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
    Cálculos estadísticos (Resultado 2). Repaso 3.
    Ejercicios. PHP. Bartolomé Sintes Marco. www.mclibre.org
  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="mclibre-php-ejercicios.css" title="Color">
</head>

<body>
  <h1>Cálculos estadísticos (Resultado 2)</h1>

<?php
// Función de recogida de datos
function recoge($key, $type = "")
{
    if ($type != "" && $type != []) {
        trigger_error("Function recoge(): argument #2 (\$type) must be an empty array or an empty string.", E_USER_ERROR);
    }
    $tmp = is_array($type) ? [] : "";
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

define("FORM_METHOD", "get");
define("NUM_MINIMO",  1);
define("NUM_MAXIMO",  20);

$numeros          = recoge("n", []);
$numerosOk        = false;
$numerosRecibidos = count($numeros);
$suma             = (recoge("suma") == "on");
$media            = (recoge("media") == "on");
$maximo           = (recoge("maximo") == "on");
$minimo           = (recoge("minimo") == "on");

$numerosOk = true;
foreach ($numeros as $valor) {
    if (!is_numeric($valor)) {
        $numerosOk = false;
    }
}

if (!$numerosOk) {
    print "  <p class=\"aviso\">Los datos recibidos no son correctos.</p>\n";
    print "\n";
} elseif ($numerosRecibidos == 0) {
    print "  <p>No ha indicado ningún valor.</p>";
    print "\n";
} elseif ($numerosRecibidos>NUM_MAXIMO) {
    print "  <p class=\"aviso\">El número de valores debe estar entre "
        . NUM_MINIMO . " y " . NUM_MAXIMO . ".</p>\n";
    print "\n";
} else {
    $sumaTotal = 0;
    print "  <p>Ha introducido $numerosRecibidos valores: <strong>";
    foreach ($numeros as $valor) {
        print "$valor ";
        $sumaTotal += $valor;
    }
    print "</strong></p>\n";
    print "\n";
    if ($suma) {
        print "  <p>La suma de los valores es <strong>$sumaTotal</strong>.</p>\n";
        print "\n";
    }
    if ($media) {
        print "  <p>La media de los valores es <strong>"
            . round($sumaTotal / $numerosRecibidos, 2) . "</strong>.</p>\n";
        print "\n";
    }
    if ($maximo) {
        print "  <p>El valor más grande es <strong>" . max($numeros) . "</strong>.</p>\n";
        print "\n";
    }
    if ($minimo) {
        print "  <p>El valor más pequeño es <strong>" . min($numeros) . "</strong>.</p>\n";
        print "\n";
    }
}
?>
  <p><a href="calculos-estadisticos-1-1.php">Volver al formulario inicial.</a></p>

  <footer>
    <p class="ultmod">
      Última modificación de esta página:
      <time datetime="2011-11-16">16 de noviembre de 2011</time>
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
