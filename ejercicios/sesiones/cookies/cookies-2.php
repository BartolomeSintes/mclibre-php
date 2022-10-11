<?php
/**
 * Cookies 2 - cookies-2.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2011 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2011-05-28
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

// Funciones auxiliares
function recoge($var, $m = "")
{
    if (!isset($_REQUEST[$var])) {
        $tmp = is_array($m) ? [] : "";
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

define("DURACION_MIN", 1);
define("DURACION_MAX", 60);

$accion   = recoge("accion");
$duracion = recoge("duracion");

$duracionOk = ctype_digit($duracion) && (DURACION_MIN<=$duracion) && ($duracion <= DURACION_MAX);
$accionOk   = ($accion == "Crear" || $accion == "Destruir" || $accion == "Comprobar");

if ($accion == "Crear" && $duracionOk) {
    setcookie("cookieTemporal", time()+$duracion, time()+$duracion);
} elseif ($accion == "Destruir") {
    setcookie ("cookieTemporal", "", time() - 3600);
}

print "<!DOCTYPE html>\n";
print "<html lang=\"es\">\n";
print "<head>\n";
print "  <meta charset=\"utf-8\">\n";
print "  <title>\n";
print "    Creación y destrucción de cookies. Cookies.\n";
print "    Ejercicios. PHP. Bartolomé Sintes Marco. www.mclibre.org\n";
print "  </title>\n";
print "  <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">\n";
print "  <link rel=\"stylesheet\" href=\"mclibre-php-ejercicios.css\" title=\"Color\">\n";
print "</head>\n";
print "\n";
print "<body>\n";
print "  <h1>Creación y destrucción de cookies</h1>\n";
print "\n";

if ($accion == "Crear") {
    if ($duracionOk) {
        print "  <p>Se ha creado la cookie. Se destruirá en $duracion ";
        if ($duracion == 1) {
            print "segundo.</p>\n";
            print "\n";
        } else{
            print "segundos.</p>\n";
            print "\n";
        }
    } else {
        print "  <p>La duración no es correcta. No se ha creado la cookie.</p>\n";
        print "\n";
    }
} elseif ($accion == "Comprobar") {
    if (isset($_COOKIE["cookieTemporal"])) {
        $tiempoRestante = $_COOKIE["cookieTemporal"] - time();
        print "  <p>La cookie se destruirá en $tiempoRestante ";
        if ($tiempoRestante == 1) {
            print "segundo.</p>\n";
            print "\n";
        } else{
            print "segundos.</p>\n";
            print "\n";
        }
    } else {
        print "  <p>No existe la cookie.</p>\n";
        print "\n";
    }
} elseif ($accion == "Destruir") {
    print "  <p>Se ha destruido la cookie.</p>\n";
    print "\n";
} elseif ($accion != "") {
    print "  <p>Error en la opción elegida. Elija de nuevo, por favor.</p>\n";
    print "\n";
}

print "  <form action=\"$_SERVER[PHP_SELF]\">\n";
print "    <p>Elija una opción</p>\n";
print "\n";
print "    <ul>\n";
print "      <li>Crear una cookie con una duración de\n";
print "        <input type=\"text\" name=\"duracion\" value=\"10\" size=\"3\" maxlength=\"2\" autofocus>\n";
print "        segundos (entre " . DURACION_MIN . " y " . DURACION_MAX . ")\n";
print "        <input type=\"submit\" value=\"Crear\" name=\"accion\">\n";
print "      </li>\n";
print "      <li>Comprobar la cookie\n";
print "        <input type=\"submit\" value=\"Comprobar\" name=\"accion\">\n";
print "      </li>\n";
print "      <li>Destruir la cookie\n";
print "        <input type=\"submit\" value=\"Destruir\" name=\"accion\">\n";
print "      </li>\n";
print "    </ul>\n";
print "  </form>\n";
print "
";

print "  <footer>\n";
print "    <p class=\"ultmod\">\n";
print "      Última modificación de esta página:\n";
print "      <time datetime=\"2011-05-28\">28 de mayo de 2011</time>\n";
print "    </p>\n";
print "\n";
print "    <p class=\"licencia\">\n";
print "      Este programa forma parte del curso <strong><a href=\"https://www.mclibre.org/consultar/php/\">Programación \n";
print "      web en PHP</a></strong> de <a href=\"https://www.mclibre.org/\" rel=\"author\">Bartolomé Sintes Marco</a>.<br>\n";
print "      El programa PHP que genera esta página se distribuye bajo \n";
print "      <a rel=\"license\" href=\"http://www.gnu.org/licenses/agpl.txt\">licencia AGPL 3 o posterior</a>.\n";
print "    </p>\n";
print "  </footer>\n";
print "</body>\n";
print "</html>\n";
?>
