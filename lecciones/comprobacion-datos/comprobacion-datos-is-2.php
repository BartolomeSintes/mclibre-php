<?php
/**
 * Comprobación de datos is_ 2 - comprobacion-datos-is-2.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2019 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2019-11-09
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
    Funciones is_ (Resultado). Comprobación de datos.
    PHP. Bartolomé Sintes Marco. www.mclibre.org
  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="mclibre-php-ejercicios.css" title="Color">
</head>

<body>
  <h1>Comprobación de datos con funciones is_ (Resultado)</h1>

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

// print "  <pre>"; print_r(get_defined_functions()); print "</pre>"; print "\n";

$dato = recoge("dato");

if (!isset($_REQUEST["dato"])) {
    print "  <p>Por favor, indique el dato a evaluar.</p>\n";
    print "\n";
} else {
    if ($dato != $_REQUEST["dato"] && $dato != "") {
        print "  <p>El texto introducido contiene caracteres potencialmente problemáticos (comillas, ampersand, etiquetas html, etc.). "
            . "Por seguridad se ha aplicado al texto la función recoge() comentada en "
            . "<a href=\"http://www.mclibre.org/consultar/php/lecciones/php-recogida-datos.html#recoger-datos\">estos apuntes</a>.</p>\n";
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

    //  Funciones is_

    print "  <table class=\"conborde\" style=\"float: left; margin-left: 10px;\">\n";
    print "    <tr>\n";
    print "      <th colspan=\"2\">Funciones is_</th>\n";
    print "    </tr>\n";
    print "    <tr>\n";
    print "      <th>Función</th>\n";
    print "      <th>Devuelve</th>\n";
    print "    </tr>\n";

    $resultado = isset($dato);
    print "    <tr>\n";
    print "      <td>isset()</td>\n";
    if ($resultado == true) {
        print "      <td style=\"text-align: center\">true</td>\n";
    } elseif ($resultado == false) {
        print "      <td style=\"text-align: center\">false</td>\n";
    }
    print "    </tr>\n";

    $resultado = is_null($dato);
    print "    <tr>\n";
    print "      <td>is_null()</td>\n";
    if ($resultado == true) {
        print "      <td style=\"text-align: center\">true</td>\n";
    } elseif ($resultado == false) {
        print "      <td style=\"text-align: center\">false</td>\n";
    }
    print "    </tr>\n";

    $resultado = is_bool($dato);
    print "    <tr>\n";
    print "      <td>is_bool()</td>\n";
    if ($resultado == true) {
        print "      <td style=\"text-align: center\">true</td>\n";
    } elseif ($resultado == false) {
        print "      <td style=\"text-align: center\">false</td>\n";
    }
    print "    </tr>\n";

    $resultado = is_numeric($dato);
    print "    <tr>\n";
    print "      <td>is_numeric()</td>\n";
    if ($resultado == true) {
        print "      <td style=\"text-align: center\">true</td>\n";
    } elseif ($resultado == false) {
        print "      <td style=\"text-align: center\">false</td>\n";
    }
    print "    </tr>\n";

    $resultado = is_int($dato);
    print "    <tr>\n";
    print "      <td>is_int()</td>\n";
    if ($resultado == true) {
        print "      <td style=\"text-align: center\">true</td>\n";
    } elseif ($resultado == false) {
        print "      <td style=\"text-align: center\">false</td>\n";
    }
    print "    </tr>\n";

    $resultado = is_float($dato);
    print "    <tr>\n";
    print "      <td>is_float()</td>\n";
    if ($resultado == true) {
        print "      <td style=\"text-align: center\">true</td>\n";
    } elseif ($resultado == false) {
        print "      <td style=\"text-align: center\">false</td>\n";
    }
    print "    </tr>\n";

    $resultado = is_string($dato);
    print "    <tr>\n";
    print "      <td>is_string()</td>\n";
    if ($resultado == true) {
        print "      <td style=\"text-align: center\">true</td>\n";
    } elseif ($resultado == false) {
        print "      <td style=\"text-align: center\">false</td>\n";
    }
    print "    </tr>\n";

    $resultado = is_scalar($dato);
    print "    <tr>\n";
    print "      <td>is_scalar()</td>\n";
    if ($resultado == true) {
        print "      <td style=\"text-align: center\">true</td>\n";
    } elseif ($resultado == false) {
        print "      <td style=\"text-align: center\">false</td>\n";
    }
    print "    </tr>\n";

    $resultado = is_array($dato);
    print "    <tr>\n";
    print "      <td>is_array()</td>\n";
    if ($resultado == true) {
        print "      <td style=\"text-align: center\">true</td>\n";
    } elseif ($resultado == false) {
        print "      <td style=\"text-align: center\">false</td>\n";
    }
    print "    </tr>\n";

    $resultado = is_callable($dato);
    print "    <tr>\n";
    print "      <td>is_callable()</td>\n";
    if ($resultado == true) {
        print "      <td style=\"text-align: center\">true</td>\n";
    } elseif ($resultado == false) {
        print "      <td style=\"text-align: center\">false</td>\n";
    }
    print "    </tr>\n";

    $resultado = is_object($dato);
    print "    <tr>\n";
    print "      <td>is_object()</td>\n";
    if ($resultado == true) {
        print "      <td style=\"text-align: center\">true</td>\n";
    } elseif ($resultado == false) {
        print "      <td style=\"text-align: center\">false</td>\n";
    }
    print "    </tr>\n";

    $resultado = is_resource($dato);
    print "    <tr>\n";
    print "      <td>is_resource()</td>\n";
    if ($resultado == true) {
        print "      <td style=\"text-align: center\">true</td>\n";
    } elseif ($resultado == false) {
        print "      <td style=\"text-align: center\">false</td>\n";
    }
    print "    </tr>\n";

    if (function_exists("is_countable")) {
        $resultado = is_countable($dato);
        print "    <tr>\n";
        print "      <td>is_countable()</td>\n";
        if ($resultado == true) {
            print "      <td style=\"text-align: center\">true</td>\n";
        } elseif ($resultado == false) {
            print "      <td style=\"text-align: center\">false</td>\n";
        }
        print "    </tr>\n";
    } else {
        print "    <tr>\n";
        print "      <td>is_countable()</td>\n";
        print "      <td>La función no está disponible en este servidor.</td>\n";
        print "    </tr>\n";
    }

    if (function_exists("is_iterable")) {
        $resultado = is_iterable($dato);
        print "    <tr>\n";
        print "      <td>is_iterable()</td>\n";
        if ($resultado == true) {
            print "      <td style=\"text-align: center\">true</td>\n";
        } elseif ($resultado == false) {
            print "      <td style=\"text-align: center\">false</td>\n";
        }
        print "    </tr>\n";
    } else {
        print "    <tr>\n";
        print "      <td>is_iterable()</td>\n";
        print "      <td>La función no está disponible en este servidor.</td>\n";
        print "    </tr>\n";
    }

    print "  </table>\n";
    print "\n";
}

print "  <p style=\"clear: both; padding-top: 1em;\"><a href=\"comprobacion-datos-is-1.php\">Volver al formulario.</a></p>\n";
print "\n";
?>
  <footer>
    <p class="ultmod">
      Última modificación de esta página:
      <time datetime="2019-11-09">9 de noviembre de 2019</time>
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
