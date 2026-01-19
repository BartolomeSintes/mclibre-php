<?php
/**
 * Encuesta (Formulario 2) - foreach-2-3-2.php
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

// Se accede a la sesión
session_name("cs-foreach-2-3");
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>
    Encuesta (Formulario 2).
    foreach (2). Sesiones.
    Ejercicios. PHP. Bartolomé Sintes Marco. www.mclibre.org
  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="mclibre-php-ejercicios.css" title="Color">
</head>

<body>
  <h1>Encuesta (Formulario 2)</h1>

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
$preguntas = recoge("preguntas");
// Si no se ha recogido preguntas pero hay preguntas en la sesión
// (es decir, si se viene de la tercera página)
// coge el número de la sesión
if (isset($_SESSION["preguntas"]) and $preguntas == "") {
    $preguntas = $_SESSION["preguntas"];
}
$respuestas = recoge("respuestas");
// Si no se ha recogido respuestas pero hay respuestas en la sesión
// (es decir, si se viene de la tercera página)
// coge el número de la sesión
if (isset($_SESSION["respuestas"]) and $respuestas == "") {
    $respuestas = $_SESSION["respuestas"];
}
$preguntasOk      = false;
$respuestasOk     = false;
$preguntasMinimo  = 1;
$respuestasMinimo = 2;
$numeroMaximo     = 10;

// Comprobación de $preguntas (entero entre 2 y 10)
if ($preguntas == "") {
    print "  <p class=\"aviso\">No ha escrito el número de preguntas.</p>\n";
    print "\n";
} elseif (!ctype_digit($preguntas)) {
    print "  <p class=\"aviso\">No ha escrito el número de preguntas como número entero positivo.</p>\n";
    print "\n";
} elseif ($preguntas < $preguntasMinimo || $preguntas > $numeroMaximo) {
    print "  <p class=\"aviso\">El número de preguntas debe estar entre $preguntasMinimo y $numeroMaximo.</p>\n";
    print "\n";
} else {
    $preguntasOk = true;
}

// Comprobación de $respuestas (entero entre 2 y 10)
if ($respuestas == "") {
    print "  <p class=\"aviso\">No ha escrito el número de respuestas.</p>\n";
    print "\n";
} elseif (!ctype_digit($respuestas)) {
    print "  <p class=\"aviso\">No ha escrito el número de respuestas como número entero positivo.</p>\n";
    print "\n";
} elseif ($respuestas < $respuestasMinimo || $respuestas > $numeroMaximo) {
    print "  <p class=\"aviso\">El número de respuestas debe estar entre $respuestasMinimo y $numeroMaximo.</p>\n";
    print "\n";
} else {
    $respuestasOk = true;
}

// Si los números recibidos son correctos ...
if ($preguntasOk && $respuestasOk) {
    // Guarda en la sesión el número de preguntas y respuestas
    $_SESSION["preguntas"]  = $preguntas;
    $_SESSION["respuestas"] = $respuestas;

    print "  <p>Valore de 1 a $respuestas cada uno de estos aspectos.</p>\n";
    print "\n";

    // Formulario que envía los datos a la página 3
    print "  <form action=\"foreach-2-3-3.php\" method=\"get\">\n";
    print "    <table>\n";
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
            print "        <td><input type=\"radio\" name=\"b[$i]\" value=\"$j\"></td>\n";
        }
        print "      </tr>\n";
    }
    print "    </table>\n";
    print "\n";
    print "    <p>\n";
    print "      <input type=\"submit\" value=\"Contar\">\n";
    print "      <input type=\"reset\" value=\"Borrar\">\n";
    print "    </p>\n";
    print "  </form>\n";
    print "\n";
}
?>
  <p><a href="foreach-2-3-1.php">Volver al formulario.</a></p>

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
