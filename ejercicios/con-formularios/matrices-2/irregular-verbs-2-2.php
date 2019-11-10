<?php
/**
 * Irregular verbs 2-2 - irregular-verbs-2-2.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2016 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2016-11-07
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
    Irregular verbs 2 (Resultado). Matrices (2).
    Ejercicios. PHP. Bartolomé Sintes Marco. www.mclibre.org
  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="mclibre-php-ejercicios.css" title="Color">
</head>

<body>
  <h1>Irregular verbs 2 (Resultado)</h1>

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

include "irregular-verbs-list.php";

$numeroVerbos = count($irregularVerbs);

$formaVerbalNombre = ["infinitivo", "pasado", "participio"];

$respuesta   = recoge("respuesta");
$verbo       = recoge("verbo");
$formaVerbal = recoge("formaVerbal");

$verboOk       = false;
$formaVerbalOk = false;

if ($verbo == "" || !is_numeric($verbo) || !ctype_digit($verbo) || $verbo < 0 || $verbo >= $numeroVerbos) {
    print "  <p class=\"aviso\">Por favor, indique un verbo dentro del rango.</p>\n";
    print "\n";
} else {
    $verboOk = true;
}

if ($formaVerbal != 0 && $formaVerbal != 1 && $formaVerbal != 2) {
    print "  <p class=\"aviso\">Por favor, indique una forma verbal dentro del rango.</p>\n";
    print "\n";
} else {
    $formaVerbalOk = true;
}

if ($verboOk && $formaVerbalOk) {
    if ($respuesta == $irregularVerbs[$verbo][$formaVerbal]) {
        print "  <p>¡Respuesta correcta!</p>\n";
        print "\n";
    } else {
        print "  <p>¡Respuesta incorrecta!</p>\n";
        print "\n";
        print "  <p>El <strong>$formaVerbalNombre[$formaVerbal]</strong> de ";
        print "<strong>{$irregularVerbs[$verbo][3]}</strong> es ";
        print "<strong>{$irregularVerbs[$verbo][$formaVerbal]}</strong>.\n";
        print "\n";
    }
}
?>
  <p><a href="irregular-verbs-2-1.php">Volver al formulario.</a></p>

  <footer>
    <p class="ultmod">
      Última modificación de esta página:
      <time datetime="2016-11-07">7 de noviembre de 2016</time>
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
