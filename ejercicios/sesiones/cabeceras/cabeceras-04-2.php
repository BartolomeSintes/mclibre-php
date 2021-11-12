<?php
/**
 * Formulario 4-2 - cabeceras-04-2.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2019 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2019-11-10
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

function recoge($var, $m = "")
{
    if (!isset($_REQUEST[$var])) {
        $tmp = (is_array($m)) ? [] : "";
    } elseif (!is_array($_REQUEST[$var])) {
        $tmp = trim(htmlspecialchars($_REQUEST[$var], ENT_QUOTES, "UTF-8"));
    } else {
        $tmp = $_REQUEST[$var];
        array_walk_recursive($tmp, function (&$valor) {
            $valor = trim(htmlspecialchars($valor, ENT_QUOTES, "UTF-8"));
        });
    }
    return $tmp;
}

// Recogemos la edad
$edad   = recoge("edad");

$edadOk = false;

// Comprobamos la edad. Si detectamos un error, volvemos al formulario enviando el aviso correspondiente y la edad
if ($edad == "") {
    header("Location:cabeceras-04-1.php?aviso=No ha escrito su edad&edad=$edad");
    exit;
} elseif (!is_numeric($edad)) {
    header("Location:cabeceras-04-1.php?aviso=No ha escrito su edad como número&edad=$edad");
    exit;
} elseif (!ctype_digit($edad)) {
    header("Location:cabeceras-04-1.php?aviso=No ha escrito su edad como número entero&edad=$edad");
    exit;
} elseif ($edad < 18 || $edad > 130) {
    header("Location:cabeceras-04-1.php?aviso=Su edad no está entre 18 y 130 años&edad=$edad");
    exit;
} else {
    $edadOk = true;
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>
    Formulario 4 (Resultado).
    Cabeceras. Sesiones.
    Ejercicios. PHP. Bartolomé Sintes Marco. www.mclibre.org
  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="mclibre-php-ejercicios.css" title="Color">
</head>

<body>
  <h1>Formulario 4 (Resultado)</h1>

<?php
// Si la edad es correcta, la mostramos
if ($edadOk) {
    print "  <p>Su edad es <strong>$edad</strong> años.</p>\n";
    print "\n";
}

?>
  <p><a href="cabeceras-04-1.php">Volver al formulario.</a></p>

  <footer>
    <p class="ultmod">
      Última modificación de esta página:
      <time datetime="2019-11-10">10 de noviembre de 2019</time>
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
