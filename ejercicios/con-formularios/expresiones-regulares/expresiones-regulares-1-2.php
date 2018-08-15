<?php
/**
 * Validación de entrada de texto 1 (Resultado) - expresiones-regulares-1.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2010 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2011-11-14
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
  <title>Validación de entrada de texto 1 (Resultado). Expresiones regulares.
    Ejercicios. Programación web en PHP. Bartolomé Sintes Marco</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="mclibre-php-soluciones.css" rel="stylesheet" type="text/css" title="Color" />
</head>

<body>
  <h1>Validación de entrada de texto 1 (Resultado)</h1>

<?php
function recoge($var)
{
    $tmp = (isset($_REQUEST[$var]))
    ? trim(htmlspecialchars($_REQUEST[$var], ENT_QUOTES, "UTF-8"))
    : "";
    return $tmp;
}

function comprueba_pcre($patron, $texto, $objetivo)
{
    if (preg_match($patron, $texto)) {
        print "    <li>La cadena <strong>\"$texto\"</strong> $objetivo.</li>\n";
    } else {
        print "    <li>La cadena <strong>\"$texto\"</strong> <span class=\"aviso\">no</span> $objetivo.</li>\n";
    }
}

$texto = recoge("texto");

print "  <p>Ha escrito: <strong>\"$texto\"</strong></p>\n";
print "\n";
print "  <ol>\n";

if ($texto == "") {
    print "    <li>La cadena \"\" está vacía.</li>\n";
} else {
    print "    <li>La cadena <strong>\"$texto\"</strong> <span class=\"aviso\">no</span> está vacía.</li>\n";
}

$patron = "/^[[:alpha:]]+$/";
comprueba_pcre($patron, $texto, "es una única palabra");

$patron = "/^[[:alpha:]]+ +[[:alpha:]]+$/";
comprueba_pcre($patron, $texto, "son dos palabras");

$patron = "/^[a-z]+$/i";
comprueba_pcre($patron, $texto, "es una única palabra que contiene solamente caracteres ingleses");

if ($texto != "") {
    $patron = "/^a*e*i*o*u*$/";
    comprueba_pcre($patron, $texto, "es una cadena de vocales minúsculas sin acentuar en orden alfabético ");
} else {
    print "    <li>La cadena <strong>\"$texto\"</strong> <span class=\"aviso\">no</span> es una cadena de vocales minúsculas sin acentuar en orden alfabético </li>\n";
}

$patron = "/^[0-9]+$/";
comprueba_pcre($patron, $texto, "es un único número");

$patron = "/^[0-9]*[02468]$/";
comprueba_pcre($patron, $texto, "es un único número par");

$patron = "/^[69][0-9]{8}$/";
comprueba_pcre($patron, $texto,  "es un teléfono de 9 cifras que empieza por 6 o 9");

$patron = "/^[0-9]{1,8}[A-Z]?$/";
comprueba_pcre($patron, $texto, "es un número del DNI (de 1 a 8 números, con letra inglesa final mayúscula o sin ella)");

$patron = "/^[0-4][0-9]{4}$/";
comprueba_pcre($patron, $texto, "es un código postal");

print "  </ol>\n";
?>

  <p><a href="expresiones-regulares-1-1.php">Volver al formulario.</a></p>

  <footer>
    <p class="ultmod">
      Última modificación de esta página:
      <time datetime="2011-11-14">14 de noviembre de 2011</time>
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
