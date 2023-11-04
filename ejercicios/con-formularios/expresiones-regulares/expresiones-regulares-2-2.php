<?php
/**
 * Validación de entrada de texto 2 (Resultado) - expresiones-regulares-2.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2010 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2011-11-14
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
    Validación de entrada de texto 2 (Resultado). Expresiones regulares.
    Ejercicios. PHP. Bartolomé Sintes Marco. www.mclibre.org
  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="mclibre-php-ejercicios.css" title="Color">
</head>

<body>
  <h1>Validación de entrada de texto 2 (Resultado)</h1>

<?php
// Función de recogida de datos
function recoge($key, $type = "")
{
    if ($type != "" && $type != []) {
        trigger_error("Function recoge(): argument #2 (\$type) must be an empty array or an empty string.", E_USER_ERROR);
    }
    $tmp = is_array($type) ? [] : "";
    if (isset($_REQUEST[$key])) {
        if (!is_array($_REQUEST[$key]) && !is_array($type)) {
            $tmp = trim(htmlspecialchars($_REQUEST[$key]));
        } elseif (is_array($_REQUEST[$key]) && is_array($type)) {
            $tmp = $_REQUEST[$key];
            array_walk_recursive($tmp, function (&$value) {
                $value = trim(htmlspecialchars($value));
            });
        }
    }
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

$patron = "/^[[:alpha:]]( +[[:alpha:]])*$/";
comprueba_pcre($patron, $texto, "es uno o más caracteres sueltos separados por espacios");

$patron = "/^[[:alpha:]]( +[[:alpha:]])+$/";
comprueba_pcre($patron, $texto, "es dos o más caracteres sueltos separados por espacios");

$patron = "/^[a-z]+( +[a-z]+)*$/i";
comprueba_pcre($patron, $texto, "es una o más palabras con caracteres ingleses");

$patron = "/^[[:upper:]]+$/";
comprueba_pcre($patron, $texto, "es una única palabra en mayúsculas");

$patron = "/^[0-9]{1,2}\/[0-9]{1,2}\/[0-9]{4}$/";
comprueba_pcre($patron, $texto, "es una fecha con el formato dd/mm/aaaa");

$patron = "/^[[:digit:]]+([\.,][[:digit:]]{1,2})?$/";
comprueba_pcre($patron, $texto, "es un número sin signo y puede que hasta dos decimales");

$patron = "/^[+-][[:digit:]]+([\.,][[:digit:]]+)?$/";
comprueba_pcre($patron, $texto, "es un número con signo y puede que parte decimal");

// $patron = "/^[[:alnum:]\-\+\.\*_]{6,}$/";    // Si el menos no está al final hay que escaparlo
$patron = "/^[[:alnum:]\+\.\*_-]{6,}$/";
comprueba_pcre($patron, $texto, "es una contraseña");

print "  </ol>\n";
?>

  <p><a href="expresiones-regulares-2-1.php">Volver al formulario.</a></p>

  <footer>
    <p class="ultmod">
      Última modificación de esta página:
      <time datetime="2011-11-14">14 de noviembre de 2011</time>
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
