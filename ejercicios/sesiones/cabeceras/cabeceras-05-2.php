<?php
/**
 * Formulario 5-2 - cabeceras-05-2.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2016 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2016-11-09
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

function recoge($var)
{
    $tmp = (isset($_REQUEST[$var]))
        ? trim(htmlspecialchars($_REQUEST[$var], ENT_QUOTES, "UTF-8"))
        : "";
    return $tmp;
}

$nombre      = recoge("nombre");
$edad        = recoge("edad");

$nombreOk    = false;
$edadOk      = false;

$avisoNombre = "";
$avisoEdad   = "";
$paginaAnterior = "cabeceras-05-1.php";

if ($nombre == "") {
    $avisoNombre = "No ha escrito su nombre";
} else {
    $nombreOk = true;
}

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

if (!$nombreOk || !$edadOk) {
    header("Location:$paginaAnterior?nombre=$nombre&avisoNombre=$avisoNombre&edad=$edad&avisoEdad=$avisoEdad");
    exit();
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <title>Formulario 5 (Resultado). Cabeceras.
    Ejercicios. Programación web en PHP. Bartolomé Sintes Marco</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" type="text/css" href="mclibre-php-ejercicios.css" title="Color" />
</head>

<body>
  <h1>Formulario 5 (Resultado)</h1>

<?php
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
      <time datetime="2016-11-09">9 de noviembre de 2016</time>
    </p>

    <p class="licencia">
      Este programa forma parte del curso <a href="http://www.mclibre.org/consultar/php/">
      <cite>Programación web en PHP</cite></a> por <cite>Bartolomé Sintes Marco</cite>.<br />
      El programa PHP que genera esta página está bajo
      <a rel="license" href="http://www.gnu.org/licenses/agpl.txt">licencia AGPL 3 o posterior</a></p>
  </footer>
</body>
</html>
