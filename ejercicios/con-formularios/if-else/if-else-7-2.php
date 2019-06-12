<?php
/**
 * if ... elseif ... else ... 7-2 - if-else-7-2.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2018 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2018-10-23
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
  <meta charset="utf-8">
  <title>
    Convertidor de centímetros a kilómetros, metros y centímetros (Resultado).
    if ... elseif ... else ... Con formularios.
    Ejercicios. PHP. Bartolomé Sintes Marco. www.mclibre.org
  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="mclibre-php-ejercicios.css" title="Color">
</head>

<body>
  <h1>Convertidor de centímetros a kilómetros, metros y centímetros (Resultado)</h1>

<?php
function recoge($var)
{
    $tmp = (isset($_REQUEST[$var]))
        ? trim(htmlspecialchars($_REQUEST[$var], ENT_QUOTES, "UTF-8"))
        : "";
    return $tmp;
}

$distancia = recoge("distancia");

$distanciaOk = false;

if ($distancia == "") {
    print "  <p class=\"aviso\">No ha escrito la distancia.</p>\n";
    print "\n";
} elseif (!is_numeric($distancia)) {
    print "  <p class=\"aviso\">No ha escrito la distancia como número.</p>\n";
    print "\n";
} elseif (!ctype_digit($distancia)) {
    print "  <p class=\"aviso\">No ha escrito la distancia como número "
        . "entero positivo (sin parte decimal).</p>\n";
    print "\n";
} elseif ($distancia >= 1000000000) {
    print "  <p class=\"aviso\">La distancia no es inferior a 1.000.000.000.</p>\n";
    print "\n";
} else {
    $distanciaOk = true;
}

if ($distanciaOk) {
    $distanciaOriginal = $distancia;
    if ($distancia >= 100000) {
        $km = floor($distancia / 100000);
        $distancia = $distancia % 100000;
    }
    if ($distancia >= 100) {
        $m = floor($distancia / 100);
        $distancia = $distancia % 100;
    }

    print "  <p>$distanciaOriginal cm son ";

    if ($distanciaOriginal == 0) {
        print "0 cm.";
    }
    if (isset($km)) {
        print "$km km";
        if (isset($m)) {
            if ($distancia != 0) {
                print ", ";
            } else {
                print " y ";
            }
        } else {
            if ($distancia != 0) {
                print " y ";
            }
        }
    }
    if (isset($m)) {
        print "$m m";
        if ($distancia != 0) {
            print " y ";
        }
    }
    if ($distancia != 0) {
        print "$distancia cm";
    }
    print ".</p>\n";
    print "\n";
}
?>
  <p><a href="if-else-7-1.php">Volver al formulario.</a></p>

  <footer>
    <p class="ultmod">
      Última modificación de esta página:
      <time datetime="2018-10-23">23 de octubre de 2018</time>
    </p>

    <p class="licencia">
      Este programa forma parte del curso <strong><a href="http://www.mclibre.org/consultar/php/">Programación
      web en PHP</a></strong> de <a href="http://www.mclibre.org/" rel="author">Bartolomé Sintes Marco</a>.<br>
      El programa PHP que genera esta página se distribuye bajo
      <a rel="license" href="http://www.gnu.org/licenses/agpl.txt">licencia AGPL 3 o posterior</a>.
    </p>
  </footer>
</body>
</html>
