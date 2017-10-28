<?php
/**
 * Convertidor de divisas 3 - convertidor-divisas-3.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2012 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2012-11-13
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
  <title>Convertidor de divisas 3 (Resultado). Repaso 2.
  Ejercicios. PHP. Bartolomé Sintes Marco</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="mclibre-php-soluciones.css" rel="stylesheet" type="text/css"
  title="Color" />
</head>

<body>
<h1>Convertidor de divisas (Resultado)</h1>
<?php

function recoge($var)
{
    $tmp = (isset($_REQUEST[$var]))
        ? strip_tags(trim(htmlspecialchars($_REQUEST[$var], ENT_QUOTES, "UTF-8")))
        : "";
    if (get_magic_quotes_gpc()) {
        $tmp = stripslashes($tmp);
    }
    return $tmp;
}

$cantidad   = recoge("cantidad");
$origen     = recoge("origen");
$destino    = recoge("destino");
$cantidadOk = false;
$origenOk   = false;
$destinoOk  = false;

$maximo       = 1000000;
$monedas      = array("EUR", "USD", "GBP", "JPY", "ESP");
$factor       = array("EUR"=> 1, "USD"=>1.31481, "GBP"=>0.89807, "JPY"=>132.113, "ESP"=>166.366);
$nombreMoneda = array("EUR"=> "euros", "USD"=>"dólares USA",
    "GBP"=>"libras esterlinas", "JPY"=>"yenes japoneses", "ESP"=>"antiguas pesetas españolas");

if ($cantidad == "") {
    print "<p class=\"aviso\">No ha escrito la cantidad de dinero.</p>\n";
} elseif (!is_numeric($cantidad)) {
    print "<p class=\"aviso\">No ha escrito la cantidad de dinero como número.</p>\n";
} elseif (!ctype_digit($cantidad)) {
    print "<p class=\"aviso\">No ha escrito la cantidad de dinero "
         . " como número entero positivo.</p>\n";
} elseif ($cantidad >= $maximo) {
    print "<p class=\"aviso\">La cantidad de dinero no es inferior a "
         . number_format($maximo, 0, ",", ".").".</p>\n";
} else {
    $cantidadOk = true;
}

if (!in_array($origen, $monedas)) {
    print "  <p class=\"aviso\">No ha escrito correctamente la moneda de origen.</p>\n";
} else {
    $origenOk = true;
}

if (!in_array($destino, $monedas)) {
    print "  <p class=\"aviso\">No ha escrito correctamente la moneda de destino.</p>\n";
} else {
    $destinoOk = true;
}

if ($cantidadOk && $origenOk && $destinoOk) {
    $result = round($cantidad / $factor[$origen] * $factor[$destino], 2);
    print "<p>" . number_format($cantidad, 0, ",", ".") . " $nombreMoneda[$origen] "
         ."son " . number_format($result, 1, ",", ".") . " $nombreMoneda[$destino].</p>\n";
    print "<p>Gracias por utilizar este convertidor.</p>\n";
}

print "<p><a href=\"convertidor-divisas-3.html\">Volver al formulario.</a></p>\n";
?>

<address>
  Esta página forma parte del curso "Páginas web con PHP" disponible en <a
  href="http://www.mclibre.org/">http://www.mclibre.org</a><br />
  Autor: Bartolomé Sintes Marco<br />
  Última modificación de esta página: 13 de noviembre de 2012
</address>
<p class="licencia">El programa PHP que genera esta página está bajo
<a rel="license" href="http://www.gnu.org/licenses/agpl.txt">licencia AGPL 3 o
posterior</a>.</p>
</body>
</html>
