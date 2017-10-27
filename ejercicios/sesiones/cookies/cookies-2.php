<?php
/**
 * Cookies 2 - cookies-2.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2011 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2011-05-28
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
    $tmp = (isset($_REQUEST[$var])) ? strip_tags(trim(htmlspecialchars($_REQUEST[$var], ENT_QUOTES, "UTF-8"))) : "";
    if (get_magic_quotes_gpc()) {
        $tmp = stripslashes($tmp);
    }
    return $tmp;
}

define('DURACION_MIN', 1);
define('DURACION_MAX', 60);

$accion   = recoge('accion');
$duracion = recoge('duracion');

$duracionOK = ctype_digit($duracion) && (DURACION_MIN<=$duracion) && ($duracion <= DURACION_MAX);
$accionOK   = (($accion=='Crear') || ($accion=='Destruir') || ($accion=='Comprobar'));

if (($accion=='Crear') && $duracionOK) {
    setcookie('cookieTemporal', time()+$duracion, time()+$duracion);
} elseif ($accion=='Destruir') {
    setcookie ("cookieTemporal", "", time() - 3600);
}

print "<?xml version=\"1.0\" encoding=\"utf-8\"?>
<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN\"
       \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd\">
<html xmlns=\"http://www.w3.org/1999/xhtml\">
<head>
  <meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />
  <title>Creación y destrucción de cookies. Cookies.
  Ejercicios. PHP. Bartolomé Sintes Marco</title>
  <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\" />
  <link href=\"mclibre-php-soluciones.css\" rel=\"stylesheet\" type=\"text/css\"
    title=\"Color\" />\n";

print "</head>

<body onload=\"document.getElementById('cursor').focus()\">
<h1>Creación y destrucción de cookies</h1>\n";

if ($accion=='Crear') {
    if ($duracionOK) {
        print "<p>Se ha creado la cookie. Se destruirá en $duracion ";
        if ($duracion == 1) {
            print "segundo.</p>\n";
        } else{
            print "segundos.</p>\n";
        }
    } else {
        print "<p>La duración no es correcta. No se ha creado la cookie.</p>\n";
    }
} elseif ($accion=='Comprobar') {
    if (isset($_COOKIE['cookieTemporal'])) {
        $tiempoRestante = $_COOKIE['cookieTemporal'] - time();
        print "<p>La cookie se destruirá en $tiempoRestante ";
        if ($tiempoRestante == 1) {
            print "segundo.</p>\n";
        } else{
            print "segundos.</p>\n";
        }
    } else {
        print "<p>No existe la cookie.</p>\n";
    }
} elseif ($accion=='Destruir') {
    print "<p>Se ha destruido la cookie.</p>\n";
} else {
    print "<p>Error en la opción elegida. Elija de nuevo, por favor.</p>";
}

    print "<form action=\"$_SERVER[PHP_SELF]\">
  <p>Elija una opción</p>
  <ul>
    <li>Crear una cookie con una duración de
      <input type=\"text\" name=\"duracion\" value=\"10\" size=\"3\" maxlength=\"2\" id=\"cursor\" />
      segundos (entre ".DURACION_MIN." y ".DURACION_MAX.")
      <input type=\"submit\" value=\"Crear\" name=\"accion\" /></li>
    <li>Comprobar la cookie
      <input type=\"submit\" value=\"Comprobar\" name=\"accion\" /></li>
    <li>Destruir la cookie
      <input type=\"submit\" value=\"Destruir\" name=\"accion\" /></li>
  </ul>
</form>\n";

print '<address>
  Esta página forma parte del curso "Páginas web con PHP" disponible en <a
  href="http://www.mclibre.org/">http://www.mclibre.org</a><br />
  Autor: Bartolomé Sintes Marco<br />
  Última modificación de esta página: 28 de mayo de 2011
</address>

<p class="licencia">El programa PHP que genera esta página está bajo
<a rel="license" href="http://www.gnu.org/licenses/agpl.txt">licencia AGPL 3 o
posterior</a>.</p>
</body>
</html>';
/*
 * 2008-01-22
 * Este print está con comillas para poder buscar y sustituir el contenido
 * junto con el resto de ficheros.
 * También podría ponerlo fuera del bloque PHP, pero entonces Eclipse dice
 * que hay un error en la página.
 */

?>
