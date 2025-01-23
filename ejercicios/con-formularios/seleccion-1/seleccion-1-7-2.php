<?php
/**
 * Reparto de tríos (Resultado) - seleccion-1-7-2.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2025 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2025-01-09
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
    Reparto de tríos (Resultado).
    Selección (1). Con formularios.
    Ejercicios. PHP. Bartolomé Sintes Marco. www.mclibre.org
  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="mclibre-php-ejercicios.css" title="Color">
</head>

<body>
  <h1>Reparto de tríos (Resultado)</h1>

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

$jugadores = recoge("jugadores");

$jugadoresOk = false;

if ($jugadores == "") {
    print "  <p class=\"aviso\">No ha escrito el número de jugadores.</p>\n";
    print "\n";
} elseif (!is_numeric($jugadores)) {
    print "  <p class=\"aviso\">No ha escrito el número de jugadores como número.</p>\n";
    print "\n";
} elseif (!ctype_digit($jugadores)) {
    print "  <p class=\"aviso\">No ha escrito el número de jugadores "
        . "como número entero positivo.</p>\n";
    print "\n";
} elseif ($jugadores < 3 || $jugadores > 10) {
    print "  <p class=\"aviso\">El número de jugadores debe estar entre 3 y 10.</p>\n";
    print "\n";
} else {
    $jugadoresOk = true;
}

if ($jugadoresOk) {
    $c1    = [];
    $c2    = [];
    $c3    = [];
    $total = [];

    for ($i = 1; $i <= $jugadores; $i++) {
        $c1[$i]    = rand(1, 10);
        $c2[$i]    = rand(1, 10);
        $c3[$i]    = rand(1, 10);
        $total[$i] = $c1[$i] + $c2[$i] + $c3[$i];
    }

    $maximo = max($total);

    print "  <p>La puntuación máxima ha sido <strong>$maximo puntos</strong>.</p>\n";
    print "\n";

    for ($i = 1; $i <= $jugadores; $i++) {
        print "  <p>Jugador $i:\n";
        print "    <img src=\"img/c$c1[$i].svg\" alt=\"$c1[$i]\" height=\"120px\">\n";
        print "    <img src=\"img/c$c2[$i].svg\" alt=\"$c2[$i]\" height=\"120px\">\n";
        print "    <img src=\"img/c$c3[$i].svg\" alt=\"$c3[$i]\" height=\"120px\">\n";
        print "  </p>\n";
    }
    print "\n";
}
?>
  <p><a href="seleccion-1-7-1.php">Volver al formulario.</a></p>

  <footer>
    <p class="ultmod">
      Última modificación de esta página:
      <time datetime="2025-01-09">9 de enero de 2025</time>
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
