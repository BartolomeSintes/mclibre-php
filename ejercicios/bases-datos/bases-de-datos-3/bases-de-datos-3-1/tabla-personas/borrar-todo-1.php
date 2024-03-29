<?php
/**
 * @author    Bartolomé Sintes Marco - bartolome.sintes+mclibre@gmail.com
 * @license   https://www.gnu.org/licenses/agpl-3.0.txt AGPL 3 or later
 * @link      https://www.mclibre.org
 */

require_once "../comunes/biblioteca.php";

session_name($cfg["sessionName"]);
session_start();

if (!isset($_SESSION["conectado"])) {
    header("Location:../index.php");
    exit;
}

cabecera("Personas - Borrar todo 1", MENU_PERSONAS, PROFUNDIDAD_1);

print "    <form action=\"borrar-todo-2.php\" method=\"$cfg[formMethod]\">\n";
print "      <p>¿Está seguro?</p>\n";
print "\n";
print "      <p>\n";
print "        <input type=\"submit\" name=\"borrar\" value=\"Sí\">\n";
print "        <input type=\"submit\" name=\"borrar\" value=\"No\">\n";
print "      </p>\n";
print "    </form>\n";

pie();
