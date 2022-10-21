<?php
/**
 * Tabla de multiplicar (Resultado) - for-3-5-2.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2022 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2022-10-10
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
    Tabla de multiplicar (Resultado).
    for (3). Con formularios.
    Ejercicios. PHP. Bartolomé Sintes Marco. www.mclibre.org
  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="mclibre-php-ejercicios.css" title="Color">
  <style>
    td { text-align: center; }
  </style>
</head>

<body>
  <h1>Tabla de multiplicar (Resultado)</h1>

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

$filas    = recoge("filas");
$columnas = recoge("columnas");
$altura   = recoge("altura");
$anchura  = recoge("anchura");

$filasOk = $columnasOk = $alturaOk = $anchuraOk = false;

$filasMinimo   = $columnasMinimo   = 1;
$alturaMinimo  = 30;
$anchuraMinimo = 50;
$filasMaximo   = $columnasMaximo   = $alturaMaximo   = $anchuraMaximo   = 100;

if ($filas == "") {
    print "  <p class=\"aviso\">No ha escrito el número de filas.</p>\n";
    print "\n";
} elseif (!is_numeric($filas)) {
    print "  <p class=\"aviso\">No ha escrito el número de filas como número.</p>\n";
    print "\n";
} elseif (!ctype_digit($filas)) {
    print "  <p class=\"aviso\">No ha escrito el número de filas "
        . "como número entero positivo.</p>\n";
    print "\n";
} elseif ($filas < $filasMinimo || $filas > $filasMaximo) {
    print "  <p class=\"aviso\">El número de filas debe estar entre "
        . "$filasMinimo y $filasMaximo.</p>\n";
    print "\n";
} else {
    $filasOk = true;
}

if ($columnas == "") {
    print "  <p class=\"aviso\">No ha escrito el número de columnas.</p>\n";
    print "\n";
} elseif (!is_numeric($columnas)) {
    print "  <p class=\"aviso\">No ha escrito  el número de columnas como número.</p>\n";
    print "\n";
} elseif (!ctype_digit($columnas)) {
    print "  <p class=\"aviso\">No ha escrito el número de columnas "
        . "como número entero positivo.</p>\n";
    print "\n";
} elseif ($columnas < $columnasMinimo || $columnas > $columnasMaximo) {
    print "  <p class=\"aviso\">El número de columnas debe estar entre "
        . "$columnasMinimo y $columnasMaximo.</p>\n";
    print "\n";
} else {
    $columnasOk = true;
}

if ($altura == "") {
    print "  <p class=\"aviso\">No ha escrito la altura de las filas.</p>\n";
    print "\n";
} elseif (!is_numeric($altura)) {
    print "  <p class=\"aviso\">No ha escrito la altura de las filas como número.</p>\n";
    print "\n";
} elseif (!ctype_digit($altura)) {
    print "  <p class=\"aviso\">No ha escrito la altura de las filas "
        . "como número entero positivo.</p>\n";
    print "\n";
} elseif ($altura < $alturaMinimo || $altura > $alturaMaximo) {
    print "  <p class=\"aviso\">La altura de las filas debe estar entre "
        . "$alturaMinimo y $alturaMaximo.</p>\n";
    print "\n";
} else {
    $alturaOk = true;
}

if ($anchura == "") {
    print "  <p class=\"aviso\">No ha escrito la anchura de las columnas.</p>\n";
    print "\n";
} elseif (!is_numeric($anchura)) {
    print "  <p class=\"aviso\">No ha escrito la anchura de las columnas como número.</p>\n";
    print "\n";
} elseif (!ctype_digit($anchura)) {
    print "  <p class=\"aviso\">No ha escrito la anchura de las columnas "
        . "como número entero positivo.</p>\n";
    print "\n";
} elseif ($anchura < $anchuraMinimo || $anchura > $anchuraMaximo) {
    print "  <p class=\"aviso\">La anchura de las columnas debe estar entre "
        . "$anchuraMinimo y $anchuraMaximo.</p>\n";
    print "\n";
} else {
    $anchuraOk = true;
}

if ($filasOk && $columnasOk && $alturaOk && $anchuraOk) {
    print "  <table class=\"conborde\" style=\"table-layout: fixed; border-collapse: collapse; width: " . $anchura * ($columnas + 1) . "px\">\n";
    print "    <tbody>\n";
    print "      <tr style=\"height: {$altura}px\">\n";
    print "        <th>X</th>\n";
    for ($j = 1; $j <= $columnas; $j++) {
        print "        <th>$j</th>\n";
    }
    print "      </tr>\n";

    for ($i = 1; $i <= $filas; $i++) {
        print "      <tr style=\"height: {$altura}px\">\n";
        print "        <th>$i</th>\n";
        for ($j = 1; $j <= $columnas; $j++) {
            print "        <td>" . $i * $j . "</td>\n";
        }
        print "      </tr>\n";
    }
    print "    </tbody>\n";
    print "  </table>\n";
    print "\n";
}

?>
  <p><a href="for-3-5-1.php">Volver al formulario.</a></p>

  <footer>
    <p class="ultmod">
      Última modificación de esta página:
      <time datetime="2022-10-10">10 de octubre de 2022</time>
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
