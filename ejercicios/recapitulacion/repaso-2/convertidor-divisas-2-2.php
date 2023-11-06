<?php
/**
 * Convertidor de divisas 2 - convertidor-divisas-2-2.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2015 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2015-11-18
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
    Convertidor de divisas 2 (Resultado). Repaso (2).
    Ejercicios. PHP. Bartolomé Sintes Marco. www.mclibre.org
  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="mclibre-php-ejercicios.css" title="Color">
</head>

<body>
  <h1>Convertidor de divisas (Resultado)</h1>

<?php
// Funciones auxiliares
// Función de recogida de datos
function recoge($key, $type = "")
{
    if ($type !== "" && $type !== []) {
        trigger_error("Function recoge(): argument #2 (\$type) must be an empty array or an empty string.", E_USER_ERROR);
    }
    $tmp = is_array($type) ? [] : "";
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
$cantidad   = recoge("cantidad");
$origen     = recoge("origen");
$destino    = recoge("destino");
$cantidadOk = false;
$origenOk   = false;
$destinoOk  = false;

$maximo       = 1000000;

// Comprobación de $cantidad
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
} elseif ($cantidad > $maximo) {
    print "  <p class=\"aviso\">La cantidad de dinero no es inferior o igual a "
         . number_format($maximo, 0, ",", ".") . ".</p>\n";
    print "\n";
} else {
    $cantidadOk = true;
}

// Comprobación de $origen
if ($origen != "EUR" &&  $origen != "USD" && $origen != "GBP" && $origen != "JPY"
    && $origen != "ESP") {
    print "  <p class=\"aviso\">No ha escrito correctamente la moneda de origen.</p>\n";
    print "\n";
} else {
    $origenOk = true;
}

// Comprobación de $destino
if ($destino != "EUR" && $destino != "USD" && $destino != "GBP" && $destino != "JPY"
    && $destino != "ESP") {
    print "  <p class=\"aviso\">No ha escrito correctamente la moneda de destino.</p>\n";
    print "\n";
} else {
    $destinoOk = true;
}

// Si los valores recibidos son correctos ...
if ($cantidadOk && $origenOk && $destinoOk) {
    if ($origen == "EUR") {
        $intermedio = $cantidad;
        $nombreMonedaOrigen = "euros";
    } elseif ($origen == "USD") {
        $intermedio = $cantidad / 1.31481;
        $nombreMonedaOrigen = "dólares USA";
    } elseif ($origen == "GBP") {
        $intermedio = $cantidad / 0.89807;
        $nombreMonedaOrigen = "libras esterlinas";
    } elseif ($origen == "JPY") {
        $intermedio = $cantidad / 132.113;
        $nombreMonedaOrigen = "yenes";
    } elseif ($origen == "ESP") {
        $intermedio = $cantidad / 166.366;
        $nombreMonedaOrigen = "pesetas españolas";
    }

    if ($destino == "EUR") {
        $result = $intermedio;
        $nombreMonedaDestino = "euros";
    } elseif ($destino == "USD") {
        $result = $intermedio * 1.31481;
        $nombreMonedaDestino = "dólares USA";
    } elseif ($destino == "GBP") {
        $result = $intermedio * 0.89807;
        $nombreMonedaDestino = "libras esterlinas";
    } elseif ($destino == "JPY") {
        $result = $intermedio * 132.113;
        $nombreMonedaDestino = "yenes";
    } elseif ($destino == "ESP") {
        $result = $intermedio * 166.366;
        $nombreMonedaDestino = "pesetas españolas";
    }

    print "  <p>$cantidad $nombreMonedaOrigen son " . number_format($result, 2, ",", ".")
            . " $nombreMonedaDestino.</p>\n";
    print "\n";
    print "  <p>Gracias por utilizar este convertidor.</p>\n";
    print "\n";
}
?>
  <p><a href="convertidor-divisas-2-1.php">Volver al formulario.</a></p>

  <footer>
    <p class="ultmod">
      Última modificación de esta página:
      <time datetime="2015-11-18">18 de noviembre de 2015</time>
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
