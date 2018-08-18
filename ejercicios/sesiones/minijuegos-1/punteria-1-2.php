<?php
/**
 * Puntería 1-2 - punteria-1-2.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2017 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2017-11-14
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
session_name("punteria");
session_start();

// Si algún número no está guardado en la sesión, vuelve al formulario
if (!isset($_SESSION["ancho"]) || !isset($_SESSION["r"])
    || !isset($_SESSION["x"]) || !isset($_SESSION["y"])) {
    header("Location:punteria-1-1.php");
    exit;
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <title>Puntería 1 (Resultado). Minijuegos (1).
    Ejercicios. Programación web en PHP. Bartolomé Sintes Marco</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" type="text/css" href="mclibre-php-ejercicios.css" title="Color" />
</head>

<body>
  <h1>Puntería 1 (Resultado)</h1>

<?php
function recoge($var)
{
    $tmp = (isset($_REQUEST[$var]))
        ? trim(htmlspecialchars($_REQUEST[$var], ENT_QUOTES, "UTF-8"))
        : "";
    return $tmp;
}

$xu = recoge("dibujo_x");
$yu = recoge("dibujo_y");

$xuOk = false;
$yuOk = false;

if ($xu == "" || !is_numeric($xu) || !ctype_digit($xu)) {
    print "  <p class=\"aviso\">Por favor, utilice el formulario.</p>\n";
} else {
    $xuOk = true;
}

if ($yu == "" || !is_numeric($yu) || !ctype_digit($yu)) {
    print "  <p class=\"aviso\">Por favor, utilice el formulario.</p>\n";
} else {
    $yuOk = true;
}

if ($xuOk && $yuOk) {
    if ( ($xu - $_SESSION["x"]) * ($xu - $_SESSION["x"])
        + ($yu - $_SESSION["y"]) * ($yu - $_SESSION["y"])
        <= $_SESSION["r"] * $_SESSION["r"]) {
        print "  <p>¡Enhorabuena! Ha acertado.</p>\n";
        print "\n";
    } else {
        print "  <p>Lo siento, ha fallado. Pruebe de nuevo.</p>\n";
        print "\n";
    }
}
?>

  <p><a href="punteria-1-1.php">Volver al formulario.</a></p>

  <footer>
    <p class="ultmod">
      Última modificación de esta página:
      <time datetime="2017-11-10">10 de noviembre de 2017</time>
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
