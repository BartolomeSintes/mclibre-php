<?php
/**
 * Convertidor de distancias (2) Con funciones - funciones-1-2-2.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2018 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2018-12-09
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
    Convertidor de distancias (2) Con funciones (Resultado).
    Funciones (1). Funciones.
    Ejercicios. PHP. Bartolomé Sintes Marco. www.mclibre.org
  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="mclibre-php-ejercicios.css" title="Color">
</head>

<body>
  <h1>Convertidor de distancias (2) Con funciones (Resultado)</h1>

<?php
function recoge($var, $m = "")
{
    if (!isset($_REQUEST[$var])) {
        $tmp = (is_array($m)) ? [] : "";
    } elseif (!is_array($_REQUEST[$var])) {
        $tmp = trim(htmlspecialchars($_REQUEST[$var], ENT_QUOTES, "UTF-8"));
    } else {
        $tmp = $_REQUEST[$var];
        array_walk_recursive($tmp, function (&$valor) {
            $valor = trim(htmlspecialchars($valor, ENT_QUOTES, "UTF-8"));
        });
    }
    return $tmp;
}
{
    $tmp = (isset($_REQUEST[$var]))
        ? trim(htmlspecialchars($_REQUEST[$var], ENT_QUOTES, "UTF-8"))
        : "";
    return $tmp;
}

function convierte($num, $uniOri, $uniFin) {
    // La unidad intermedia es el metro
    $numeroIntermedio = 0;
    if ($uniOri == "km") {
        $numeroIntermedio = $num * 1000;
    } elseif ($uniOri == "m") {
        $numeroIntermedio = $num;
    } elseif ($uniOri == "cm") {
        $numeroIntermedio = $num / 100;
    } elseif ($uniOri == "mm") {
        $numeroIntermedio = $num / 1000;
    }

    if ($uniFin == "km") {
        $numeroFinal = $numeroIntermedio / 1000;
    } elseif ($uniFin == "m") {
        $numeroFinal = $numeroIntermedio;
    } elseif ($uniFin == "cm") {
        $numeroFinal = $numeroIntermedio * 100;
    } elseif ($uniFin == "mm") {
        $numeroFinal = $numeroIntermedio * 1000;
    }
    return $numeroFinal;
}

$unidades = ["km", "m", "cm", "mm"];

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

if (!in_array($inicial, $unidades)) {
    print "  <p class=\"aviso\">No ha elegido una unidad inicial válida.</p>\n";
    print "\n";
} else {
    $inicialOk = true;
}

if (!in_array($final, $unidades)) {
    print "  <p class=\"aviso\">No ha elegido una unidad final válida.</p>\n";
    print "\n";
} else {
    $finalOk = true;
}

if ($numeroOk && $inicialOk && $finalOk) {
    $resultado = convierte($numero, $inicial, $final);
    print "  <p>$numero $inicial = $resultado $final.</p>\n";
    print "\n";
}
?>
  <p><a href="funciones-1-2-fu-1.php">Volver al formulario.</a></p>

  <footer>
    <p class="ultmod">
      Última modificación de esta página:
      <time datetime="2018-12-09">9 de diciembre de 2018</time>
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
