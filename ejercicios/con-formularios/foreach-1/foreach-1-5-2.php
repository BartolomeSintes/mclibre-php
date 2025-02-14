<?php
/**
 * Tabla con casillas de verificación (Resultado 1) - foreach-1-5-2.php
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
    Tabla con casillas de verificación (Resultado 1).
    foreach (1).
    Ejercicios. PHP. Bartolomé Sintes Marco. www.mclibre.org
  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="mclibre-php-ejercicios.css" title="Color">
</head>

<body>
  <h1>Tabla con casillas de verificación (Resultado 1)</h1>

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
$numeroOk     = false;
$numeroMinimo = 1;
$numeroMaximo = 20;

// Comprobación de $numero (entero entre 1 y 20)
if ($numero == "") {
    print "  <p class=\"aviso\">No ha escrito el tamaño de la tabla.</p>\n";
    print "\n";
} elseif (!ctype_digit($numero)) {
    print "  <p class=\"aviso\">No ha escrito el tamaño de la tabla como número entero positivo.</p>\n";
    print "\n";
} elseif ($numero < $numeroMinimo || $numero > $numeroMaximo) {
    print "  <p class=\"aviso\">El tamaño de la tabla debe estar entre  $numeroMinimo y $numeroMaximo.</p>\n";
    print "\n";
} else {
    $numeroOk = true;
}

// Si el número recibido es correcto ...
if ($numeroOk) {
    print "  <p>Marque las casillas de verificación que quiera y contaré cuántas ha marcado.</p>\n";
    print "\n";

    // Formulario que envía los datos a la página 3
    print "  <form action=\"foreach-1-5-3.php\" method=\"get\">\n";
    print "    <table class=\"conborde\">\n";
    // Bucle anidado para generar la tabla cuadrada con casillas de verificación
    // Creamos un contador para generar el número de casilla
    $contador = 1;
    for ($i = 0; $i < $numero; $i++) {
        print "      <tr>\n";
        for ($j = 1; $j <= $numero; $j++) {
            // El nombre del control es una matriz (c[])
            print "        <td><label><input type=\"checkbox\" name=\"c[$contador]\"> $contador</label></td>\n";
            $contador++;
        }
        print "      </tr>\n";
    }
    print "    </table>\n";
    print "\n";

    // Se añade un control oculto con el número recibido para que le llegue a la página 3
    print "    <p><input type=\"hidden\" name=\"numero\" value=\"$numero\"></p>\n";
    print "\n";

    print "    <p>\n";
    print "      <input type=\"submit\" value=\"Contar\">\n";
    print "      <input type=\"reset\" value=\"Borrar\">\n";
    print "    </p>\n";
    print "  </form>\n";
    print "\n";
}
?>
  <p><a href="foreach-1-5-1.php">Volver al formulario.</a></p>

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
