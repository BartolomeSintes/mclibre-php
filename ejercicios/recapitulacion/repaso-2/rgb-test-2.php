<?php
/**
 * RGB Test - rgb-test-2.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2023 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2023-09-26
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

session_name("rgb-test-2");
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>
    RGB Test 2. Repaso (2).
    Ejercicios. PHP. Bartolomé Sintes Marco. www.mclibre.org
  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="mclibre-php-ejercicios.css" title="Color">
  <style>
    form span { font-size: 300%; display: block; width: 100px; height: 100px; }
  </style>
</head>

<body>
  <h1>RGB Test 2</h1>

<?php
// Funciones auxiliares
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

// Recogida de datos
$respuesta = recoge("respuesta");

// Cuerpo del programa

// Si no se recibe respuesta, no se dice si se ha acertado o no
if ($respuesta == "1" || $respuesta == "2" || $respuesta == "3" || $respuesta == "4") {
    if ($respuesta == $_SESSION["solucion"]) {
        print "  <p>¡Enhorabuena! Has contestado correctamente.</p>\n";
        print "\n";
        $color = [];
        for ($i = 1; $i <= 4; $i++) {
            $color[$i] = "rgb(" . rand(0, 255) . " " . rand(0, 255) . " " . rand(0, 255) . ")";
        }

        $solucion = rand(1, 4);
        $_SESSION["solucion"] = $solucion;
        for ($i = 1; $i <= 4; $i++) {
            $_SESSION["c" . $i] = $color[$i];
        }
    } else {
        print "  <p>Lo siento, no has acertado. Inténtalo de nuevo.</p>\n";
        print "\n";
        $solucion = $_SESSION["solucion"];
        for ($i = 1; $i <= 4; $i++) {
            $color[$i] = $_SESSION["c" . $i];
        }
    }
} else {
    $color = [];
    for ($i = 1; $i <= 4; $i++) {
        $color[$i] = "rgb(" . rand(0, 255) . " " . rand(0, 255) . " " . rand(0, 255) . ")";
    }

    $solucion = rand(1, 4);
    $_SESSION["solucion"] = $solucion;
    for ($i = 1; $i <= 4; $i++) {
        $_SESSION["c" . $i] = $color[$i];
    }
}

// Se genera el formulario
print "  <form action=\"$_SERVER[PHP_SELF]\" method=\"get\">\n";
print "    <p>¿Qué color corresponde al código <strong>$color[$solucion]</strong>?</p>\n";
print "\n";

print "    <p>\n";
for ($i = 1; $i <= 4; $i++) {
    print "      <button type=\"submit\" name=\"respuesta\" value=\"$i\"> "
    . "<span style=\"background-color: $color[$i];\"></span></button>\n";
}
print "    </p>\n";
print "  </form>\n";
print "\n";
?>
  <footer>
    <p class="ultmod">
      Última modificación de esta página:
      <time datetime="2023-09-26">26 de septiembre de 2023</time>
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
