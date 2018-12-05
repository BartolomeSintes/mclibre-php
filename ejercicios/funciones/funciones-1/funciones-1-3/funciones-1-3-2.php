<?php
/**
 * Convertidor de distancias (2) Sin funciones - funciones-1-3.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2018 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2018-11-29
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
  <title>
    Convertidor de distancias (2) Sin funciones (Resultado).
    Funciones (1). Funciones.
    Ejercicios. Programación web en PHP. Bartolomé Sintes Marco. www.mclibre.org
  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="mclibre-php-ejercicios.css" title="Color" />
</head>

<body>
  <h1>Convertidor de distancias (1) Sin funciones (Resultado)</h1>

<?php
function recoge($var)
{
    $tmp = (isset($_REQUEST[$var]))
        ? trim(htmlspecialchars($_REQUEST[$var], ENT_QUOTES, "UTF-8"))
        : "";
    return $tmp;
}

$unidadesDistancias = ["km", "m", "cm"];
$unidadesTiempo = ["h", "min", "s"];

$numero  = recoge("numero");
$inicial = recoge("inicial");
$final   = recoge("final");

$numeroOk  = false;
$inicialOk = false;
$finalOk   = false;

if ($numero == "") {
    print "  <p class=\"aviso\">No ha escrito nada.</p>\n";
    print "\n";
} elseif (!is_numeric($numero)) {
    print "  <p class=\"aviso\">No ha escrito un número.</p>\n";
    print "\n";
} else {
    $numeroOk = true;
}

if (!in_array($inicial, $unidadesDistancias) && !in_array($inicial, $unidadesTiempo)  ) {
    print "  <p class=\"aviso\">No ha elegido una unidad inicial válida.</p>\n";
    print "\n";
} else {
    $inicialOk = true;
}

if (!in_array($final, $unidadesDistancias) && !in_array($final, $unidadesTiempo)  ) {
    print "  <p class=\"aviso\">No ha elegido una unidad final válida.</p>\n";
    print "\n";
} else {
    $finalOk = true;
}

if ((in_array($inicial, $unidadesDistancias) && in_array($final, $unidadesTiempo)) ||
    (in_array($inicial, $unidadesTiempo) && in_array($final, $unidadesDistancias))) {
    print "  <p class=\"aviso\">No ha elegido unidades compatibles.</p>\n";
    print "\n";
    $inicialOk = false;
    $finalOk   = false;
}

if ($numeroOk && $inicialOk && $finalOk) {
    // La unidad intermedia es el metro
    $numeroIntermedio = 0;
    if ($inicial == "km") {
        $numeroIntermedio = $numero * 1000;
    } elseif ($inicial == "m") {
        $numeroIntermedio = $numero;
    } elseif ($inicial == "cm") {
        $numeroIntermedio = $numero / 100;
    }

    // La unidad intermedia es el minuto
    if ($inicial == "h") {
        $numeroIntermedio = $numero * 60;
    } elseif ($inicial == "min") {
        $numeroIntermedio = $numero;
    } elseif ($inicial == "s") {
        $numeroIntermedio = $numero / 60;
    }

    if ($final == "km") {
        $numeroFinal = $numeroIntermedio / 1000;
    } elseif ($final == "m") {
        $numeroFinal = $numeroIntermedio;
    } elseif ($final == "cm") {
        $numeroFinal = $numeroIntermedio * 100;
    }

    if ($final == "h") {
        $numeroFinal = $numeroIntermedio / 60;
    } elseif ($final == "min") {
        $numeroFinal = $numeroIntermedio;
    } elseif ($final == "s") {
        $numeroFinal = $numeroIntermedio * 60;
    }


    print "  <p>$numero $inicial = $numeroFinal $final.</p>\n";
    print "\n";
}
?>
  <p><a href="funciones-1-3-1.php">Volver al formulario.</a></p>

  <footer>
    <p class="ultmod">
      Última modificación de esta página:
      <time datetime="2018-11-29">29 de noviembre de 2018</time>
    </p>

    <p class="licencia">
      Este programa forma parte del curso <strong><a href="http://www.mclibre.org/consultar/php/">Programación
      web en PHP</a></strong> de <a href="http://www.mclibre.org/" rel="author" >Bartolomé Sintes Marco</a>.<br />
      El programa PHP que genera esta página se distribuye bajo
      <a rel="license" href="http://www.gnu.org/licenses/agpl.txt">licencia AGPL 3 o posterior</a>.
    </p>
  </footer>
</body>
</html>
