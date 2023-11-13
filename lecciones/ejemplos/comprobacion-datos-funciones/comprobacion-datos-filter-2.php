<?php
/**
 * Comprobación de datos filter_var() 2 - comprobacion-datos-filter-2.php
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
    Función filter_var() (Resultado). Funciones de comprobación de datos.
    PHP. Bartolomé Sintes Marco. www.mclibre.org
</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="mclibre-php-ejercicios.css" title="Color">
</head>

<body>
  <h1>Comprobación de datos con la función filter_var() (Resultado)</h1>

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

// print "  <pre>"; print_r(get_defined_functions()); print "</pre>"; print "\n";

$dato = recoge("dato");

if (!isset($_REQUEST["dato"])) {
    print "  <p>Por favor, indique el dato a evaluar.</p>\n";
    print "\n";
} else {
    if ($dato != $_REQUEST["dato"] && $dato != "") {
        print "  <p>El texto introducido contiene caracteres potencialmente problemáticos (comillas, ampersand, etiquetas html, etc.). "
            . "Por seguridad se ha aplicado al texto la función recoge() comentada en "
            . "<a href=\"https://www.mclibre.org/consultar/php/lecciones/php-recogida-datos.html#recoger-datos\">estos apuntes</a>.</p>\n";
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

    //  Función filter_var

    print "  <table class=\"conborde\" style=\"float: left; margin-left: 10px;\">\n";
    print "    <tr>\n";
    print "      <th colspan=\"2\">Función filter_var</th>\n";
    print "    </tr>\n";
    print "    <tr>\n";
    print "      <th>Función</th>\n";
    print "      <th>Devuelve</th>\n";
    print "    </tr>\n";


    $resultado = filter_var($dato, FILTER_VALIDATE_BOOLEAN);
    print "    <tr>\n";
    print "      <td>FILTER_VALIDATE_BOOLEAN</td>\n";
    if ($resultado === false && $dato != false) {
        print "      <td style=\"text-align: center\">false (NO cumple)</td>\n";
    } else {
        print "      <td style=\"text-align: center\">$resultado (cumple)</td>\n";
    }
    print "    </tr>\n";

    $filtros = [
        [FILTER_VALIDATE_INT, "FILTER_VALIDATE_INT"],
        [FILTER_VALIDATE_FLOAT, "FILTER_VALIDATE_FLOAT"],
        [FILTER_VALIDATE_DOMAIN, "FILTER_VALIDATE_DOMAIN"],
        [FILTER_VALIDATE_URL, "FILTER_VALIDATE_URL"],
        [FILTER_VALIDATE_EMAIL, "FILTER_VALIDATE_EMAIL"],
        [FILTER_VALIDATE_IP, "FILTER_VALIDATE_IP"],
        [FILTER_VALIDATE_MAC, "FILTER_VALIDATE_MAC"],
    ];
    foreach ($filtros as $filtro) {
        $resultado = filter_var($dato, $filtro[0]);
        print "    <tr>\n";
        print "      <td>$filtro[1]</td>\n";
        if ($resultado === false) {
            print "      <td style=\"text-align: center\">false</td>\n";
        } else {
            print "      <td style=\"text-align: center\">$resultado</td>\n";
        }
        print "    </tr>\n";
    }

    $resultado = filter_var($dato, FILTER_VALIDATE_INT);
    print "    <tr>\n";
    print "      <td>FILTER_VALIDATE_INT</td>\n";
    if ($resultado === false) {
        print "      <td style=\"text-align: center\">false</td>\n";
    } else {
        print "      <td style=\"text-align: center\">$resultado</td>\n";
    }
    print "    </tr>\n";

    $resultado = filter_var($dato, FILTER_VALIDATE_BOOLEAN);
    print "    <tr>\n";
    print "      <td>FILTER_VALIDATE_BOOLEAN</td>\n";
    if ($resultado === false) {
        print "      <td style=\"text-align: center\">false</td>\n";
    } else {
        print "      <td style=\"text-align: center\">$resultado</td>\n";
    }
    print "    </tr>\n";

    $resultado = filter_var($dato, FILTER_VALIDATE_FLOAT);
    print "    <tr>\n";
    print "      <td>FILTER_VALIDATE_FLOAT</td>\n";
    if ($resultado === false) {
        print "      <td style=\"text-align: center\">false</td>\n";
    } else {
        print "      <td style=\"text-align: center\">$resultado</td>\n";
    }
    print "    </tr>\n";

    $resultado = filter_var($dato, FILTER_VALIDATE_DOMAIN);
    print "    <tr>\n";
    print "      <td>FILTER_VALIDATE_DOMAIN</td>\n";
    if ($resultado === false) {
        print "      <td style=\"text-align: center\">false</td>\n";
    } else {
        print "      <td style=\"text-align: center\">$resultado</td>\n";
    }
    print "    </tr>\n";

    $resultado = filter_var($dato, FILTER_VALIDATE_URL);
    print "    <tr>\n";
    print "      <td>FILTER_VALIDATE_URL</td>\n";
    if ($resultado === false) {
        print "      <td style=\"text-align: center\">false</td>\n";
    } else {
        print "      <td style=\"text-align: center\">$resultado</td>\n";
    }
    print "    </tr>\n";

    $resultado = filter_var($dato, FILTER_VALIDATE_EMAIL);
    print "    <tr>\n";
    print "      <td>FILTER_VALIDATE_EMAIL</td>\n";
    if ($resultado === false) {
        print "      <td style=\"text-align: center\">false</td>\n";
    } else {
        print "      <td style=\"text-align: center\">$resultado</td>\n";
    }
    print "    </tr>\n";

    $resultado = filter_var($dato, FILTER_VALIDATE_IP);
    print "    <tr>\n";
    print "      <td>FILTER_VALIDATE_IP</td>\n";
    if ($resultado === false) {
        print "      <td style=\"text-align: center\">false</td>\n";
    } else {
        print "      <td style=\"text-align: center\">$resultado</td>\n";
    }
    print "    </tr>\n";

    $resultado = filter_var($dato, FILTER_VALIDATE_MAC);
    print "    <tr>\n";
    print "      <td>FILTER_VALIDATE_MAC</td>\n";
    if ($resultado === false) {
        print "      <td style=\"text-align: center\">false</td>\n";
    } else {
        print "      <td style=\"text-align: center\">$resultado</td>\n";
    }
    print "    </tr>\n";

    print "  </table>\n";
    print "\n";
}

print "  <p style=\"clear: both; padding-top: 1em;\"><a href=\"comprobacion-datos-filter-1.php\">Volver al formulario.</a></p>\n";
print "\n";
?>
  <footer>
    <p class="ultmod">
      Última modificación de esta página:
      <time datetime="2022-11-03">3 de noviembre de 2022</time>
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
