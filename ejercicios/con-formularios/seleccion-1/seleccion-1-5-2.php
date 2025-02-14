<?php
/**
 * if ... elseif ... else ... 6-2 - if-else-6-2.php
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
    Convertidor de temperaturas Celsius / Fahrenheit (Resultado).
    Selección (1). Con formularios.
    Ejercicios. PHP. Bartolomé Sintes Marco. www.mclibre.org
  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="mclibre-php-ejercicios.css" title="Color">
</head>

<body>
  <h1>Convertidor de temperaturas Celsius / Fahrenheit (Resultado)</h1>

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

$temperatura = recoge("temperatura");
$unidad      = recoge("unidad");

$temperaturaOk = false;
$unidadOk      = false;

if ($temperatura == "") {
    print "  <p class=\"aviso\">No ha escrito la temperatura.</p>\n";
    print "\n";
} elseif (!is_numeric($temperatura)) {
    print "  <p class=\"aviso\">No ha escrito la temperatura como número.</p>\n";
    print "\n";
} elseif ($temperatura < -273.15 && $unidad == "c") {
    print "  <p class=\"aviso\">Una temperatura no puede ser tan baja.</p>\n";
    print "\n";
} elseif ($temperatura < -459.67 && $unidad == "f") {
    print "  <p class=\"aviso\">Una temperatura no puede ser tan baja.</p>\n";
    print "\n";
} elseif ($temperatura >= 10000) {
    print "  <p class=\"aviso\">La temperatura no es inferior a 10.000.</p>\n";
    print "\n";
} else {
    $temperaturaOk = true;
}

if ($unidad != "c" && $unidad != "f") {
    print "  <p class=\"aviso\">La unidad no es correcta.</p>\n";
    print "\n";
} else {
    $unidadOk = true;
}

if ($temperaturaOk && $unidadOk) {
    if ($unidad == "c") {
        $fahrenheit = round(1.8 * $temperatura + 32, 2);
        print "  <p>$temperatura ºC son $fahrenheit ºF</p>\n";
        print "\n";
    } else {
        $celsius = round(($temperatura - 32) / 1.8, 2);
        print "  <p>$temperatura ºF son $celsius ºC</p>\n";
        print "\n";
    }
}
?>
  <p><a href="seleccion-1-5-1.php">Volver al formulario.</a></p>

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
