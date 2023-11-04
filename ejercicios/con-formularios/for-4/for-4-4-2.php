<?php
/**
 * Sucesiones aritméticas 4 (Resultado) - for-4-4-2.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2022 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2022-10-10
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
    Sucesiones aritméticas 4 (Resultado). for (4).
    Ejercicios. PHP. Bartolomé Sintes Marco. www.mclibre.org
  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="mclibre-php-ejercicios.css" title="Color">
</head>

<body>
  <h1>Sucesiones aritméticas 4 (Resultado)</h1>

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

$inicial    = recoge("inicial");
$final      = recoge("final");
$incremento = recoge("incremento");

$inicialOk = $finalOk = $incrementoOk = false;

if ($inicial == "") {
    print "  <p class=\"aviso\">No ha escrito el valor inicial.</p>\n";
    print "\n";
} elseif (!is_numeric($inicial)) {
    print "  <p class=\"aviso\">No ha escrito el valor inicial como número.</p>\n";
    print "\n";
} else {
    $inicialOk = true;
}

if ($final == "") {
    print "  <p class=\"aviso\">No ha escrito el valor final.</p>\n";
    print "\n";
} elseif (!is_numeric($final)) {
    print "  <p class=\"aviso\">No ha escrito el valor final como número.</p>\n";
    print "\n";
} else {
    $finalOk = true;
}

if ($incremento == "") {
    print "  <p class=\"aviso\">No ha escrito el incremento.</p>\n";
    print "\n";
} elseif (!is_numeric($incremento)) {
    print "  <p class=\"aviso\">No ha escrito el incremento como número.</p>\n";
    print "\n";
} else {
    $incrementoOk = true;
}

if ($inicialOk && $finalOk && $incrementoOk) {
    $escribeSolucion = false;
    if ($incremento == 0) {
        if ($inicial == $final) {
            print "  <p>La sucesión constante en la que todos los términos son $inicial cumple las condiciones indicadas.</p>\n";
        } else {
            print "  <p class=\"aviso\">No es posible construir una sucesión con los valores indicados.</p>\n";
        }
    } else {
        $valores = ($final - $inicial) / $incremento + 1;
        if ($valores != round($valores) || $valores < 2) {
            print "  <p class=\"aviso\">No es posible construir una sucesión con los valores indicados.</p>\n";
        } else {
            $escribeSolucion = true;
        }
    }
    print "\n";

    if ($escribeSolucion) {
        print "  <p>Datos:</p>\n";
        print "\n";
        print "  <ul>\n";
        print "    <li>Valor inicial: $inicial</li>\n";
        print "    <li>Valor final: $final</li>\n";
        print "    <li>Incremento: $incremento</li>\n";
        print "    <li>Número de términos: $valores</li>\n";
        print "  </ul>\n";
        print "\n";
        print "  <p>Términos de la sucesión:</p>\n";
        print "\n";
        print "  <ol>\n";
        for ($i = 0; $i < $valores; $i++) {
            print "    <li>" . $inicial + $incremento * $i . "</li>\n";
        }
        print "  </ol>\n";
        print "\n";
    }
}

?>
  <p><a href="for-4-4-1.php">Volver al formulario.</a></p>

  <footer>
    <p class="ultmod">
      Última modificación de esta página:
      <time datetime="2022-10-10">10 de octubre de 2022</time>
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
