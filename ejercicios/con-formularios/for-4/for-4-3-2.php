<?php
/**
 * Sucesiones aritméticas 3 (Resultado) - for-4-3-2.php
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
    Sucesiones aritméticas 3 (Resultado). for (4).
    Ejercicios. PHP. Bartolomé Sintes Marco. www.mclibre.org
  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="mclibre-php-ejercicios.css" title="Color">
</head>

<body>
  <h1>Sucesiones aritméticas 3 (Resultado)</h1>

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

$inicial = recoge("inicial");
$final   = recoge("final");
$valores = recoge("valores");

$inicialOk = $finalOk = $valoresOk = false;

// Comprobación habitual de los valores recibidos
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

if ($valores == "") {
    print "  <p class=\"aviso\">No ha escrito el número de valores.</p>\n";
    print "\n";
} elseif (!is_numeric($valores)) {
    print "  <p class=\"aviso\">No ha escrito el número de valores como número.</p>\n";
    print "\n";
} elseif (!ctype_digit($valores)) {
    print "  <p class=\"aviso\">No ha escrito el número de valores como número entero positivo.</p>\n";
    print "\n";
} elseif ($valores < 2) {
    print "  <p class=\"aviso\">Como mínimo debe solicitar dos valores.</p>\n";
    print "\n";
} else {
    $valoresOk = true;
}

if ($inicialOk && $finalOk && $valoresOk) {
    $incremento = ($final - $inicial) / ($valores - 1);

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
?>
  <p><a href="for-4-3-1.php">Volver al formulario.</a></p>

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
