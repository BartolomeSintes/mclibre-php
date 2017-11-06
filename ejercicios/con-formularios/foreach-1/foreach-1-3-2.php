<?php
/**
 * Encuesta (Resultado 1) - foreach-1-3-2.php
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
  <title>Encuesta (Resultado 1). foreach (1).
    Ejercicios. PHP. Bartolomé Sintes Marco</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="mclibre-php-soluciones.css" rel="stylesheet" type="text/css" title="Color" />
</head>

<body>
<h1>Encuesta (Resultado 1)</h1>

<?php
// Funciones auxiliares
function recoge($var)
{
    $tmp = (isset($_REQUEST[$var]))
        ? trim(htmlspecialchars($_REQUEST[$var], ENT_QUOTES, "UTF-8"))
        : "";
    return $tmp;
}

// Recogida de datos
$preguntas        = recoge("preguntas");
$respuestas       = recoge("respuestas");
$preguntasOk      = false;
$respuestasOk     = false;
$preguntasMinimo  = 1;
$respuestasMinimo = 2;
$numeroMaximo     = 10;


// Comprobación de $preguntas (entero entre 2 y 10)
if ($preguntas == "") {
    print "<p class=\"aviso\">No ha escrito el número de preguntas.</p>\n";
} elseif (!ctype_digit($preguntas)) {
    print "<p class=\"aviso\">No ha escrito el número de preguntas "
        . "como número entero positivo.</p>\n";
} elseif ($preguntas < $preguntasMinimo || $preguntas > $numeroMaximo) {
    print "<p class=\"aviso\">El número de preguntas debe estar entre "
        . "$preguntasMinimo y $numeroMaximo.</p>\n";
} else {
    $preguntasOk = true;
}

// Comprobación de $respuestas (entero entre 2 y 10)
if ($respuestas == "") {
    print "<p class=\"aviso\">No ha escrito el número de respuestas.</p>\n";
} elseif (!ctype_digit($respuestas)) {
    print "<p class=\"aviso\">No ha escrito el número de respuestas "
        . "como número entero positivo.</p>\n";
} elseif ($respuestas < $respuestasMinimo || $respuestas > $numeroMaximo) {
    print "<p class=\"aviso\">El número de respuestas debe estar entre "
        . "$respuestasMinimo y $numeroMaximo.</p>\n";
} else {
    $respuestasOk = true;
}

// Si los números recibidos son correctos ...
if ($preguntasOk && $respuestasOk) {
    print "<p>Valore de 1 a $respuestas cada uno de estos aspectos.</p>\n";
    print "\n";

    // Formulario que envía los datos a la página 3
    print "<form action=\"foreach-1-3-3.php\" method=\"get\">\n";
    print "  <table>\n";
    print "    <tbody>\n";
    print "      <tr>\n";
    print "        <th></th>\n";
    // Bucle para generar la primera fila, las celdas sólo contienen números
    for ($j = 1; $j <= $respuestas; $j++) {
        print "        <th>$j</th>\n";
    }
    print "      </tr>\n";
    // Bucle para generar las siguientes filas
    for ($i = 1; $i <= $preguntas; $i++) {
        print "      <tr>\n";
        // La primera celda contiene el número de pregunta
        print "        <th>Pregunta $i:</th>\n";
        // Bucle para generar las celdas con los botones radio
        for ($j = 1; $j <= $respuestas; $j++) {
            // El nombre del control es una matriz (e[])
            // En cada fila el name del control es el mismo (para que formen un botón radio)
            // pero el value va cambiando
            print "        <td><input type=\"radio\" name=\"b[$i]\" value=\"$j\" /></td>\n";
        }
        print "      </tr>\n";
    }
    print "    </tbody>\n";
    print "  </table>\n";
    print "\n";

    // Se añaden dos controles ocultos con los dos valores recibidos para que le lleguen a la página 3
    print "  <p><input type=\"hidden\" name=\"preguntas\" value=\"$preguntas\" />\n";
    print "    <input type=\"hidden\" name=\"respuestas\" value=\"$respuestas\" /></p>\n";
    print "\n";

    print "  <p><input type=\"submit\" value=\"Contar\" />\n";
    print "    <input type=\"reset\" value=\"Borrar\" /></p>\n";
    print "</form>\n";
}

?>

<p><a href="foreach-1-3-1.html">Volver al formulario.</a></p>

<footer>
  <p class="ultmod">
    Última modificación de esta página:
    <time datetime="2015-11-05">5 de noviembre de 2015</time></p>

      <p class="licencia">
        Este programa forma parte del curso <a href="http://www.mclibre.org/consultar/php/">
        Programación web en PHP</a> por <a href="http://www.mclibre.org/">Bartolomé
        Sintes Marco</a>.<br />
        El programa PHP que genera esta página está bajo
        <a rel="license" href="http://www.gnu.org/licenses/agpl.txt">licencia AGPL 3 o posterior</a>.</p>
    </footer>
  </body>
</html>
