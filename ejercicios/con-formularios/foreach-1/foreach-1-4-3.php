<?php
/**
 * Hombres y mujeres (Resultado 2) - foreach-1-4-3.php
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
    Hombres y mujeres (Resultado 2).
    foreach (1).
    Ejercicios. PHP. Bartolomé Sintes Marco. www.mclibre.org
  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="mclibre-php-ejercicios.css" title="Color">
</head>

<body>
  <h1>Hombres y mujeres (Resultado 2)</h1>

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
$numero         = recoge("numero");
$c              = recoge("c", []);
$b              = recoge("b", []);
$numeroOk       = false;
$cOk            = false;
$bOk            = false;
$numeroMinimo   = 1;
$numeroMaximo   = 10;
$cajasRecibidas = 0;

// Comprobación de $numero (entero entre 2 y 10)
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
$cOk            = false;
// Si no se han recibido todas las cajas
if ($cajasRecibidas != $numero) {
    print "  <p class=\"aviso\">La matriz recibida no es correcta.</p>\n";
    print "\n";
} else {
    // Bucle para comprobar si todos los índices y valores son correctos
    $cOk = true;
    foreach ($c as $indice => $valor) {
        if (
            // Si el índice no es numérico (como es de tipo int hay que convertirlo a string antes)
            !ctype_digit((string)$indice)
            // o si el índice está fuera de rango
            || $indice < 1 || $indice > $numero
            // o si el contenido no es vacío o todo letras
            || (!ctype_alpha($valor) && $valor != "")
        ) {
            $cOk = false;
        }
    }
    if (!$cOk) {
        print "  <p class=\"aviso\">La matriz de nombres recibida no es correcta.</p>\n";
        print "\n";
    }
}

// Comprobación de $b (botones radio)
// Se cuenta el número de elementos en la matriz $b
$botonesRecibidos = count($b);
// Si no se ha recibido ningún botón
if ($botonesRecibidos == 0) {
    print "  <p>No se ha recibido ningún valor hombre/mujer.</p>\n";
    print "\n";
// Si se han recibido demasiados botones
} elseif ($botonesRecibidos > $numero) {
    print "  <p class=\"aviso\">La matriz de hombre/mujer recibida es demasiado grande.</p>\n";
    print "\n";
} else {
    $bOk = true;
    foreach ($b as $indice => $valor) {
        if (
            // Si el índice no es numérico (como es de tipo int hay que convertirlo a string antes)
            !ctype_digit((string)$indice)
            // o si el índice está fuera de rango
            || $indice < 1 || $indice > $numero
            // o si el valor no es "m" o "h"
            || ($valor != "h" && $valor != "m")
        ) {
            $bOk = false;
        }
    }
    if (!$bOk) {
        print "  <p class=\"aviso\">La matriz de hombre/mujer recibida no es correcta.</p>\n";
        print "\n";
    }
}

// Si el número, las cajas de texto y los botones radio recibidos con correctos ...
if ($numeroOk && $cOk && $bOk) {
    // Se cuentan los datos completos y el número de hombres y mujeres
    $datosCompletos = 0;
    $datosHombres   = 0;
    $datosMujeres   = 0;

    // Bucle para recorrer la matriz $b (botones radio)
    foreach ($b as $indice => $valor) {
        // Si además hay una palabra en la caja de texto
        if ($c[$indice] != "") {
            $datosCompletos++;
            if ($valor == "h") {
                $datosHombres++;
            } elseif ($valor == "m") {
                $datosMujeres++;
            }
        }
    }

    if ($datosCompletos == 0) {
        print "  <p>No se ha recibido ningún dato completo</p>\n";
        print "\n";
    } else {
        print "  <p>Se han recibido $datosCompletos dato(s) completo(s) de un total de $numero.</p>\n";
        print "\n";

        print "  <ul>\n";
        print "    <li>$datosHombres hombre(s): ";
        // Bucle para escribir los datos de los hombres
        foreach ($b as $indice => $valor) {
            if ($valor == "h" && $c[$indice] != "") {
                print "$c[$indice], ";
            }
        }
        print "</li>\n";
        print "    <li>$datosMujeres mujer(es): ";
        // Bucle para escribir los datos de las mujeres
        foreach ($b as $indice => $valor) {
            if ($valor == "m" && $c[$indice] != "") {
                print "$c[$indice], ";
            }
        }
        print "</li>\n";
        print "  </ul>\n";
        print "\n";
    }
}

// Enlace a la página 2 enviando los controles $preguntas y $respuestasel con
// su valor para que pueda dibujar la tabla
if ($numeroOk) {
    print "  <p><a href=\"foreach-1-4-2.php?numero=$numero\">Volver a la tabla</a></p>\n";
    print "\n";
}
?>
  <p><a href="foreach-1-4-1.php">Volver al formulario inicial.</a></p>

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
