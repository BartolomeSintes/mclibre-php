<?php
/**
 * Tabla numerada (Resultado) - for-3-8-2.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2016 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2016-11-06
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
  <title>Tabla numerada (Resultado). for (3).
    Ejercicios. PHP. Bartolomé Sintes Marco. www.mclibre.org</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" type="text/css" href="mclibre-php-ejercicios.css" title="Color" />
  <style>
    td { text-align: center; }
  </style>
</head>

<body>
  <h1>Tabla numerada (Resultado)</h1>

<?php
function recoge($var)
{
    $tmp = (isset($_REQUEST[$var]))
        ? trim(htmlspecialchars($_REQUEST[$var], ENT_QUOTES, "UTF-8"))
        : "";
    return $tmp;
}

$numeradas = recoge("numeradas");
$columnas  = recoge("columnas");

$numeradasOk = $columnasOk = false;

$numeradasMinimo = 1;
$numeradasMaximo = 1000;
$columnasMinimo  = 1;
$columnasMaximo  = 100;

if ($numeradas == "") {
    print "  <p class=\"aviso\">No ha escrito el número de celdas numeradas.</p>\n";
    print "\n";
} elseif (!is_numeric($numeradas)) {
    print "  <p class=\"aviso\">No ha escrito el número de celdas como número.</p>\n";
    print "\n";
} elseif (!ctype_digit($numeradas)) {
    print "  <p class=\"aviso\">No ha escrito el número de celdas numeradas "
        . "como número entero.</p>\n";
    print "\n";
} elseif ($numeradas < $numeradasMinimo || $numeradas > $numeradasMaximo) {
    print "  <p class=\"aviso\">El número de celdas numeradas debe estar entre "
        . "$numeradasMinimo y $numeradasMaximo.</p>\n";
    print "\n";
} else {
    $numeradasOk = true;
}

if ($columnas == "") {
    print "  <p class=\"aviso\">No ha escrito el número de columnas.</p>\n";
    print "\n";
} elseif (!is_numeric($columnas)) {
    print "  <p class=\"aviso\">No ha escrito el número de columnas como número.</p>\n";
    print "\n";
} elseif (!ctype_digit($columnas)) {
    print "  <p class=\"aviso\">No ha escrito el número de columnas "
        . "como número entero.</p>\n";
    print "\n";
} elseif ($columnas < $columnasMinimo || $columnas > $columnasMaximo) {
    print "  <p class=\"aviso\">El número de columnas debe estar entre "
        . "$columnasMinimo y $columnasMaximo.</p>\n";
    print "\n";
} else {
    $columnasOk = true;
}

if ($numeradasOk && $columnasOk) {
    $filas = ceil($numeradas / $columnas);
    $contador = 1;
    print "  <table class=\"conborde\">\n";
    print "    <tbody>\n";
    for ($i = 1; $i <= $filas; $i++) {
        print "      <tr>\n";
        for ($j = 1; $j <= $columnas; $j++) {
            print "        <td>" . (($contador <= $numeradas) ? $contador++ : "")
                . "</td>\n";
        }
        print "      </tr>\n";
    }
    print "    </tbody>\n";
    print "  </table>\n";
    print "\n";
}

?>
  <p><a href="for-3-8-1.php">Volver al formulario.</a></p>

  <footer>
    <p class="ultmod">
      Última modificación de esta página:
      <time datetime="2016-11-06">6 de noviembre de 2016</time>
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
