<?php
/**
 * Convertidor de divisas 3 - convertidor-divisas-3-2.php
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
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <title>Convertidor de divisas 3 (Resultado). Repaso 3.
    Ejercicios. PHP. Bartolomé Sintes Marco</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="mclibre-php-soluciones.css" rel="stylesheet" type="text/css" title="Color" />
</head>

<body>
  <h1>Convertidor de divisas (Resultado)</h1>

<?php
function recoge($var)
{
    $tmp = (isset($_REQUEST[$var]))
    ? trim(htmlspecialchars($_REQUEST[$var], ENT_QUOTES, "UTF-8"))
    : "";
    return $tmp;
}

$cantidad   = recoge("cantidad");
$origen     = recoge("origen");
$destino    = recoge("destino");
$cantidadOk = false;
$origenOk   = false;
$destinoOk  = false;

$maximo       = 1000000;
$monedas      = ["EUR", "USD", "GBP", "JPY", "ESP"];
$factor       = ["EUR"=> 1, "USD"=>1.31481, "GBP"=>0.89807, "JPY"=>132.113, "ESP"=>166.366];
$nombreMoneda = ["EUR"=> "euros", "USD"=>"dólares USA",
    "GBP"=>"libras esterlinas", "JPY"=>"yenes japoneses", "ESP"=>"antiguas pesetas españolas"];

if ($cantidad == "") {
    print "  <p class=\"aviso\">No ha escrito la cantidad de dinero.</p>\n";
    print "\n";
} elseif (!is_numeric($cantidad)) {
    print "  <p class=\"aviso\">No ha escrito la cantidad de dinero como número.</p>\n";
    print "\n";
} elseif (!ctype_digit($cantidad)) {
    print "  <p class=\"aviso\">No ha escrito la cantidad de dinero "
         . " como número entero positivo.</p>\n";
    print "\n";
} elseif ($cantidad >= $maximo) {
    print "  <p class=\"aviso\">La cantidad de dinero no es inferior a "
         . number_format($maximo, 0, ",", ".") . ".</p>\n";
    print "\n";
} else {
    $cantidadOk = true;
}

if (!in_array($origen, $monedas)) {
    print "  <p class=\"aviso\">No ha escrito correctamente la moneda de origen.</p>\n";
    print "\n";
} else {
    $origenOk = true;
}

if (!in_array($destino, $monedas)) {
    print "  <p class=\"aviso\">No ha escrito correctamente la moneda de destino.</p>\n";
    print "\n";
} else {
    $destinoOk = true;
}

if ($cantidadOk && $origenOk && $destinoOk) {
    $result = round($cantidad / $factor[$origen] * $factor[$destino], 2);
    print "  <p>" . number_format($cantidad, 0, ",", ".") . " $nombreMoneda[$origen] "
        . "son " . number_format($result, 1, ",", ".") . " $nombreMoneda[$destino].</p>\n";
    print "\n";
    print "  <p>Gracias por utilizar este convertidor.</p>\n";
    print "\n";
}
?>
  <p><a href="convertidor-divisas-3-1.php">Volver al formulario.</a></p>

  <footer>
    <p class="ultmod">
      Última modificación de esta página:
      <time datetime="2012-11-13">13 de noviembre de 2012</time></p>

    <p class="licencia">
      Esta página forma parte del curso <a href="http://www.mclibre.org/consultar/php/">
      <cite>Programación web en PHP</cite></a> por <cite>Bartolomé Sintes Marco</cite>.<br />
      y se distribuye bajo una <a rel="license" href="https://creativecommons.org/licenses/by-sa/4.0/deed.es_ES">
      Licencia Creative Commons Reconocimiento-CompartirIgual 4.0 Internacional (CC BY-SA 4.0)</a>.</p>
  </footer>
</body>
</html>
