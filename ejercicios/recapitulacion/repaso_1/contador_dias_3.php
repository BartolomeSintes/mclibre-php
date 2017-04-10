<?php
/**
 * Contador de días (Resultado 2) - contador_dias_3.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2015 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2015-11-18
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
  <title>Contador de días (Resultado 2). Repaso (1).
  Ejercicios. PHP. Bartolomé Sintes Marco</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="mclibre_php_soluciones.css" rel="stylesheet" type="text/css" title="Color" />
</head>

<body>
<h1>Contador de días (Resultado 2)</h1>

<?php
// Funciones auxiliares
function recoge($var)
{
    $tmp = (isset($_REQUEST[$var]))
    ? trim(htmlspecialchars($_REQUEST[$var], ENT_QUOTES, "UTF-8"))
    : "";
    return $tmp;
}

function recogeMatriz2($var)
{
    $tmpMatriz = array();
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

// Recogida de datos
$numero           = recoge("numero");
$casillas         = recogeMatriz2("c");
$numeroOk         = $casillasOk = false;

$casillasMarcadas = count($casillas, COUNT_RECURSIVE) - count($casillas);
$minimo           = 1;
$maximo           = 20;
$valorCasilla     = "on";

// Comprobación de $numero
if ($numero=="") {
    print "<p class=\"aviso\">No se ha recibido el número de semanas.</p>\n";
} elseif (!is_numeric($numero)) {
    print "<p class=\"aviso\">No se ha recibido el número de semanas "
         ."como número.</p>\n";
} elseif (!ctype_digit($numero)) {
    print "<p class=\"aviso\">No se ha recibido el número de semanas "
         ."como número entero positivo.</p>\n";
} elseif ($numero < $minimo || $numero > $maximo) {
    print "<p class=\"aviso\">El número de semanas debe estar entre $minimo "
        . "y $maximo.</p>\n";
} else {
    $numeroOk = true;
}

// Comprobación de $casillas
if ($casillasMarcadas == 0) {
    print "<p>No ha marcado ninguna casilla.</p>\n\n";
} elseif ($casillasMarcadas > 7 * $numero) {
    print "<p class=\"aviso\">La matriz recibida es demasiado grande.</p>\n\n";
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
        print "<p class=\"aviso\">La matriz recibida no es correcta.</p>\n\n";
    }
}

if ($numeroOk && $casillasOk) {
    print "<p>En total ha marcado $casillasMarcadas días:</p>\n\n";
    print "<ul>\n";
    for ($i = 1; $i <= $numero; $i++) {
        if (!isset($casillas[$i])) {
            print "  <li>En la semana $i no ha marcado ninguna día.</li>\n";
        } else {
            print "  <li>En la semana $i ha marcado <strong>"
                . count($casillas[$i]) . "</strong> día";
            if (count($casillas[$i])>1) {
                print "s";
            }
            print "</li>\n";
        }
    }
    print "</ul>\n\n";
    print "<p><a href=\"contador_dias_2.php?numero=$numero\">Volver al calendario</a></p>\n";
}

?>

<p><a href="contador_dias_1.html">Volver al formulario inicial.</a></p>

<footer>
  <p class="ultmod">
    Última modificación de esta página:
    <time datetime="2015-11-18">18 de noviembre de 2015</time></p>

      <p class="licencia">
        Este programa forma parte del curso <a href="http://www.mclibre.org/consultar/php/">
        Programación web en PHP</a> por <a href="http://www.mclibre.org/">Bartolomé
        Sintes Marco</a>.<br />
        El programa PHP que genera esta página está bajo
        <a rel="license" href="http://www.gnu.org/licenses/agpl.txt">licencia AGPL 3 o posterior</a>.</p>
    </footer>
  </body>
</html>
