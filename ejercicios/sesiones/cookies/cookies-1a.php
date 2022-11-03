<?php
/**
 * Cookies 1 - cookies-1a.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2011 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2011-05-19
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
    $tmp = is_array($m) ? [] : "";
    if (isset($_REQUEST[$var])) {
        if (!is_array($_REQUEST[$var]) && !is_array($m)) {
            $tmp = trim(htmlspecialchars($_REQUEST[$var]));
        } elseif (is_array($_REQUEST[$var]) && is_array($m)) {
            $tmp = $_REQUEST[$var];
            array_walk_recursive($tmp, function (&$valor) {
                $valor = trim(htmlspecialchars($valor));
            });
        }
    }
    return $tmp;
}

$color  = recoge("color");
// Si se envía un color se crea la cookie
if ($color == "rojo" || $color == "azul" || $color == "verde") {
    setcookie("cookieColor", $color);
// Si se envía el color ninguno se destruye la cookie
} elseif ($color == "ninguno") {
    setcookie ("cookieColor", "", time() - 3600);
// Si no se envía ningún color se mira si hay cookie con un color
} elseif (isset($_COOKIE["cookieColor"])) {
    $color = $_COOKIE["cookieColor"];
}

print "<!DOCTYPE html>\n";
print "<html lang=\"es\">\n";
print "<head>\n";
print "  <meta charset=\"utf-8\">\n";
print "  <title>\n";
print "    Selección de colores (selección). Cookies.\n";
print "    Ejercicios. PHP. Bartolomé Sintes Marco. www.mclibre.org\n";
print "  </title>\n";
print "  <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">\n";
print "  <link rel=\"stylesheet\" href=\"mclibre-php-ejercicios.css\" title=\"Color\">\n";
print "</head>\n";
print "\n";
print "<body>\n";
print "  <h1>Selección de colores (selección)</h1>\n";
print "\n";

if ($color == "") {
    print "  <p>No se ha elegido ningún color.</p>\n";
    print "\n";
} else {
    print "  <p>Se ha elegido el color $color.</p>\n";
    print "\n";
}

print "  <p>\n";
print "    Cambio de color: \n";
print "    <a href=\"$_SERVER[PHP_SELF]?color=rojo\">Rojo</a> -\n";
print "    <a href=\"$_SERVER[PHP_SELF]?color=azul\">Azul</a> -\n";
print "    <a href=\"$_SERVER[PHP_SELF]?color=verde\">Verde</a> -\n";
print "    <a href=\"$_SERVER[PHP_SELF]?color=ninguno\">Ninguno</a>.\n";
print "  </p>\n";
print "\n";
print "  <p><a href=\"cookies-1b.php\">Ir a otra página para comprobar la cookie</a></p>\n";
print "\n";

print "  <footer>\n";
print "    <p class=\"ultmod\">\n";
print "      Última modificación de esta página:\n";
print "      <time datetime=\"2011-05-09\">9 de mayo de 2011</time>\n";
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
