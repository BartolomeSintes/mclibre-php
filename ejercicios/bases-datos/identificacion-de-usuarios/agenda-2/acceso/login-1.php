<?php
/**
 * @author    Bartolomé Sintes Marco - bartolome.sintes+mclibre@gmail.com
 * @license   https://www.gnu.org/licenses/agpl-3.0.txt AGPL 3 or later
 * @link      https://www.mclibre.org
 */

require_once "../comunes/biblioteca.php";

session_name(SESSION_NAME);
session_start();

if (isset($_SESSION["conectado"])) {
    header("Location:../index.php");
    exit();
}

cabecera("Login 1", MENU_VOLVER, 1);

$aviso = recoge("aviso");
if ($aviso) {
    print "    <p class=\"aviso\">$aviso</p>\n";
    print "\n";
}
print "    <form action=\"login-2.php\" method=\"" . FORM_METHOD . "\">\n";
print "      <p>Escriba su nombre de usuario y contraseña:</p>\n";
print "\n";
print "      <table>\n";
print "        <tbody>\n";
print "          <tr>\n";
print "            <td>Nombre:</td>\n";
print "            <td><input type=\"text\" name=\"usuario\" size=\"$tamUsuarioNombre\" "
    . "maxlength=\"$tamUsuarioNombre\" autofocus/></td>\n";
print "          </tr>\n";
print "          <tr>\n";
print "            <td>Contraseña:</td>\n";
print "            <td><input type=\"password\" name=\"password\" size=\"$tamUsuarioPassword\" "
    . "maxlength=\"$tamUsuarioPassword\" /></td>\n";
print "          </tr>\n";
print "        </tbody>\n";
print "      </table>\n";
print "\n";
print "      <p>\n";
print "        <input type=\"submit\" value=\"Identificar\" />\n";
print "        <input type=\"reset\" value=\"Borrar\" />\n";
print "      </p>\n";
print "    </form>\n";

pie();
