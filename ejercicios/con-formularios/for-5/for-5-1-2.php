<?php
/**
 * Dibujos con líneas (Resultado) - for-5-1-2.php
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
    Dibujos con líneas (Resultado). for (5).
    Ejercicios. PHP. Bartolomé Sintes Marco. www.mclibre.org
  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="mclibre-php-ejercicios.css" title="Color">
</head>

<body>
  <h1>Dibujos con líneas (Resultado)</h1>

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

$lineas = recoge("lineas");

$lineasOk = false;

$lineasMinimo = 1;
$lineasMaximo = 50;

if ($lineas == "") {
    print "  <p class=\"aviso\">No ha escrito el número de líneas.</p>\n";
    print "\n";
} elseif (!is_numeric($lineas)) {
    print "  <p class=\"aviso\">No ha escrito el número de líneas como número.</p>\n";
    print "\n";
} elseif (!ctype_digit($lineas)) {
    print "  <p class=\"aviso\">No ha escrito el número de líneas como número entero positivo.</p>\n";
    print "\n";
} elseif ($lineas < $lineasMinimo || $lineas > $lineasMaximo) {
    print "  <p class=\"aviso\">El número de líneas debe estar entre $lineasMinimo y $lineasMaximo.</p>\n";
    print "\n";
} else {
    $lineasOk = true;
}

if ($lineasOk) {
    $margenDibujo = 5;
    $hueco        = 10;
    $colorFondo   = "white";

    // Dibujo nº 1
    $largoDibujo = $hueco * ($lineas - 1);

    print "  <h2>Dibujo nº 1</h2>\n";
    print "\n";

    print "  <svg version=\"1.1\" xmlns=\"http://www.w3.org/2000/svg\"\n";
    print "       width=\"" . $largoDibujo + 2 * $margenDibujo . "\"\n";
    print "       height=\"" . $largoDibujo + 2 * $margenDibujo . "\"\n";
    print "       viewBox=\"-$margenDibujo -$margenDibujo " . $largoDibujo + 2 * $margenDibujo . " " . $largoDibujo + 2 * $margenDibujo . "\"\n";
    print "       stroke-width=\"1\" stroke=\"black\" style=\"background-color: $colorFondo\">\n";
    for ($i = 0; $i < $lineas; $i++) {
        print "    <line ";
        print "x1=\"" . $hueco * $i . "\" ";
        print "y1=\"0\" ";
        print "x2=\"" . $hueco * $i . "\" ";
        print "y2=\"$largoDibujo\" />\n";
    }
    print "  </svg>\n";
    print "\n";

    // Dibujo nº 2
    $largoDibujo = $hueco * ($lineas - 1);

    print "  <h2>Dibujo nº 2</h2>\n";
    print "\n";

    print "  <svg version=\"1.1\" xmlns=\"http://www.w3.org/2000/svg\"\n";
    print "       width=\"" . $largoDibujo + 2 * $margenDibujo . "\"\n";
    print "       height=\"" . $largoDibujo + 2 * $margenDibujo . "\"\n";
    print "       viewBox=\"-$margenDibujo -$margenDibujo " . $largoDibujo + 2 * $margenDibujo . " " . $largoDibujo + 2 * $margenDibujo . "\"\n";
    print "       stroke-width=\"1\" stroke=\"black\" style=\"background-color: $colorFondo\">\n";
    for ($i = 0; $i < $lineas; $i++) {
        print "    <line ";
        print "x1=\"0\" ";
        print "y1=\"" . $hueco * $i . "\" ";
        print "x2=\"$largoDibujo\" ";
        print "y2=\"" . $hueco * $i . "\" />\n";
    }
    print "  </svg>\n";
    print "\n";

    // Dibujo nº 3
    $largoDibujo = $hueco * ($lineas - 1);

    print "  <h2>Dibujo nº 3</h2>\n";
    print "\n";

    print "  <svg version=\"1.1\" xmlns=\"http://www.w3.org/2000/svg\"\n";
    print "       width=\"" . $largoDibujo + 2 * $margenDibujo . "\"\n";
    print "       height=\"" . $largoDibujo + 2 * $margenDibujo . "\"\n";
    print "       viewBox=\"-$margenDibujo -$margenDibujo " . $largoDibujo + 2 * $margenDibujo . " " . $largoDibujo + 2 * $margenDibujo . "\"\n";
    print "       stroke-width=\"1\" stroke=\"black\" style=\"background-color: $colorFondo\">\n";
    for ($i = 0; $i < $lineas; $i++) {
        print "    <line ";
        print "x1=\"0\" ";
        print "y1=\"" . $hueco * $i . "\" ";
        print "x2=\"" . $hueco * $i . "\" ";
        print "y2=\"0\" />\n";
    }
    print "  </svg>\n";
    print "\n";

    // Dibujo nº 4
    $largoDibujo = $hueco * ($lineas - 1);

    print "  <h2>Dibujo nº 4</h2>\n";
    print "\n";

    print "  <svg version=\"1.1\" xmlns=\"http://www.w3.org/2000/svg\"\n";
    print "       width=\"" . $largoDibujo + 2 * $margenDibujo . "\"\n";
    print "       height=\"" . $largoDibujo + 2 * $margenDibujo . "\"\n";
    print "       viewBox=\"-$margenDibujo -$margenDibujo " . $largoDibujo + 2 * $margenDibujo . " " . $largoDibujo + 2 * $margenDibujo . "\"\n";
    print "       stroke-width=\"1\" stroke=\"black\" style=\"background-color: $colorFondo\">\n";
    for ($i = 0; $i < $lineas; $i++) {
        print "    <line ";
        print "x1=\"0\" ";
        print "y1=\"0\" ";
        print "x2=\"$largoDibujo\" ";
        print "y2=\"" . $hueco * $i . "\" />\n";
    }
    print "  </svg>\n";
    print "\n";

    // Dibujo nº 5
    $largoDibujo = $hueco * ($lineas - 1);

    print "  <h2>Dibujo nº 5</h2>\n";
    print "\n";

    print "  <svg version=\"1.1\" xmlns=\"http://www.w3.org/2000/svg\"\n";
    print "       width=\"" . $largoDibujo + 2 * $margenDibujo . "\"\n";
    print "       height=\"" . $largoDibujo + 2 * $margenDibujo . "\"\n";
    print "       viewBox=\"-$margenDibujo -$margenDibujo " . $largoDibujo + 2 * $margenDibujo . " " . $largoDibujo + 2 * $margenDibujo . "\"\n";
    print "       stroke-width=\"1\" stroke=\"black\" style=\"background-color: $colorFondo\">\n";
    for ($i = 0; $i < $lineas; $i++) {
        print "    <line ";
        print "x1=\"0\" ";
        print "y1=\"" . $hueco * $i . "\" ";
        print "x2=\"$largoDibujo\" ";
        print "y2=\"" . $largoDibujo - $hueco * $i . "\" />\n";
    }
    print "  </svg>\n";
    print "\n";
}
?>
  <p><a href="for-5-1-1.php">Volver al formulario.</a></p>

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
