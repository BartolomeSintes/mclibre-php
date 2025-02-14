<?php
/**
 * Palabras repetidas (Resultado 2) - foreach-1-2-3.php
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
    Palabras repetidas (Resultado 2).
    foreach (1).
    Ejercicios. PHP. Bartolomé Sintes Marco. www.mclibre.org
  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="mclibre-php-ejercicios.css" title="Color">
</head>

<body>
  <h1>Palabras repetidas (Resultado 2)</h1>

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
$numero       = recoge("numero");
$c            = recoge("c", []);
$numeroOk     = false;
$cOk          = false;
$numeroMinimo = 1;
$numeroMaximo = 10;

// Comprobación de $numero (entero entre 1 y 10)
if ($numero == "") {
    print "  <p class=\"aviso\">No se ha recibido el tamaño de la tabla.</p>\n";
    print "\n";
} elseif (!ctype_digit($numero)) {
    print "  <p class=\"aviso\">No se ha recibido el tamaño de la tabla como número entero positivo.</p>\n";
    print "\n";
} elseif ($numero < $numeroMinimo || $numero > $numeroMaximo) {
    print "  <p class=\"aviso\">El tamaño de la tabla debe estar entre $numeroMinimo y $numeroMaximo.</p>\n";
    print "\n";
} else {
    $numeroOk = true;
}

// Comprobación de $c (cajas de texto)
// Se cuenta el número de elementos en la matriz $c
$cajasRecibidas = count($c);
// Si no se han recibido todas las cajas
if ($cajasRecibidas != $numero) {
    print "  <p class=\"aviso\">La matriz recibida no es correcta.</p>\n";
    print "\n";
} else {
    // Bucle para comprobar si todos los índices y valores son correctos
    $cOk = true;
    foreach ($c as $indice => $valor) {
        // Si el índice no es numérico (como es de tipo int hay que convertirlo a string antes)
        if (!ctype_digit((string)$indice)
            // o si el índice está fuera de rango
            || $indice < 1 || $indice > $numero
            // o si el contenido no es vacío o todo letras
            || (!ctype_alpha($valor) && $valor != "")) {
            $cOk = false;
        }
    }
    if (!$cOk) {
        print "  <p class=\"aviso\">La matriz recibida no es correcta.</p>\n";
        print "\n";
    }
}

// Si el número recibido y las cajas de texto recibidas con correctos ...
if ($numeroOk && $cOk) {
    // Bucle para contar las cajas que no son vacías
    $cajasRellenas = 0;
    for ($i = 1; $i <= $numero; $i++) {
        if ($c[$i] != "") {
            $cajasRellenas++;
        }
    }
    print "  <p>Ha rellenado $cajasRellenas caja";
    if ($cajasRellenas != 1) {
        print "s";
    }
    print " de un total de $numero.</p>\n";
    print "\n";

    if ($cajasRellenas > 1) {
        // Bucle anidado para comprobar si hay repeticiones
        $repeticion = false;
        // Toma los valores de las cajas ...
        foreach ($c as $indice1 => $valor1) {
            // ... y los compara con todos los valores de las cajas
            foreach ($c as $indice2 => $valor2) {
                // Si los valores son iguales (pero distintos de la cadena vacía) hay repeticiones
                // pero como compara todos con todos también comparará cada elemento consigo mismo
                // así que hay que decirle que los índices sean distintos (para que
                // no tenga en cuenta el caso en que los valores son iguales porque
                // los índices también lo son)
                if ($valor1 == $valor2 && $valor1 != "" && $indice1 != $indice2) {
                    $repeticion = true;
                }
            }
        }
        if ($repeticion) {
            print "  <p>El texto de alguna caja está repetido.</p>\n";
            print "\n";
        } else {
            print "  <p>El texto de cada caja es diferente.</p>\n";
            print "\n";
        }
    }
}

// Enlace a la página 2 enviando el control numero con su valor para que pueda
// dibujar la tabla
if ($numeroOk) {
    print "  <p><a href=\"foreach-1-2-2.php?numero=$numero\">Volver a la tabla</a></p>\n";
    print "\n";
}
?>
  <p><a href="foreach-1-2-1.php">Volver al formulario inicial.</a></p>

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
