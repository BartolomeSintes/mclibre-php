<?php
/**
 * Matrices (1) 4-2 - matrices-1-4-2.php
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
    Eliminar elemento de matriz (Resultado).
    Matrices (1). Con formularios.
    Ejercicios. PHP. Bartolomé Sintes Marco. www.mclibre.org
  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="mclibre-php-ejercicios.css" title="Color">
</head>

<body>
  <h1>Eliminar elemento de matriz (Resultado)</h1>

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

$numeroMinimo = recoge("numeroMinimo");
$numeroMaximo = recoge("numeroMaximo");
$valorMinimo  = recoge("valorMinimo");
$valorMaximo  = recoge("valorMaximo");
$eliminar     = recoge("eliminar");

$valoresOk = false;

if ($numeroMinimo == "" || $numeroMaximo == "" || $valorMinimo == "" || $valorMaximo == "") {
    print "  <p class=\"aviso\">No ha escrito alguno(s) de los valores.</p>\n";
    print "\n";
} elseif (!is_numeric($numeroMinimo) || !is_numeric($numeroMaximo) || !is_numeric($valorMinimo) || !is_numeric($valorMaximo) || !is_numeric($eliminar)) {
    print "  <p class=\"aviso\">No ha escrito alguno(s) de los valores como número.</p>\n";
    print "\n";
} elseif (!ctype_digit($numeroMinimo) || !ctype_digit($numeroMaximo) || !ctype_digit($valorMinimo) || !ctype_digit($valorMaximo) || !ctype_digit($eliminar)) {
    print "  <p class=\"aviso\">No ha escrito alguno(s) de los valores  como número entero.</p>\n";
    print "\n";
} elseif ($numeroMinimo < 1 || $numeroMaximo < 1 || $valorMinimo < 0 || $valorMaximo < 0 || $eliminar < 0) {
    print "  <p class=\"aviso\">Alguno de los valores no está en el rango previsto.</p>\n";
    print "\n";
} else {
    $valoresOk = true;
}

if ($valoresOk) {
    $numeroValores = rand($numeroMinimo, $numeroMaximo);
    print "  <h2>Datos iniciales</h2>\n";
    print "\n";
    print "  <p>Número de valores en la matriz: $numeroValores</p>\n";
    print "\n";
    print "  <p>Valores elegidos al azar entre $valorMinimo y $valorMaximo</p>\n";
    print "\n";

    // Crea la matriz inicial
    $matriz = [];
    for ($i = 0; $i < $numeroValores; $i++) {
        $matriz[] = rand($valorMinimo, $valorMaximo);
    }

    print "  <h2>Matriz inicial de valores</h2>\n";
    print "\n";
    print "  <pre>\n";
    print_r($matriz);
    print "</pre>\n";
    print "\n";

    // Elimina los valores que coinciden con el indicado
    print "  <h2>Matriz con valor eliminado</h2>\n";
    print "\n";
    if ($eliminar == "") {
        print "  <p>No se ha solicitado ordenar la matriz</p>\n";
        print "\n";
    } elseif (!in_array($eliminar, $matriz)) {
        print "  <p>Valor a eliminar: $eliminar</p>\n";
        print "\n";
        print "  <p>El valor indicado no se encuentra en la matriz</p>\n";
        print "\n";
    } else {
        for ($i = 0; $i < $numeroValores; $i++) {
            if ($matriz[$i] == $eliminar) {
                unset($matriz[$i]);
            }
        }
        $matriz = array_values($matriz);
        print "  <p>Valor a eliminar: $eliminar</p>\n";
        print "\n";
        print "  <p>Se han eliminado " . $numeroValores - count($matriz) . " valor(es).</p>\n";
        print "\n";
        print "  <pre>\n";
        print_r($matriz);
        print "</pre>\n";
        print "\n";
    }
}

?>
  <p><a href="matrices-1-4-1.php">Volver al formulario.</a></p>

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
