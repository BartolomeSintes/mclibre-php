<?php
/**
 * Cálculos estadísticos (Resultado 2) calculos-estadisticos-1-b.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2011 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2011-11-16
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
  <title>Cálculos estadísticos (Resultado 2). Repaso 1.
  Ejercicios. PHP. Bartolomé Sintes Marco</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="mclibre-php-soluciones.css" rel="stylesheet" type="text/css"
  title="Color" />
</head>
<body>

<h1>Cálculos estadísticos (Resultado 2)</h1>
<?php

function recoge($var)
{
    $tmp = (isset($_REQUEST[$var])) ? strip_tags(trim(htmlspecialchars($_REQUEST[$var], ENT_QUOTES, "UTF-8"))) : "";
    if (get_magic_quotes_gpc()) {
        $tmp = stripslashes($tmp);
    }
    return $tmp;
}

function recogeMatriz($var)
{
    $tmpMatriz = [];
    if (isset($_REQUEST[$var]) && is_array($_REQUEST[$var])) {
        foreach ($_REQUEST[$var] as $indice => $valor) {
            $tmp = strip_tags(trim(htmlspecialchars($indice, ENT_QUOTES, "UTF-8")));
            if (get_magic_quotes_gpc()) {
                $tmp = stripslashes($tmp);
            }
            $indiceLimpio = $tmp;

            $tmp = strip_tags(trim(htmlspecialchars($valor, ENT_QUOTES, "UTF-8")));
            if (get_magic_quotes_gpc()) {
                $tmp = stripslashes($tmp);
            }
            $valorLimpio  = $tmp;

            $tmpMatriz[$indiceLimpio] = $valorLimpio;
        }
    }
    return $tmpMatriz;
}

define('FORM_METHOD', 'get');
define('NUM_MINIMO',  1);
define('NUM_MAXIMO',  20);

$numeros          = recogeMatriz('n');
$numerosOk        = false;
$numerosRecibidos = count($numeros);
$suma             = (recoge('suma')=='on');
$media            = (recoge('media')=='on');
$maximo           = (recoge('maximo')=='on');
$minimo           = (recoge('minimo')=='on');

$numerosOk = true;
foreach ($numeros as $valor) {
    if (!is_numeric($valor)) {
        $numerosOk = false;
    }
}

if (!$numerosOk) {
    print "<p class=\"aviso\">Los datos recibidos no son correctos.</p>\n";
} elseif ($numerosRecibidos==0) {
    print "<p>No ha indicado ningún valor.</p>";
} elseif ($numerosRecibidos>NUM_MAXIMO) {
    print "<p class=\"aviso\">El número de valores debe estar entre "
        .NUM_MINIMO." y ".NUM_MAXIMO.".</p>\n";
} else {
    $sumaTotal = 0;
    print "<p>Ha introducido $numerosRecibidos valores: <strong>";
    foreach ($numeros as $valor) {
        print "$valor ";
        $sumaTotal += $valor;
    }
    print "</strong></p>\n";
    if ($suma) {
        print "<p>La suma de los valores es <strong>$sumaTotal</strong>.</p>\n";
    }
    if ($media) {
        print "<p>La media de los valores es <strong>"
             .round($sumaTotal/$numerosRecibidos, 2)."</strong>.</p>\n";
    }
    if ($maximo) {
        print "<p>El valor más grande es <strong>".max($numeros)."</strong>.</p>\n";
    }
    if ($minimo) {
        print "<p>El valor más pequeño es <strong>".min($numeros)."</strong>.</p>\n";
    }
}

print "<p><a href=\"calculos-estadisticos-1.html\">Volver al formulario inicial.</a></p>\n";
?>

<address>
  Esta página forma parte del curso "Páginas web con PHP" disponible en <a
  href="http://www.mclibre.org/">http://www.mclibre.org</a><br />
  Autor: Bartolomé Sintes Marco<br />
  Última modificación de esta página: 16 de noviembre de 2011
</address>
<p class="licencia">El programa PHP que genera esta página está bajo
<a rel="license" href="http://www.gnu.org/licenses/agpl.txt">licencia AGPL 3 o
posterior</a>.</p>
</body>
</html>
