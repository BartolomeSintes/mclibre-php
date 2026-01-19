<?php
/**
 * Contador de días (Resultado 2) - contador-dias-3.php
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
    Contador de días (Resultado 2). Repaso (1).
    Ejercicios. PHP. Bartolomé Sintes Marco. www.mclibre.org
  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="mclibre-php-ejercicios.css" title="Color">
</head>

<body>
  <h1>Contador de días (Resultado 2)</h1>

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

// Recogida de datos
$numero           = recoge("numero");
$casillas         = recoge("c", []);
$numeroOk         = false;
$casillasOk       = false;
$casillasMarcadas = count($casillas, COUNT_RECURSIVE) - count($casillas);
$minimo           = 1;
$maximo           = 20;
$valorCasilla     = "on";

// Comprobación de $numero
if ($numero == "") {
    print "  <p class=\"aviso\">No se ha recibido el número de semanas.</p>\n";
    print "\n";
} elseif (!is_numeric($numero)) {
    print "  <p class=\"aviso\">No se ha recibido el número de semanas como número.</p>\n";
    print "\n";
} elseif (!ctype_digit($numero)) {
    print "  <p class=\"aviso\">No se ha recibido el número de semanas como número entero positivo.</p>\n";
    print "\n";
} elseif ($numero < $minimo || $numero > $maximo) {
    print "  <p class=\"aviso\">El número de semanas debe estar entre $minimo y $maximo.</p>\n";
    print "\n";
} else {
    $numeroOk = true;
}

// Comprobación de $casillas
// Comprueba $numeroOk por si se manipula la URL borrando numero
if ($numeroOk) {
    if ($casillasMarcadas == 0) {
        print "  <p>No ha marcado ninguna casilla.</p>\n";
        print "\n";
    } elseif ($casillasMarcadas > 7 * $numero) {
        print "  <p class=\"aviso\">La matriz recibida es demasiado grande.</p>\n";
        print "\n";
    } else {
        $casillasOk = true;
        foreach ($casillas as $indice => $valor) {
            if (ctype_digit((string)$indice) && $indice <= $numero && is_array($valor)) {
                foreach ($valor as $indice2 => $valor2) {
                    if (!ctype_digit((string)$indice2) || $indice2 > 7 || $valor2 != $valorCasilla) {
                        $casillasOk = false;
                    }
                }
            } else {
                $casillasOk = false;
            }
        }
        if (!$casillasOk) {
            print "  <p class=\"aviso\">La matriz recibida no es correcta.</p>\n";
            print "\n";
        }
    }
}

if ($numeroOk && $casillasOk) {
    print "  <p>En total ha marcado $casillasMarcadas días:</p>\n";
    print "\n";
    print "  <ul>\n";
    for ($i = 1; $i <= $numero; $i++) {
        if (!isset($casillas[$i])) {
            print "    <li>En la semana $i no ha marcado ninguna día.</li>\n";
        } else {
            print "    <li>En la semana $i ha marcado <strong>" . count($casillas[$i]) . "</strong> día";
            if (count($casillas[$i]) > 1) {
                print "s";
            }
            print "</li>\n";
        }
    }
    print "  </ul>\n";
    print "\n";
    print "  <p><a href=\"contador-dias-2.php?numero=$numero\">Volver al calendario</a></p>\n";
    print "\n";
}
?>
  <p><a href="contador-dias-1.php">Volver al formulario inicial.</a></p>

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
