<?php
/**
 * Controles en formularios (2) 11-2 - controles-formularios-2-11-2.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2022 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2022-10-10
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
    Cuadrado con bordes redondeados (Resultado).
    Controles en formularios (2). Con formularios.
    Ejercicios. PHP. Bartolomé Sintes Marco. www.mclibre.org
  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="mclibre-php-ejercicios.css" title="Color">
</head>

<body>
  <h1>Cuadrado con bordes redondeados (Resultado)</h1>

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

$lado    = recoge("lado");
$esquina = recoge("esquina");

$ladoOk    = false;
$esquinaOk = false;

if ($lado == "") {
    print "  <p class=\"aviso\">No ha escrito el tamaño del lado.</p>\n";
    print "\n";
} elseif (!is_numeric($lado)) {
    print "  <p class=\"aviso\">No ha escrito el tamaño del lado como número.</p>\n";
    print "\n";
} elseif (!ctype_digit($lado)) {
    print "  <p class=\"aviso\">No ha escrito el tamaño del lado como número entero.</p>\n";
    print "\n";
} elseif ($lado < 20 || $lado > 500) {
    print "  <p class=\"aviso\">El tamaño del lado no está entre 20 y 500 px.</p>\n";
    print "\n";
} else {
    $ladoOk = true;
}

if ($esquina == "") {
    print "  <p class=\"aviso\">No ha escrito el tamaño de la esquina.</p>\n";
    print "\n";
} elseif (!is_numeric($esquina)) {
    print "  <p class=\"aviso\">No ha escrito el tamaño de la esquina como número.</p>\n";
    print "\n";
} elseif (!ctype_digit($esquina)) {
    print "  <p class=\"aviso\">No ha escrito el tamaño de la esquina como número entero.</p>\n";
    print "\n";
} elseif ($esquina < 10 || $esquina > 250) {
    print "  <p class=\"aviso\">El tamaño de la esquina no está entre 20 y 500 px.</p>\n";
    print "\n";
} else {
    $esquinaOk = true;
}

if ($ladoOk && $esquinaOk) {
    if ($lado < $esquina * 2) {
        print "  <p class=\"aviso\">El tamaño del lado debe ser al menos el doble que el de la esquina.</p>\n";
        print "\n";
        $ladoOk    = false;
        $esquinaOk = false;
    }
}

if ($ladoOk && $esquinaOk) {
    print "  <svg version=\"1.1\" xmlns=\"http://www.w3.org/2000/svg\" \n"
        . "    width=\"" . $lado + 10 . "px\" height=\"" . $lado + 10 . "px\">\n";
    print "    <rect fill=\"white\" stroke=\"black\" stroke-width=\"10\" "
    . "x=\"5\" y=\"5\" width=\"$lado\" height=\"$lado\" rx=\"$esquina\" ry=\"$esquina\" />\n";
    print "  </svg>\n";
    print "\n";
}
?>
  <p><a href="controles-formularios-2-11-1.php">Volver al formulario.</a></p>

  <footer>
    <p class="ultmod">
      Última modificación de esta página:
      <time datetime="2022-10-10">10 de octubre de 2022</time>
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
