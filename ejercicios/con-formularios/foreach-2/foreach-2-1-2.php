<?php
/**
 * Tabla con casillas de verificación (Resultado 1) - foreach-2-1-2.php
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

print "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
       "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Tabla con casillas de verificación 2 (Resultado 1). foreach (2).
  Ejercicios. PHP. Bartolomé Sintes Marco</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="mclibre-php-soluciones.css" rel="stylesheet" type="text/css"
  title="Color" />
</head>
<body>

<h1>Tabla con casillas de verificación 2 (Resultado 1)</h1>
<?php
function recoge($var)
{
    $tmp = (isset($_REQUEST[$var]))
        ? trim(htmlspecialchars($_REQUEST[$var], ENT_QUOTES, "UTF-8"))
        : "";
    return $tmp;
}

$numero       = recoge("numero");
$numeroMinimo = 1;
$numeroMaximo = 20;
$numeroOk     = false;

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

if ($numeroOk) {
    print "<p>Marque las casillas de verificación que quiera y contaré cuántas ha marcado.</p>\n";
    print "<form action=\"foreach-2-1-3.php\" method=\"get\">\n";
    print "  <table border=\"1\">\n    <tbody>\n";
    for ($i = 1; $i <= $numero; $i++) {
        print "      <tr>\n";
        for ($j = 1; $j <= $numero; $j++) {
            print "        <td><input type=\"checkbox\" name=\"c[$i][$j]\" />$i$j</td>\n";
        }
        print "      </tr>\n";
    }
    print "    </tbody>\n  </table>\n  <p class=\"der\"><input type=\"submit\" "
        . "value=\"Contar\" />\n    <input type=\"reset\" value=\"Borrar\" "
        . " />\n    <input type=\"hidden\" name=\"numero\" value=\""
        . "$numero\" /></p>\n</form>\n";
}

?>

<p><a href="foreach-2-1-1.html">Volver al formulario.</a></p>

<p class="ultmod">Última modificación de esta página: 16 de octubre de 2014</p>

<p class="licencia">
Este programa forma parte del curso <a href="http://www.mclibre.org/consultar/php/">
<cite>Programación web en PHP</cite></a> por <cite>Bartolomé Sintes Marco</cite>.<br />
El programa PHP que genera esta página está bajo
<a rel="license" href="http://www.gnu.org/licenses/agpl.txt">licencia AGPL 3 o
posterior</a></p>
</body>
</html>
