<?php
/**
 * Sucesiones aritméticas 5 (Resultado) - for-4-5-2.php
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
    Sucesiones aritméticas 5 (Resultado). for (4).
    Ejercicios. PHP. Bartolomé Sintes Marco. www.mclibre.org
  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="mclibre-php-ejercicios.css" title="Color">
</head>

<body>
  <h1>Sucesiones aritméticas 5 (Resultado)</h1>

<?php
function recoge($var, $m = "")
{
    $tmp = is_array($m) ? [] : "";
    if (isset($_REQUEST[$var])) {
        if (!is_array($_REQUEST[$var]) && !is_array($m)) {
            $tmp = trim(htmlspecialchars($_REQUEST[$var]));
        } elseif (is_array($_REQUEST[$var]) && is_array($m)) {
            $tmp = $_REQUEST[$var];
            array_walk_recursive($tmp, function (&$valor) {
                $valor = trim(htmlspecialchars($valor));
            });
        }
    }
    return $tmp;
}

$inicial    = recoge("inicial");
$final      = recoge("final");
$incremento = recoge("incremento");
$valores    = recoge("valores");

$inicialOk = $finalOk = $incrementoOk = $valoresOk = false;

// Comprobación de los valores recibidos.
// Los campos pueden recibirse vacíos

if ($inicial == "") {
    $inicialOk = true;
} elseif (!is_numeric($inicial)) {
    print "  <p class=\"aviso\">No ha escrito el valor inicial como número.</p>\n";
    print "\n";
} else {
    $inicialOk = true;
}

if ($final == "") {
    $finalOk = true;
} elseif (!is_numeric($final)) {
    print "  <p class=\"aviso\">No ha escrito el valor final como número.</p>\n";
    print "\n";
} else {
    $finalOk = true;
}

if ($incremento == "") {
    $incrementoOk = true;
} elseif (!is_numeric($incremento)) {
    print "  <p class=\"aviso\">No ha escrito el incremento como número.</p>\n";
    print "\n";
} else {
    $incrementoOk = true;
}

if ($valores == "") {
    $valoresOk = true;
} elseif (!is_numeric($valores)) {
    print "  <p class=\"aviso\">No ha escrito el número de valores como número.</p>\n";
    print "\n";
} elseif (!ctype_digit($valores)) {
    print "  <p class=\"aviso\">No ha escrito el número de valores "
        . "como número entero positivo.</p>\n";
    print "\n";
} elseif ($valores < 2) {
    print "  <p class=\"aviso\">Como mínimo debe solicitar dos valores.</p>\n";
    print "\n";
} else {
    $valoresOk = true;
}

// Comprobación de que se han recibido exactamente tres de los cuatro valores

$recibidos   = 0;
$recibidosOk = false;

if ($inicial != "") {
    $recibidos++;
}
if ($final != "") {
    $recibidos++;
}
if ($incremento != "") {
    $recibidos++;
}
if ($valores != "") {
    $recibidos++;
}

if ($recibidos != 3) {
    print "  <p class=\"aviso\">Debe indicar tres de los cuatro valores. Se han recibido $recibidos valores.</p>\n";
    print "\n";
} else {
    $recibidosOk = true;
}

if ($recibidosOk && $inicialOk && $finalOk && $incrementoOk && $valoresOk) {
    $escribeSolucion = true;

    if ($inicial == "") {
        $inicial = $final - $incremento * ($valores - 1);
    } elseif ($final == "") {
        $final = $inicial + $incremento * ($valores - 1);
    } elseif ($incremento == "") {
        $incremento = ($final - $inicial) / ($valores - 1);
    } elseif ($valores == "") {
        if ($incremento == 0) {
            if ($inicial == $final) {
                print "  <p>La sucesión constante en la que todos los términos son $inicial cumple las condiciones indicadas.</p>\n";
            } else {
                print "  <p class=\"aviso\">No es posible construir una sucesión con los valores indicados.</p>\n";
            }
        } else {
            $valores = 1 + ($final - $inicial) / $incremento;
            if ($valores != round($valores) || $valores < 2) {
                print "  <p class=\"aviso\">No es posible construir una sucesión con los valores indicados.</p>\n";
            } else {
                $escribeSolucion = true;
            }
        }
        print "\n";
    }

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
  <p><a href="for-4-5-1.php">Volver al formulario.</a></p>

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
