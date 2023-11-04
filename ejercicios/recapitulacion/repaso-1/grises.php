<?php
/**
 * Grises - grises.php
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
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>
    Grises. Repaso (1).
    Ejercicios. PHP. Bartolomé Sintes Marco. www.mclibre.org
  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="mclibre-php-ejercicios.css" title="Color">
</head>

<body>
  <h1>Grises</h1>

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
$mas     = recoge("mas");
$menos   = recoge("menos");
$gris    = recoge("gris");
$masOk   = false;
$menosOk = false;

// Validación de datos recibidos
if ($gris == "") {
    $gris = 127;
} elseif (!is_numeric($gris)) {
    $gris = 127;
} elseif ($gris < 0) {
    $gris = 0;
} elseif ($gris > 255) {
    $gris = 255;
}

// Oscurecer es disminuir el color
if ($mas != "" && $gris >= 10) {
    $gris -= 10;
}

// Aclarar es aumentar el color
if ($menos != "" && $gris <= 245) {
    $gris += 10;
}

print "  <p>Haga clic en los iconos para oscurecer o aclarar el color gris del cuadro.</p>\n";
print "\n";

// Se genera el formulario
print "  <form action=\"$_SERVER[PHP_SELF]\" method=\"get\">\n";
print "    <table style=\"margin-left: auto; margin-right: auto;\">\n";
print "      <tr>\n";
print "        <td><input type=\"submit\" name=\"mas\" value=\"+\" style=\"font-size: 300%\"></td>\n";
print "        <td style=\"width: 100px; height: 100px; background-color: rgb($gris $gris $gris)\"></td>\n";
print "        <td><input type=\"submit\" name=\"menos\" value=\"-\" style=\"font-size: 300%\"></td>\n";
print "      </tr>\n";
print "    </table>\n";
print "\n";
print "    <p><input type=\"hidden\" name=\"gris\" value=\"$gris\">\n";
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
