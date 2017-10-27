<?php
/**
 * Sesiones (1) 1 - sesiones-2-01-3.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2016 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2016-11-10
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

session_name("sesiones_2_01");
session_start();

?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8" />
    <title>Formulario en tres pasos (Formulario 3). Sesiones.
      Ejercicios. PHP. Bartolomé Sintes Marco</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="mclibre-php-soluciones.css" rel="stylesheet" type="text/css" title="Color" />
  </head>

  <body>
    <h1>Formulario en tres pasos (Formulario 3)</h1>

<?php
function recoge($var)
{
    $tmp = (isset($_REQUEST[$var]))
    ? trim(htmlspecialchars($_REQUEST[$var], ENT_QUOTES, "UTF-8"))
    : "";
    return $tmp;
}

$apellidos   = recoge("apellidos");
$apellidosOk = false;

if ($apellidos == "") {
    print "    <p class=\"aviso\">No ha escrito sus apellidos.</p>\n";
} else {
    $apellidosOk = true;
}

if ($apellidosOk) {
    $_SESSION["apellidos"] = $apellidos;

    print "    <form action=\"sesiones-2-01-4.php\" method=\"get\">\n";
    print "      <p>Su nombre y apellidos son: <strong>$_SESSION[nombre] $apellidos</strong>.</p>\n";
    print "\n";
    print "      <p>¿Es correcto?\n";
    print "        <input type=\"submit\" name=\"correcto\" value=\"Sí\" />\n";
    print "        <input type=\"submit\" name=\"correcto\" value=\"No\" />\n";
    print "      </p>\n";
    print "    </form>\n";
}

?>

    <p><a href="sesiones-2-01-1.php">Volver a la primera página.</a></p>

    <footer>
      <p class="ultmod">
        Última modificación de esta página:
        <time datetime="2016-11-10">10 de noviembre de 2016</time></p>

      <p class="licencia">
        Este programa forma parte del curso <a href="http://www.mclibre.org/consultar/php/">
        Programación web en PHP</a> por <a href="http://www.mclibre.org/">Bartolomé
        Sintes Marco</a>.<br />
        El programa PHP que genera esta página está bajo
        <a rel="license" href="http://www.gnu.org/licenses/agpl.txt">licencia AGPL 3 o posterior</a>.</p>
    </footer>
  </body>
</html>
