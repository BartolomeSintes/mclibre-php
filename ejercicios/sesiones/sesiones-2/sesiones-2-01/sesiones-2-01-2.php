<?php
/**
 * Sesiones (2) 01 - sesiones-2-01-2.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2017 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2017-11-15
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

session_name("sesiones-2-01");
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <title>Formulario en tres pasos (Formulario 2). Sesiones (2) 01. Sesiones.
    Ejercicios. PHP. Bartolomé Sintes Marco</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="mclibre-php-soluciones.css" rel="stylesheet" type="text/css" title="Color" />
</head>

<body>
  <h1>Formulario en tres pasos (Formulario 2)</h1>

<?php
function recoge($var)
{
    $tmp = (isset($_REQUEST[$var]))
    ? trim(htmlspecialchars($_REQUEST[$var], ENT_QUOTES, "UTF-8"))
    : "";
    return $tmp;
}

$nombre   = recoge("nombre");
$nombreOk = false;

if ($nombre == "") {
    print "  <p class=\"aviso\">No ha escrito su nombre.</p>\n";
} else {
    $nombreOk = true;
}

if ($nombreOk) {
    $_SESSION["nombre"] = $nombre;
    print "  <form action=\"sesiones-2-01-3.php\" method=\"get\">\n";
    print "    <p>Su nombre es: <strong>$nombre</strong>.</p>\n";
    print "\n";
    print "    <p>Escriba sus apellidos:</p>\n";
    print "\n";
    print "    <p><strong>Apellidos:</strong> <input type=\"text\" name=\"apellidos\" size=\"30\" maxlength=\"30\" /></p>\n";
    print "\n";

    print "    <p>\n";
    print "      <input type=\"submit\" value=\"Siguiente\" />\n";
    print "      <input type=\"reset\" value=\"Borrar\" />\n";
    print "    </p>\n";
    print "  </form>\n";
}

?>

  <p><a href="sesiones-2-01-1.php">Volver a la primera página.</a></p>

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
