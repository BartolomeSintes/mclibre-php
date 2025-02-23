<?php
/**
 * Buscador en la Wikipedia - funciones-1-5-ws-2.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2025 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2025-02-14
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
    Buscador en la Wikipedia (Resultado).
    Funciones (1). Funciones.
    Ejercicios. PHP. Bartolomé Sintes Marco. www.mclibre.org
  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="mclibre-php-ejercicios.css" title="Color">
</head>

<body>
  <h1>Buscador en la Wikipedia (Resultado)</h1>

<?php
// Función de recogida de datos
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

$camino = "https://es.wikipedia.org/w/api.php?action=opensearch&prop=extracts&format=json&formatversion=2&srwhat=title";

$cadena = recoge("cadena");

$cadenaOk = false;

if ($cadena == "") {
    print "  <p class=\"aviso\">No ha escrito nada.</p>\n";
    print "\n";
} else {
    $cadenaOk = true;
}

if ($cadenaOk) {
    print "  <p>Artículos de la Wikipedia relacionados con <strong>$cadena</strong>.</p>\n";
    print "\n";

    $consulta  = http_build_query(["search" => $cadena]);
    $respuesta = json_decode(file_get_contents("{$camino}&$consulta"));
    // print "  <pre>\n" . print_r($respuesta, true) . "</pre>\n";

    $respuestas = count($respuesta[1]);

    if ($respuestas == 0) {
        print "  <p>No se ha encontrado nada</p>\n";
        print "\n";
    } else {
        print "  <ul>\n";
        for ($i = 0; $i < $respuestas; $i++) {
            print "    <li><a href=\"{$respuesta[3][$i]}\">{$respuesta[1][$i]}</a>\n";
            print "      <p>{$respuesta[2][$i]}</p>\n";
            print "    </li>\n";
        }
        print "  </ul>\n";
        print "\n";
    }
}
?>
  <p><a href="funciones-1-5-ws-1.php">Volver al formulario.</a></p>

  <footer>
    <p class="ultmod">
      Última modificación de esta página:
      <time datetime="2025-02-14">14 de febrero de 2025</time>
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
