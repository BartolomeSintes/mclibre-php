<?php
/**
 * Cookies 3 - cookies-3a.php
 *
 * @author    Bartolomé Sintes Marco <bartolome.sintes+mclibre@gmail.com>
 * @copyright 2011 Bartolomé Sintes Marco
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @version   2011-05-19
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

// Funciones auxiliares
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

$admiteCookies  = recoge("admiteCookies");
// Si se envía un color se crea la cookie
if ($admiteCookies == "") {
    setcookie("cookiePrueba", "X");
    header("Location:cookies-3b.php");
    exit();
}

print "<!DOCTYPE html>\n";
print "<html lang=\"es\">\n";
print "<head>\n";
print "  <meta charset=\"utf-8\">\n";
print "  <title>\n";
print "    Comprobación de cookies. Cookies.\n";
print "    Ejercicios. PHP. Bartolomé Sintes Marco. www.mclibre.org\n";
print "  </title>\n";
print "  <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">\n";
print "  <link rel=\"stylesheet\" href=\"mclibre-php-ejercicios.css\" title=\"Color\">\n";
print "</head>\n";
print "\n";
print "<body>\n";
print "  <h1>Comprobación de cookies</h1>\n";
print "\n";

if ($admiteCookies == "1") {
    print "  <p>El navegador acepta cookies.</p>\n";
    print "\n";
} elseif ($admiteCookies == "0") {
    print "  <p>El navegador no acepta cookies.</p>\n";
    print "\n";
} else {
    print "  <p>El navegador no acepta cookies.</p>\n";
    print "\n";
}

print "  <p><a href=\"$_SERVER[PHP_SELF]\">Comprobar de nuevo</a></p>\n";
print "\n";

print "  <footer>\n";
print "    <p class=\"ultmod\">\n";
print "      Última modificación de esta página:\n";
print "      <time datetime=\"2011-05-19\">19 de mayo de 2011</time>\n";
print "    </p>\n";
print "\n";
print "    <p class=\"licencia\">\n";
print "      Este programa forma parte del curso <strong><a href=\"http://www.mclibre.org/consultar/php/\">Programación \n";
print "      web en PHP</a></strong> de <a href=\"http://www.mclibre.org/\" rel=\"author\">Bartolomé Sintes Marco</a>.<br>\n";
print "      El programa PHP que genera esta página se distribuye bajo \n";
print "      <a rel=\"license\" href=\"http://www.gnu.org/licenses/agpl.txt\">licencia AGPL 3 o posterior</a>.\n";
print "    </p>\n";
print "  </footer>\n";
print "</body>\n";
print "</html>\n";
?>
