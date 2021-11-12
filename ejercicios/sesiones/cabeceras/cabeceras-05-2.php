<?php
/**
 * Formulario 5-2 - cabeceras-05-2.php
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

// Recogemos el nombre y la edad
$nombre      = recoge("nombre");
$edad        = recoge("edad");

$nombreOk    = false;
$edadOk      = false;

$avisoNombre = "";
$avisoEdad   = "";

// Comprobamos el nombre. Si detectamos un error, guardamos el aviso correspondiente
if ($nombre == "") {
    $avisoNombre = "No ha escrito su nombre";
} else {
    $nombreOk = true;
}

// Comprobamos la edad. Si detectamos un error, guardamos el aviso correspondiente
if ($edad == "") {
    $avisoEdad = "No ha escrito su edad";
} elseif (!is_numeric($edad)) {
    $avisoEdad = "No ha escrito la edad como número";
} elseif (!ctype_digit($edad)) {
    $avisoEdad = "No ha escrito la edad como número entero";
} elseif ($edad < 18 || $edad > 130) {
    $avisoEdad = "La edad no está entre 18 y 130 años";
} else {
    $edadOk = true;
}

// Si hay algún error, volvemos al formulario enviando los avisos y los datos recibidos
if (!$nombreOk || !$edadOk) {
    header("Location:cabeceras-05-1.php?nombre=$nombre&avisoNombre=$avisoNombre&edad=$edad&avisoEdad=$avisoEdad");
    exit;
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>
    Formulario 5 (Resultado).
    Cabeceras. Sesiones.
    Ejercicios. PHP. Bartolomé Sintes Marco. www.mclibre.org
  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="mclibre-php-ejercicios.css" title="Color">
</head>

<body>
  <h1>Formulario 5 (Resultado)</h1>

<?php
// Si el nombre y la edad son correctos, los mostramos
if ($nombreOk && $edadOk) {
    print "  <p>Su nombre es <strong>$nombre</strong>.</p>\n";
    print "\n";
    print "  <p>Su edad es <strong>$edad</strong> años.</p>\n";
    print "\n";
}

?>
  <p><a href="cabeceras-05-1.php">Volver al formulario.</a></p>

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
