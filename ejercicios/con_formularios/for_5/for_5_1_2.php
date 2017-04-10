<?php
/**
 * Dibujos con líneas (Resultado) - for_5_1_2.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2015 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2015-10-22
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
    <meta charset="utf-8" />
    <title>Dibujos con líneas (Resultado). for (5).
      Ejercicios. PHP. Bartolomé Sintes Marco</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="mclibre_php_soluciones.css" rel="stylesheet" type="text/css" title="Color" />
  </head>

  <body>
    <h1>Dibujos con líneas (Resultado)</h1>

<?php
function recoge($var)
{
    $tmp = (isset($_REQUEST[$var]))
        ? trim(htmlspecialchars($_REQUEST[$var], ENT_QUOTES, "UTF-8"))
        : "";
    return $tmp;
}

$lineas = recoge("lineas");

$lineasOk = false;

$lineasMinimo = 1;
$lineasMaximo = 50;

if ($lineas == "") {
    print "    <p class=\"aviso\">No ha escrito el número de líneas.</p>\n\n";
} elseif (!is_numeric($lineas)) {
    print "    <p class=\"aviso\">No ha escrito el número de líneas como número.</p>\n\n";
} elseif (!ctype_digit($lineas)) {
    print "    <p class=\"aviso\">No ha escrito el número de líneas "
        . "como número entero positivo.</p>\n\n";
} elseif ($lineas < $lineasMinimo || $lineas > $lineasMaximo) {
    print "    <p class=\"aviso\">El número de líneas debe estar entre "
        . "$lineassMinimo y $lineasMaximo.</p>\n\n";
} else {
    $lineasOk = true;
}

if ($lineasOk) {
    $margenDibujo = 5;
    $hueco        = 10;
    $colorFondo   = "white";

    // Dibujo nº 1
    $largoDibujo = $hueco * ($lineas - 1);

    print "    <h2>Dibujo nº 1</h2>\n";
    print "\n";
    print "    <svg version=\"1.1\" xmlns=\"http://www.w3.org/2000/svg\" \n"
        . "      width=\"" . ($largoDibujo + 2 * $margenDibujo) . "\" "
        . "height=\"" . ($largoDibujo + 2 * $margenDibujo) . "\" "
        . "viewBox=\"-$margenDibujo -$margenDibujo "
        . ($largoDibujo + 2 * $margenDibujo) . " " . ($largoDibujo + 2 * $margenDibujo) . "\" \n"
        . "      stroke-width=\"1\" stroke=\"black\" style=\"background-color: $colorFondo\"> \n";
    for ($i = 0; $i < $lineas; $i++) {
        print "      <line "
            . "x1=\"" . $hueco * $i . "\" "
            . "y1=\"0\" "
            . "x2=\"" . $hueco * $i . "\" "
            . "y2=\"$largoDibujo\" />\n";
    }
    print "    </svg>\n";
    print "\n";

    // Dibujo nº 2
    $largoDibujo  = $hueco * ($lineas - 1);

    print "    <h2>Dibujo nº 2</h2>\n";
    print "\n";
    print "    <svg version=\"1.1\" xmlns=\"http://www.w3.org/2000/svg\" \n"
        . "      width=\"" . ($largoDibujo + 2 * $margenDibujo) . "\" "
        . "height=\"" . ($largoDibujo + 2 * $margenDibujo) . "\" "
        . "viewBox=\"-$margenDibujo -$margenDibujo "
        . ($largoDibujo + 2 * $margenDibujo) . " " . ($largoDibujo + 2 * $margenDibujo) . "\" \n"
        . "      stroke-width=\"1\" stroke=\"black\" style=\"background-color: $colorFondo\"> \n";
    for ($i = 0; $i < $lineas; $i++) {
        print "      <line "
            . "x1=\"0\" "
            . "y1=\"" . $hueco * $i . "\" "
            . "x2=\"$largoDibujo\" "
            . "y2=\"". $hueco * $i . "\" />\n";
    }
    print "    </svg>\n";
    print "\n";

    // Dibujo nº 3
    $largoDibujo  = $hueco * ($lineas - 1);

    print "    <h2>Dibujo nº 3</h2>\n";
    print "\n";
    print "    <svg version=\"1.1\" xmlns=\"http://www.w3.org/2000/svg\" \n"
        . "      width=\"" . ($largoDibujo + 2 * $margenDibujo) . "\" "
        . "height=\"" . ($largoDibujo + 2 * $margenDibujo) . "\" "
        . "viewBox=\"-$margenDibujo -$margenDibujo "
        . ($largoDibujo + 2 * $margenDibujo) . " " . ($largoDibujo + 2 * $margenDibujo) . "\" \n"
        . "      stroke-width=\"1\" stroke=\"black\" style=\"background-color: $colorFondo\"> \n";
    for ($i = 0; $i < $lineas; $i++) {
        print "      <line "
            . "x1=\"0\" "
            . "y1=\"" . $hueco * $i . "\" "
            . "x2=\"". $hueco * $i . "\" "
            . "y2=\"0\" />\n";
    }
    print "    </svg>\n";
    print "\n";

    // Dibujo nº 4
    $largoDibujo  = $hueco * ($lineas - 1);

    print "    <h2>Dibujo nº 4</h2>\n";
    print "\n";
    print "    <svg version=\"1.1\" xmlns=\"http://www.w3.org/2000/svg\" \n"
        . "      width=\"" . ($largoDibujo + 2 * $margenDibujo) . "\" "
        . "height=\"" . ($largoDibujo + 2 * $margenDibujo) . "\" "
        . "viewBox=\"-$margenDibujo -$margenDibujo "
        . ($largoDibujo + 2 * $margenDibujo) . " " . ($largoDibujo + 2 * $margenDibujo) . "\" \n"
        . "      stroke-width=\"1\" stroke=\"black\" style=\"background-color: $colorFondo\"> \n";
    for ($i = 0; $i < $lineas; $i++) {
        print "      <line "
            . "x1=\"0\" "
            . "y1=\"0\" "
            . "x2=\"$largoDibujo\" "
            . "y2=\"". $hueco * $i . "\" />\n";
    }
    print "    </svg>\n";
    print "\n";

    // Dibujo nº 5
    $largoDibujo  = $hueco * ($lineas - 1);

    print "    <h2>Dibujo nº 5</h2>\n";
    print "\n";
    print "    <svg version=\"1.1\" xmlns=\"http://www.w3.org/2000/svg\" \n"
        . "      width=\"" . ($largoDibujo + 2 * $margenDibujo) . "\" "
        . "height=\"" . ($largoDibujo + 2 * $margenDibujo) . "\" "
        . "viewBox=\"-$margenDibujo -$margenDibujo "
        . ($largoDibujo + 2 * $margenDibujo) . " " . ($largoDibujo + 2 * $margenDibujo) . "\" \n"
        . "      stroke-width=\"1\" stroke=\"black\" style=\"background-color: $colorFondo\"> \n";
    for ($i = 0; $i < $lineas; $i++) {
        print "      <line "
            . "x1=\"0\" "
            . "y1=\"". $hueco * $i . "\" "
            . "x2=\"$largoDibujo\" "
            . "y2=\"". ($largoDibujo - $hueco * $i) . "\" />\n";
    }
    print "    </svg>\n";
    print "\n";
}

?>
    <p><a href="for_5_1_1.php">Volver al formulario.</a></p>

    <footer>
      <p class="ultmod">
        Última modificación de esta página:
        <time datetime="2016-11-06">6 de noviembre de 2016</time></p>

      <p class="licencia">
        Este programa forma parte del curso <a href="http://www.mclibre.org/consultar/php/">
        Programación web en PHP</a> por <a href="http://www.mclibre.org/">Bartolomé
        Sintes Marco</a>.<br />
        El programa PHP que genera esta página está bajo
        <a rel="license" href="http://www.gnu.org/licenses/agpl.txt">licencia AGPL 3 o posterior</a>.</p>
    </footer>
  </body>
</html>
