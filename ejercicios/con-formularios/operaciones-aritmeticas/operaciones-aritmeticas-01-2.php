<?php
/**
 * Operaciones aritmeticas 1-2 - operaciones-aritmeticas-01-2.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2025 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2025-02-08
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
    Índice de masa corporal (Resultado).
    Operaciones aritméticas. Con formularios.
    Ejercicios. PHP. Bartolomé Sintes Marco. www.mclibre.org
  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="mclibre-php-ejercicios.css" title="Color">
</head>

<body>
  <h1>Índice de masa corporal (Resultado)</h1>

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

$peso   = recoge("peso");
$altura = recoge("altura");

$pesoOk   = false;
$alturaOk = false;

if ($peso == "") {
    print "  <p class=\"aviso\">No ha escrito su peso.</p>\n";
    print "\n";
} elseif (!is_numeric($peso)) {
    print "  <p class=\"aviso\">No ha escrito su peso como número.</p>\n";
    print "\n";
} elseif ($peso <= 0) {
    print "  <p class=\"aviso\">El peso no puede ser negativo o cero.</p>\n";
    print "\n";
} else {
    $pesoOk = true;
}

if ($altura == "") {
    print "  <p class=\"aviso\">No ha escrito su altura.</p>\n";
    print "\n";
} elseif (!ctype_digit($altura)) {
    print "  <p class=\"aviso\">No ha escrito su altura como número entero positivo.</p>\n";
    print "\n";
} elseif ($altura == 0) {
    print "  <p class=\"aviso\">La altura no puede ser cero.</p>\n";
    print "\n";
} else {
    $alturaOk = true;
}

if ($pesoOk && $alturaOk) {
    $imc = round($peso / ($altura / 100) ** 2);
    print "  <p>Con un peso de <strong>$peso kg</strong> y una altura de <strong>$altura cm</strong>, su índice de masa corporal es <strong>$imc</strong>.</p>\n";
    print "\n";
    print "  <p>Un imc muy alto indica obesidad. Los valores \"normales\" de imc están entre 20 y 25, pero esos límites dependen de la edad, del sexo, de la constitución física, etc.</p>\n";
    print "\n";
}
?>
  <p><a href="operaciones-aritmeticas-01-1.php">Volver al formulario.</a></p>

  <footer>
    <p class="ultmod">
      Última modificación de esta página:
      <time datetime="2025-02-08">8 de febrero de 2025</time>
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
