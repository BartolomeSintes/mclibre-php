<?php
/**
 * Tablas de colores (Resultado) - for-3-7-2.php
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
  <title>Tablas de colores (Resultado). for (3).
    Ejercicios. PHP. Bartolomé Sintes Marco</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="mclibre-php-soluciones.css" rel="stylesheet" type="text/css" title="Color" />
  <style>
    table { margin-bottom: 20px; }
    td, th { width: 40px; height: 40px; text-align: center; }
  </style>
</head>

<body>
  <h1>Tablas de colores (Resultado)</h1>

<?php
function recoge($var)
{
    $tmp = (isset($_REQUEST[$var]))
        ? trim(htmlspecialchars($_REQUEST[$var], ENT_QUOTES, "UTF-8"))
        : "";
    return $tmp;
}

$numero = recoge("numero");

$numeroOk = false;

$numeroMinimo = 1;
$numeroMaximo = 20;

if ($numero == "") {
    print "  <p class=\"aviso\">No ha escrito el número de tablas.</p>\n";
    print "\n";
} elseif (!is_numeric($numero)) {
    print "  <p class=\"aviso\">No ha escrito el número de tablas como número.</p>\n";
    print "\n";
} elseif (!ctype_digit($numero)) {
    print "  <p class=\"aviso\">No ha escrito el número de tablas "
        . "como número entero positivo.</p>\n";
    print "\n";
} elseif ($numero < $numeroMinimo || $numero > $numeroMaximo) {
    print "  <p class=\"aviso\">El número de tablas debe estar entre "
        . "$numeroMinimo y $numeroMaximo.</p>\n";
    print "\n";
} else {
    $numeroOk = true;
}

if ($numeroOk) {
    $paso = ($numero > 1) ? 255 / ($numero - 1) : 0;
    for ($k = 0; $k < $numero; $k++) {
        print "  <table class=\"conborde\">\n";
        print "    <caption>Tabla nº" . (1 + $k) . "</caption>\n";
        print "    <tbody>\n";
        for ($i = 0; $i < $numero; $i++) {
            print "      <tr>\n";
            for ($j = 0; $j < $numero; $j++) {
                print "        <td style=\"background-color:rgb("
                    . round($k * $paso) . "," . round($i * $paso) . ","
                    . round($j * $paso) . ")\" title=\"R:" . round($k * $paso)
                    . " G:" . round($i * $paso) . " B:" . round($j * $paso)
                    . "\"></td>\n";
            }
            print "      </tr>\n";
        }
        print "    </tbody>\n";
        print "  </table>\n";
        print "\n";
    }
}

?>
  <p><a href="for-3-7-1.php">Volver al formulario.</a></p>

  <footer>
    <p class="ultmod">
      Última modificación de esta página:
      <time datetime="2016-11-06">6 de noviembre de 2016</time>
    </p>

    <p class="licencia">
      Este programa forma parte del curso <a href="http://www.mclibre.org/consultar/php/">
      Programación web en PHP</a> por <a href="http://www.mclibre.org/">Bartolomé
      Sintes Marco</a>.<br />
      El programa PHP que genera esta página está bajo
      <a rel="license" href="http://www.gnu.org/licenses/agpl.txt">licencia AGPL 3 o posterior</a>.</p>
  </footer>
</body>
</html>
