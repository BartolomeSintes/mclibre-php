<?php
/**
 * Tabla con casillas de verificación (Resultado 1) - foreach-1-1-2.php
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
  <title>Tabla de una fila con casillas de verificación (Resultado 1). foreach (1).
    Ejercicios. PHP. Bartolomé Sintes Marco</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="mclibre-php-soluciones.css" rel="stylesheet" type="text/css" title="Color" />
</head>

<body>
<h1>Tabla de una fila con casillas de verificación (Resultado 1)</h1>

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
$numero       = recoge("numero");
$numeroOk     = false;
$numeroMinimo = 1;
$numeroMaximo = 20;

// Comprobación de $numero (entero entre 1 y 20)
if ($numero == "") {
    print "<p class=\"aviso\">No ha escrito el tamaño de la tabla.</p>\n";
} elseif (!ctype_digit($numero)) {
    print "<p class=\"aviso\">No ha escrito el tamaño de la tabla "
        . "como número entero positivo.</p>\n";
} elseif ($numero < $numeroMinimo || $numero > $numeroMaximo) {
    print "<p class=\"aviso\">El tamaño de la tabla debe estar entre "
        . "$numeroMinimo y $numeroMaximo.</p>\n";
} else {
    $numeroOk = true;
}

// Si el número recibido es correcto ...
if ($numeroOk) {
    print "<p>Marque las casillas de verificación que quiera y contaré cuántas ha marcado.</p>\n";
    print "\n";

    // Formulario que envía los datos a la página 3
    print "<form action=\"foreach-1-1-3.php\" method=\"get\">\n";
    print "  <table class=\"conborde\">\n";
    print "    <tbody>\n";
    print "      <tr>\n";
    // Bucle para generar las casillas de verificación
    for ($i = 1; $i <= $numero; $i++) {
        // El nombre del control es una matriz (c[])
        print "        <td><label><input type=\"checkbox\" name=\"c[$i]\" /> $i</label></td>\n";
    }
    print "      </tr>\n";
    print "    </tbody>\n";
    print "  </table>\n";
    print "\n";

    // Se añade un control oculto con el número recibido para que le llegue a la página 3
    print "  <p><input type=\"hidden\" name=\"numero\" value=\"$numero\" /></p>\n";
    print "\n";

    print "  <p><input type=\"submit\" value=\"Contar\" />\n";
    print "    <input type=\"reset\" value=\"Borrar\" /></p>\n";
    print "</form>\n";
}

?>

<p><a href="foreach-1-1-1.html">Volver al formulario.</a></p>

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
