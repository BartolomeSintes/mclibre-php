<?php
/**
 * Comprobación de datos ctype_ 2 - comprobacion-datos-ctype-2.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2019 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2019-11-09
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
    Funciones ctype_ (Resultado). Funciones de comprobación de datos.
    PHP. Bartolomé Sintes Marco. www.mclibre.org
  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="mclibre-php-ejercicios.css" title="Color">
</head>

<body>
  <h1>Comprobación de datos con funciones ctype_ (Resultado)</h1>

<?php
function recoge($key, $type = "")
{
    if (!is_string($key) && !is_int($key) || $key == "") {
        trigger_error("Function recoge(): Argument #1 (\$key) must be a non-empty string or an integer", E_USER_ERROR);
    } elseif ($type !== "" && $type !== []) {
        trigger_error("Function recoge(): Argument #2 (\$type) is optional, but if provided, it must be an empty array or an empty string", E_USER_ERROR);
    }
    $tmp = $type;
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

// print "  <pre>\n" . print_r(get_defined_functions(), true) . "</pre>\n";
// print "\n";

$dato = recoge("dato");

if (!isset($_REQUEST["dato"])) {
    print "  <p>Por favor, indique el dato a evaluar.</p>\n";
    print "\n";
} else {
    if ($dato != $_REQUEST["dato"] && $dato != "") {
        print "  <p>El texto introducido contiene caracteres potencialmente problemáticos (comillas, ampersand, etiquetas html, etc.). ";
        print "Por seguridad se ha aplicado al texto la función recoge() comentada en ";
        print "<a href=\"https://www.mclibre.org/consultar/php/lecciones/php-recogida-datos.html#recoger-datos\">estos apuntes</a>.</p>\n";
        print "\n";
        print "  <p>Tenga en cuenta que el resultado de las funciones mostrado puede ser diferente al que se obtendría utilizando el texto original.</p>\n";
        print "\n";
    }

    if (is_array($dato)) {
        print "  <p>Se ha recibido una matriz, pero no se han analizado sus valores.</p>\n";
        print "\n";
    } else {
        print "  <p>El texto utilizado es el siguiente: <span style=\"font-size: 150%; border: black 1px solid; background-color: white;\">$dato</span></p>\n";
        print "\n";
    }

    //  Funciones ctype_

    print "  <table class=\"conborde\" style=\"float: left; margin-left: 10px;\">\n";
    print "    <tr>\n";
    print "      <th colspan=\"2\">Funciones ctype_</th>\n";
    print "    </tr>\n";
    print "    <tr>\n";
    print "      <th>Función</th>\n";
    print "      <th>Devuelve</th>\n";
    print "    </tr>\n";

    $resultado = ctype_alnum($dato);
    print "    <tr>\n";
    print "      <td>ctype_alnum()</td>\n";
    if ($resultado == true) {
        print "      <td style=\"text-align: center\">true</td>\n";
    } elseif ($resultado == false) {
        print "      <td style=\"text-align: center\">false</td>\n";
    }
    print "    </tr>\n";

    $resultado = ctype_alpha($dato);
    print "    <tr>\n";
    print "      <td>ctype_alpha()</td>\n";
    if ($resultado == true) {
        print "      <td style=\"text-align: center\">true</td>\n";
    } elseif ($resultado == false) {
        print "      <td style=\"text-align: center\">false</td>\n";
    }
    print "    </tr>\n";

    $resultado = ctype_cntrl($dato);
    print "    <tr>\n";
    print "      <td>ctype_cntrl()</td>\n";
    if ($resultado == true) {
        print "      <td style=\"text-align: center\">true</td>\n";
    } elseif ($resultado == false) {
        print "      <td style=\"text-align: center\">false</td>\n";
    }
    print "    </tr>\n";

    $resultado = ctype_digit($dato);
    print "    <tr>\n";
    print "      <td>ctype_digit()</td>\n";
    if ($resultado == true) {
        print "      <td style=\"text-align: center\">true</td>\n";
    } elseif ($resultado == false) {
        print "      <td style=\"text-align: center\">false</td>\n";
    }
    print "    </tr>\n";

    $resultado = ctype_graph($dato);
    print "    <tr>\n";
    print "      <td>ctype_graph()</td>\n";
    if ($resultado == true) {
        print "      <td style=\"text-align: center\">true</td>\n";
    } elseif ($resultado == false) {
        print "      <td style=\"text-align: center\">false</td>\n";
    }
    print "    </tr>\n";

    $resultado = ctype_lower($dato);
    print "    <tr>\n";
    print "      <td>ctype_lower()</td>\n";
    if ($resultado == true) {
        print "      <td style=\"text-align: center\">true</td>\n";
    } elseif ($resultado == false) {
        print "      <td style=\"text-align: center\">false</td>\n";
    }
    print "    </tr>\n";

    $resultado = ctype_print($dato);
    print "    <tr>\n";
    print "      <td>ctype_print()</td>\n";
    if ($resultado == true) {
        print "      <td style=\"text-align: center\">true</td>\n";
    } elseif ($resultado == false) {
        print "      <td style=\"text-align: center\">false</td>\n";
    }
    print "    </tr>\n";

    $resultado = ctype_punct($dato);
    print "    <tr>\n";
    print "      <td>ctype_punct()</td>\n";
    if ($resultado == true) {
        print "      <td style=\"text-align: center\">true</td>\n";
    } elseif ($resultado == false) {
        print "      <td style=\"text-align: center\">false</td>\n";
    }
    print "    </tr>\n";

    $resultado = ctype_space($dato);
    print "    <tr>\n";
    print "      <td>ctype_space()</td>\n";
    if ($resultado == true) {
        print "      <td style=\"text-align: center\">true</td>\n";
    } elseif ($resultado == false) {
        print "      <td style=\"text-align: center\">false</td>\n";
    }
    print "    </tr>\n";

    $resultado = ctype_upper($dato);
    print "    <tr>\n";
    print "      <td>ctype_upper()</td>\n";
    if ($resultado == true) {
        print "      <td style=\"text-align: center\">true</td>\n";
    } elseif ($resultado == false) {
        print "      <td style=\"text-align: center\">false</td>\n";
    }
    print "    </tr>\n";

    $resultado = ctype_xdigit($dato);
    print "    <tr>\n";
    print "      <td>ctype_xdigit()</td>\n";
    if ($resultado == true) {
        print "      <td style=\"text-align: center\">true</td>\n";
    } elseif ($resultado == false) {
        print "      <td style=\"text-align: center\">false</td>\n";
    }
    print "    </tr>\n";

    print "  </table>\n";
    print "\n";
}

print "  <p style=\"clear: both; padding-top: 1em;\"><a href=\"comprobacion-datos-ctype-1.php\">Volver al formulario.</a></p>\n";
print "\n";
?>
  <footer>
    <p class="ultmod">
      Última modificación de esta página:
      <time datetime="2019-11-09">9 de noviembre de 2019</time>
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
