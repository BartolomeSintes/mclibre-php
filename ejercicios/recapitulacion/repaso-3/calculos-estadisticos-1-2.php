<?php
/**
 * Cálculos estadísticos (Resultado 1) calculos-estadisticos-1-2.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2011 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2011-11-16
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
    Cálculos estadísticos (Resultado 1). Repaso 3.
    Ejercicios. PHP. Bartolomé Sintes Marco. www.mclibre.org
  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="mclibre-php-ejercicios.css" title="Color">
</head>

<body>
  <h1>Cálculos estadísticos (Resultado 1)</h1>

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

define("FORM_METHOD", "get");
define("NUM_MINIMO",  1);
define("NUM_MAXIMO",  20);

$numero   = recoge("numero");
$numeroOk = false;

if ($numero == "") {
    print "  <p class=\"aviso\">No ha escrito el número de valores.</p>\n";
    print "\n";
} elseif (!is_numeric($numero)) {
    print "  <p class=\"aviso\">No ha escrito el número de valores "
        . "como número.</p>\n";
    print "\n";
} elseif (!ctype_digit($numero)) {
    print "  <p class=\"aviso\">No ha escrito el número de valores "
        . "como número entero positivo.</p>\n";
    print "\n";
} elseif ($numero < NUM_MINIMO || $numero > NUM_MAXIMO) {
    print "  <p class=\"aviso\">El número de valores debe estar entre "
        . NUM_MINIMO . " y " . NUM_MAXIMO . ".</p>\n";
    print "\n";
} else {
    $numeroOk = true;
}

if ($numeroOk) {
    print "  <p>Escriba todos los valores y marque las casillas correspondientes "
        . "a los cálculos que quiere.</p>\n";
    print "\n";
    print "  <form action=\"calculos-estadisticos-1-3.php\" method=\"" . FORM_METHOD . "\">\n";
    print "    <table>\n";
    print "      <tbody>\n";
    for ($i=1; $i<=$numero; $i++) {
        print "        <tr>\n";
        print "          <td><strong>Número $i</strong>:</td>\n";
        print "          <td><input type=\"text\" name=\"n[$i]\" size=\"6\" maxlength=\"4\"></td>\n";
        print "        </tr>\n";
    }
    print "      </tbody>\n";
    print "    </table>\n";
    print "\n";
    print "    <p>\n";
    print "      <input type=\"checkbox\" name=\"suma\">Suma - \n";
    print "      <input type=\"checkbox\" name=\"media\">Media - \n";
    print "      <input type=\"checkbox\" name=\"maximo\">Máximo - \n";
    print "      <input type=\"checkbox\" name=\"minimo\">Mínimo\n";
    print "    </p>\n";
    print "\n";
    print "    <p class=\"der\">\n";
    print "      <input type=\"submit\" value=\"Contar\">\n";
    print "      <input type=\"reset\" value=\"Borrar\">\n";
    print "    </p>\n";
    print "  </form>\n";
    print "\n";
}
?>
  <p><a href="calculos-estadisticos-1-1.php">Volver al formulario.</a></p>

  <footer>
    <p class="ultmod">
      Última modificación de esta página:
      <time datetime="2011-11-16">16 de noviembre de 2011</time>
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
