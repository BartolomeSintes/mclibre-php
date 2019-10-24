<?php
/**
 * Tabla de multiplicar sin cabecera (Resultado) - for-3-3-2.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2019 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2019-10-24
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
    Tabla de multiplicar sin cabecera (Resultado).
    for (3). Con formularios.
    Ejercicios. PHP. Bartolomé Sintes Marco. www.mclibre.org
  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="mclibre-php-ejercicios.css" title="Color">
</head>

<body>
  <h1>Tabla de multiplicar sin cabecera (Resultado)</h1>

<?php
function recoge($var)
{
    if (!isset($_REQUEST[$var])) {
        $tmp = "";
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

$numero = recoge("numero");

$numeroOk = false;

$numeroMinimo = 1;
$numeroMaximo = 100;

if ($numero == "") {
    print "  <p class=\"aviso\">No ha escrito el tamaño de la tabla.</p>\n";
    print "\n";
} elseif (!is_numeric($numero)) {
    print "  <p class=\"aviso\">No ha escrito el tamaño de la tabla como número.</p>\n";
    print "\n";
} elseif (!ctype_digit($numero)) {
    print "  <p class=\"aviso\">No ha escrito el tamaño de la tabla "
        . "como número entero positivo.</p>\n";
    print "\n";
} elseif ($numero < $numeroMinimo || $numero > $numeroMaximo) {
    print "  <p class=\"aviso\">El tamaño de la tabla debe estar entre "
        . "$numeroMinimo y $numeroMaximo.</p>\n";
    print "\n";
} else {
    $numeroOk = true;
}

if ($numeroOk) {
    print "  <table class=\"conborde\">\n";
    print "    <tbody>\n";
    for ($i = 1; $i <= $numero; $i++) {
        print "      <tr>\n";
        for ($j = 1; $j <= $numero; $j++) {
            print "        <td>" . ($i * $j) . "</td>\n";
        }
        print "      </tr>\n";
    }
    print "    </tbody>\n";
    print "  </table>\n";
    print "\n";
}

?>
  <p><a href="for-3-3-1.php">Volver al formulario.</a></p>

  <footer>
    <p class="ultmod">
      Última modificación de esta página:
      <time datetime="2019-10-24">24 de octubre de 2019</time>
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
