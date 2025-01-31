<?php
/**
 * Puntos en cuadrantes - puntos-en-cuadrantes-2.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2025 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2025-01-09
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
  <meta charset="utf-8">
  <title>Puntos en cuadrantes.
    Selección (1). Con formularios.
    Ejercicios. PHP. Bartolomé Sintes Marco. www.mclibre.org
  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="mclibre-php-ejercicios.css" title="Color">
</head>

<body>
  <h1>Puntos en cuadrantes (Resultado)</h1>

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

$cantidad  = recoge("cantidad");
$cuadrante = recoge("cuadrante");

$cantidadOk  = false;
$cuadranteOk = false;

if ($cantidad == "") {
    print "  <p class=\"aviso\">No ha escrito el número de puntos.</p>\n";
    print "\n";
} elseif (!is_numeric($cantidad)) {
    print "  <p class=\"aviso\">No ha escrito el número de puntos como número.</p>\n";
    print "\n";
} elseif (!ctype_digit($cantidad)) {
    print "  <p class=\"aviso\">No ha escrito el número de puntos como número entero.</p>\n";
    print "\n";
} elseif ($cantidad < 3 || $cantidad > 12) {
    print "  <p class=\"aviso\">El número de puntos solicitado no está en el rango permitido.</p>\n";
    print "\n";
} else {
    $cantidadOk = true;
}

if ($cuadrante                                        != "Arriba a la derecha" && $cuadrante != "Abajo a la derecha"
                                        && $cuadrante != "Abajo a la izquierda" && $cuadrante != "Arriba a la izquierda") {
    print "  <p class=\"aviso\">El cuadrante solicitado no es uno de los permitidos.</p>\n";
    print "\n";
} else {
    $cuadranteOk = true;
}

if ($cantidadOk && $cuadranteOk) {
    print "  <p>\n";
    print "    <svg version=\"1.1\" xmlns=\"http://www.w3.org/2000/svg\" \n";
    print "      width=\"400\" height=\"400\" viewBox=\"-200 -200 400 400\" \n";
    print "      style=\"border: black 1px solid\" >\n";
    print "      <line x1=\"0\" y1=\"-200\" x2=\"0\" y2=\"200\" stroke-width=\"1\" stroke=\"blue\" />\n";
    print "      <line x1=\"-200\" y1=\"0\" x2=\"200\" y2=\"0\" stroke-width=\"1\" stroke=\"blue\" />\n";
    $hayPuntos = false;
    for ($i = 0; $i < $cantidad; $i++) {
        $px = rand(-200, 200);
        $py = rand(-200, 200);
        print "      <circle cx=\"$px\" cy=\"$py\" r=\"2\" fill=\"red\" />\n";
        if ($cuadrante == "Arriba a la derecha" && $px >= 0 && $py <= 0) {
            $hayPuntos = true;
        } elseif ($cuadrante == "Abajo a la derecha" && $px >= 0 && $py >= 0) {
            $hayPuntos = true;
        } elseif ($cuadrante == "Abajo a la izquierda" && $px <= 0 && $py >= 0) {
            $hayPuntos = true;
        } elseif ($cuadrante == "Arriba a la izquierda" && $px <= 0 && $py <= 0) {
            $hayPuntos = true;
        }
    }
    print "    </svg>\n";
    print "  </p>\n";
    print "\n";

    if ($hayPuntos) {
        print "  <p>Hay puntos $cuadrante.</p>\n";
    } else {
        print "  <p>No hay puntos $cuadrante.</p>\n";
    }
}
?>

  <p><a href="seleccion-1-3-1.php">Volver al formulario.</a></p>

  <footer>
    <p class="ultmod">
      Última modificación de esta página:
      <time datetime="2025-01-09">9 de enero de 2025</time>
    </p>

    <p class="licencia">
      Este programa forma parte del curso <strong><a href="http://www.mclibre.org/consultar/php/">Programación
      web en PHP</a></strong> de <a href="http://www.mclibre.org/" rel="author" >Bartolomé Sintes Marco</a>.<br>
      El programa PHP que genera esta página se distribuye bajo
      <a rel="license" href="http://www.gnu.org/licenses/agpl.txt">licencia AGPL 3 o posterior</a>.
    </p>
  </footer>
</body>
</html>
