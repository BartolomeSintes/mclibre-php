<?php
/**
 * Rmbo de estrellas - rombo_estrellas.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2014 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2014-11-04
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
  <title>Rombo de estrellas (Resultado). Repaso (1).
  Ejercicios. PHP. Bartolomé Sintes Marco</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="mclibre_php_soluciones.css" rel="stylesheet" type="text/css"
  title="Color" />
</head>
<body>

<h1>Rombo de estrellas (Resultado)</h1>

<?php
function recoge($var)
{
    $tmp = (isset($_REQUEST[$var]))
    ? trim(htmlspecialchars($_REQUEST[$var], ENT_QUOTES, "UTF-8"))
    : "";
    return $tmp;
}

$alto        = recoge("alto");
$valorMinimo = 1;
$valorMaximo = 30;
$altoOk      = false;

if ($alto=="") {
    print "<p class=\"aviso\">No ha escrito la altura.</p>\n";
} elseif (!ctype_digit($alto)) {
    print "<p class=\"aviso\">No ha escrito la altura "
        ."como número entero positivo.</p>\n";
} elseif ($alto < $valorMinimo || $alto > $valorMaximo) {
    print "<p class=\"aviso\">La altura debe estar entre $valorMinimo y $valorMaximo.</p>\n";
} else {
    $altoOk = true;
}

if ($altoOk) {
    print "<p>Alto: $alto</p>";

    print "<pre>";
    for ($i = 1; $i <= $alto; $i++) {
        for ($j = 1; $j < $i; $j++) {
            print "  ";
        }
        for ($j = 1; $j <= $alto; $j++) {
            print "* ";
        }
        print "\n";
    }
    print "</pre>\n";
}

?>

<p><a href="rombo_estrellas.html">Volver al formulario.</a></p>

<p class="ultmod">Última modificación de esta página: 4 de noviembre de 2014</p>

<p class="licencia">
Este programa forma parte del curso <a href="http://www.mclibre.org/consultar/php/">
<cite>Programación web en PHP</cite></a> por <cite>Bartolomé Sintes Marco</cite>.<br />
El programa PHP que genera esta página está bajo
<a rel="license" href="http://www.gnu.org/licenses/agpl.txt">licencia AGPL 3 o
posterior</a></p>
</body>
</html>
