<?php
/**
 * Encuesta (Resultado 2) - foreach-1-3-3.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2015 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2015-11-05
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
  <title>Encuesta (Resultado 2). foreach (1).
    Ejercicios. PHP. Bartolomé Sintes Marco</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" type="text/css" href="mclibre-php-ejercicios.css" title="Color" />
</head>

<body>
  <h1>Encuesta (Resultado 2)</h1>

<?php
// Funciones auxiliares
function recoge($var)
{
    $tmp = (isset($_REQUEST[$var]))
        ? trim(htmlspecialchars($_REQUEST[$var], ENT_QUOTES, "UTF-8"))
        : "";
    return $tmp;
}

function recogeMatriz($var)
{
    $tmpMatriz = [];
    if (isset($_REQUEST[$var]) && is_array($_REQUEST[$var])) {
        foreach ($_REQUEST[$var] as $indice => $valor) {
            $indiceLimpio = trim(htmlspecialchars($indice, ENT_QUOTES, "UTF-8"));
            $valorLimpio  = trim(htmlspecialchars($valor,  ENT_QUOTES, "UTF-8"));
            $tmpMatriz[$indiceLimpio] = $valorLimpio;
        }
    }
    return $tmpMatriz;
}

// Recogida de datos
$preguntas        = recoge("preguntas");
$respuestas       = recoge("respuestas");
$b                = recogeMatriz("b");
$preguntasOk      = false;
$respuestasOk     = false;
$bOk              = false;
$preguntasMinimo  = 1;
$respuestasMinimo = 2;
$numeroMaximo     = 10;

// Comprobación de $preguntas (entero entre 2 y 10)
if ($preguntas == "") {
    print "  <p class=\"aviso\">No ha escrito el número de preguntas.</p>\n";
} elseif (!ctype_digit($preguntas)) {
    print "  <p class=\"aviso\">No ha escrito el número de preguntas "
        . "como número entero positivo.</p>\n";
} elseif ($preguntas < $preguntasMinimo || $preguntas > $numeroMaximo) {
    print "  <p class=\"aviso\">El número de preguntas debe estar entre "
        . "$preguntasMinimo y $numeroMaximo.</p>\n";
} else {
    $preguntasOk = true;
}

// Comprobación de $respuestas (entero entre 2 y 10)
if ($respuestas == "") {
    print "  <p class=\"aviso\">No ha escrito el número de respuestas.</p>\n";
} elseif (!ctype_digit($respuestas)) {
    print "  <p class=\"aviso\">No ha escrito el número de respuestas "
        . "como número entero positivo.</p>\n";
} elseif ($respuestas < $respuestasMinimo || $respuestas > $numeroMaximo) {
    print "  <p class=\"aviso\">El número de respuestas debe estar entre "
        . "$respuestasMinimo y $numeroMaximo.</p>\n";
} else {
    $respuestasOk = true;
}

// Comprobación de $b (botones radio)
// Se cuenta el número de elementos en la matriz $b
$botonesRecibidos = count($b);
// Si no se ha recibido ningún botón
if ($botonesRecibidos == 0) {
    print "  <p>No se ha recibido ninguna respuesta.</p>\n";
    print "\n";
// Si se han recibido demasiados botones
} elseif ($botonesRecibidos > $preguntas) {
    print "  <p class=\"aviso\">Se han recibido demasiadas respuestas.</p>\n";
    print "\n";
} else {
    // Bucle para comprobar si todos los índices y valores son correctos
    $bOk = true;
    foreach ($b as $indice => $valor) {
        // Si el índice no es numérico (como es de tipo int hay que convertirlo a string antes)
        if (!ctype_digit((string)$indice)
            // o si el valor no es numérico
            || !ctype_digit($valor)
            // o si el índice está fuera de rango
            || $indice < 1 || $indice > $preguntas
            // o si el valor está fuera de rango
            || $valor < 1 || $valor > $respuestas) {
            $bOk = false;
        }
    }
    if (!$bOk) {
        print "  <p class=\"aviso\">Las respuestas recibidas no son correctas.</p>\n";
        print "\n";
    }
}

// Si el número de preguntas y respuestas recibido y los botones radio recibidos con correctos ...
if ($preguntasOk && $respuestasOk && $bOk) {
    if ($botonesRecibidos == 0) {
        print "  <p>No se ha contestado ninguna pregunta.</p>\n";
        print "\n";
    } else {
        print "  <p>Se han contestado $botonesRecibidos pregunta(s)";
        print " de un total de $preguntas.</p>\n";
        print "\n";

        print "  <ul>\n";
        // Bucle para escribir qué se ha contestado en cada pregunta
        foreach ($b as $indice => $valor) {
           print "    <li>En la pregunta $indice se ha contestado $valor</li>\n";
        }
        print "  </ul>\n";
        print "\n";
    }
}

// Enlace a la página 2 enviando el control numero con su valor para que pueda
// dibujar la tabla
if ($preguntasOk && $respuestasOk) {
    print "  <p><a href=\"foreach-1-3-2.php?preguntas=$preguntas&amp;respuestas=$respuestas\">Volver a la tabla</a></p>\n";
}

?>

  <p><a href="foreach-1-3-1.php">Volver al formulario inicial.</a></p>

  <footer>
    <p class="ultmod">
      Última modificación de esta página:
      <time datetime="2015-11-05">5 de noviembre de 2015</time>
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
