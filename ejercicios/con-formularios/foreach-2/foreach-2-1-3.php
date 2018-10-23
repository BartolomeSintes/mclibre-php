<?php
/**
 * Tabla con casillas de verificación (Resultado 2) - foreach-2-1-3.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2014 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2014-10-16
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
  <title>Tabla con casillas de verificación 2 (Resultado 2). foreach (2).
    Ejercicios. Programación web en PHP. Bartolomé Sintes Marco. www.mclibre.org
  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" type="text/css" href="mclibre-php-ejercicios.css" title="Color" />
</head>

<body>

  <h1>Tabla con casillas de verificación 2 (Resultado 2)</h1>

<?php
function recoge($var)
{
    $tmp = (isset($_REQUEST[$var]))
        ? trim(htmlspecialchars($_REQUEST[$var], ENT_QUOTES, "UTF-8"))
        : "";
    return $tmp;
}

function recogeMatriz2($var)
{
    $tmpMatriz = [];
    if (isset($_REQUEST[$var]) && is_array($_REQUEST[$var])) {
        foreach ($_REQUEST[$var] as $indice => $fila) {
            $indiceLimpio = trim(htmlspecialchars($indice, ENT_QUOTES, "UTF-8"));
            if (is_array($fila)) {
                foreach ($fila as $indice2 => $valor) {
                    $indice2Limpio = trim(htmlspecialchars($indice2, ENT_QUOTES, "UTF-8"));
                    $valorLimpio   = trim(htmlspecialchars($valor,   ENT_QUOTES, "UTF-8"));
                    $tmpMatriz[$indiceLimpio][$indice2Limpio] = $valorLimpio;
                }
            }
        }
    }
    return $tmpMatriz;
}

$numero           = recoge("numero");
$casillas         = recogeMatriz2("c");
$casillaValor     = "on";
$numeroMinimo     = 1;
$numeroMaximo     = 20;
$numeroOk         = $casillasOk = false;
$casillasMarcadas = count($casillas, COUNT_RECURSIVE) - count($casillas);

if ($numero == "") {
    print "  <p class=\"aviso\">No se ha recibido el tamaño de la tabla.</p>\n";
} elseif (!ctype_digit($numero)) {
    print "  <p class=\"aviso\">No se ha recibido el tamaño de la tabla "
        . "como número entero positivo.</p>\n";
} elseif ($numero < $numeroMinimo || $numero > $numeroMaximo) {
    print "  <p class=\"aviso\">El tamaño de la tabla debe estar entre "
        . "$numeroMinimo y $numeroMaximo.</p>\n";
} else {
    $numeroOk = true;
}

if ($casillasMarcadas == 0) {
    print "  <p>No ha marcado ninguna casilla.</p>";
} elseif ($casillasMarcadas > $numero * $numero) {
        print "  <p class=\"aviso\">La matriz recibida es demasiado grande.</p>\n";
} else {
    $casillasOk = true;
    foreach ($casillas as $indice => $fila) {
        if (ctype_digit((string)$indice) && $indice <= $numero && is_array($fila)) {
            foreach ($fila as $indice2 => $valor2) {
                if (!ctype_digit((string)$indice2) || $indice2 > $numero
                    || $valor2 != $casillaValor) {
                    $casillasOk = false;
                }
            }
        } else {
            $casillasOk = false;
        }
    }
    if (!$casillasOk) {
        print "  <p class=\"aviso\">La matriz recibida no es correcta.</p>\n";
    }
}

if ($numeroOk && $casillasOk) {
    print "  <p>Ha marcado $casillasMarcadas casilla";
    if ($casillasMarcadas > 1) {
        print "s";
    }
    print " de un total de " . ($numero * $numero) . ":</p>\n";
    print "\n";
    print "  <ul>\n";
    foreach ($casillas as $indice => $fila) {
        foreach ($fila as $indice2 => $valor) {
           print "    <li>fila $indice - columna $indice2</li>\n";
        }
    }
    print "  </ul>\n";
    print "\n";
}

if ($numeroOk) {
    print "  <p><a href=\"foreach-2-1-2.php?numero=$numero\">Volver a la tabla</a></p>\n";
}
?>

  <p><a href="foreach-2-1-1.php">Volver al formulario inicial.</a></p>

  <footer>
    <p class="ultmod">
      Última modificación de esta página:
      <time datetime="2014-10-16">16 de octubre de 2014</time>
    </p>

    <p class="licencia">
      Este programa forma parte del curso <strong><a href="http://www.mclibre.org/consultar/php/">Programación
      web en PHP</a></strong> de <a href="http://www.mclibre.org/" rel="author" >Bartolomé Sintes Marco</a>.<br />
      El programa PHP que genera esta página se distribuye bajo
      <a rel="license" href="http://www.gnu.org/licenses/agpl.txt">licencia AGPL 3 o posterior</a>.
    </p>
  </footer>
</body>
</html>
