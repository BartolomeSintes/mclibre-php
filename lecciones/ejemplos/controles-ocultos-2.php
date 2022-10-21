<?php
/**
 * Ejemplo de controles ocultos - controles-ocultos-2.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2014 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2014-10-21
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
    Controles ocultos (Formulario 2). Controles ocultos.
    Ejemplos. PHP. Bartolomé Sintes Marco. www.mclibre.org
  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="mclibre-php-ejercicios.css" title="Color">
</head>

<body>
  <h1>Controles ocultos (Formulario 2)</h1>

<?php
function recoge($var, $m = "")
{
    if (!isset($_REQUEST[$var])) {
        $tmp = is_array($m) ? [] : "";
    } elseif (!is_array($_REQUEST[$var])) {
        $tmp = trim(htmlspecialchars($_REQUEST[$var]));
    } else {
        $tmp = $_REQUEST[$var];
        array_walk_recursive($tmp, function (&$valor) {
            $valor = trim(htmlspecialchars($valor));
        });
    }
    return $tmp;
}

$nombre = recoge("nombre");

print "  <p>Su nombre es <strong>$nombre</strong>.</p>\n";
print "\n";
print "  <form action=\"controles-ocultos-3.php\" method=\"get\">\n";
print "    <p>Escriba sus apellidos:<input type=\"text\" name=\"apellidos\" size=\"30\" maxlength=\"20\"></p>\n";
print "\n";
print "    <p class=\"der\">\n";
print "      <input type=\"hidden\" name=\"nombre\" value=\"$nombre\">\n";
print "      <input type=\"submit\" value=\"Enviar\">\n";
print "      <input type=\"reset\" value=\"Borrar\">\n";
print "    </p>\n";
print "  </form>\n";

?>

  <p><a href="controles-ocultos-1.php">Volver al formulario anterior.</a></p>

  <footer>
    <p class="ultmod">
      Última modificación de esta página:
      <time datetime="2014-10-21">21 de octubre de 2014</time>
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
