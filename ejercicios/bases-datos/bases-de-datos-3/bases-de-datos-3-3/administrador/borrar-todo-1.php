<?php
/**
 * @author    Bartolomé Sintes Marco - bartolome.sintes+mclibre@gmail.com
 * @license   https://www.gnu.org/licenses/agpl-3.0.txt AGPL 3 or later
 * @link      https://www.mclibre.org
 */

require_once "../comunes/biblioteca.php";

session_name(SESSION_NAME);
session_start();
if (!isset($_SESSION["conectado"])) {
    header("Location:../index.php");
    exit;
}

cabecera("Administrador - Borrar todo 1", MENU_ADMINISTRADOR, 1);

print "    <form action=\"borrar-todo-2.php\" method=\"" . FORM_METHOD . "\">\n";
print "      <p>¿Está seguro?</p>\n";
print "\n";
print "      <p>\n";
print "        <input type=\"submit\" value=\"Sí\" name=\"si\">\n";
print "        <input type=\"submit\" value=\"No\" name=\"no\">\n";
print "      </p>\n";
print "    </form>\n";

pie();
