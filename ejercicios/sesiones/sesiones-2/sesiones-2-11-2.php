<?php
/**
 * Sesiones (2) 11 - sesiones-2-11-2.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2017 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2017-11-16
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

session_name("sesiones_2_11");
session_start();

function recoge($var)
{
    $tmp = (isset($_REQUEST[$var]))
        ? trim(htmlspecialchars($_REQUEST[$var], ENT_QUOTES, "UTF-8"))
        : "";
    return $tmp;
}

$nombre    = recoge("nombre");
$edad      = recoge("edad");
$nombreOk  = false;
$edadOk    = false;

$paginaAnterior = "sesiones-2-11-1.php";

if ($nombre == "") {
    $_SESSION["aviso"]["nombre"] = "No ha escrito su nombre";
} else {
    $nombreOk = true;
}

if ($edad == "") {
    $_SESSION["aviso"]["edad"] = "No ha escrito su edad";
} elseif (!is_numeric($edad)) {
    $_SESSION["aviso"]["edad"] = "No ha escrito la edad como número";
} elseif (!ctype_digit($edad)) {
    $_SESSION["aviso"]["edad"] = "No ha escrito la edad como número entero";
} elseif ($edad < 18 || $edad > 130) {
    $_SESSION["aviso"]["edad"] = "La edad no está entre 18 y 130 años";
} else {
    $edadOk = true;
}

if (!$nombreOk || !$edadOk) {
    $_SESSION["dato"]["nombre"] = $nombre;
    $_SESSION["dato"]["edad"] = $edad;
    header("Location:$paginaAnterior");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <title>Comprobación en formulario. Sesiones (2) 011 . Sesiones.
    Ejercicios. PHP. Bartolomé Sintes Marco</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" type="text/css" href="mclibre-php-soluciones.css" title="Color" />
</head>

<body>
  <h1>Comprobación en formulario</h1>

<?php
print "  <p>Su nombre es <strong>$nombre</strong>.</p>\n";
print "\n";
print "  <p>Su edad es <strong>$edad</strong> años.</p>\n";
?>

  <p><a href="sesiones-2-11-1.php">Volver al inicio.</a></p>

  <footer>
    <p class="ultmod">
      Última modificación de esta página:
      <time datetime="2017-11-15">15 de noviembre de 2017</time>
    </p>

    <p class="licencia">
      Este programa forma parte del curso <strong><a href="http://www.mclibre.org/consultar/php/">Programación
      web en PHP</a></strong> de <a href="http://www.mclibre.org/" rel="author" >Bartolomé Sintes Marco</a>.<br />
      El programa PHP que genera esta página se distribuye bajo
      <a rel="license" href="http://www.gnu.org/licenses/agpl.txt">licencia AGPL 3 o posterior</a>.
    </p>
  </footer>
</body>
</html>
