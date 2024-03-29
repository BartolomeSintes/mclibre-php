<?php
/**
 * @author    Bartolomé Sintes Marco - bartolome.sintes+mclibre@gmail.com
 * @license   https://www.gnu.org/licenses/agpl-3.0.txt AGPL 3 or later
 * @link      https://www.mclibre.org
 */

require_once "../comunes/biblioteca.php";

session_name($cfg["sessionName"]);
session_start();

if (!isset($_SESSION["conectado"]) || $_SESSION["nivel"] < NIVEL_ADMINISTRADOR) {
    header("Location:../index.php");
    exit;
}

cabecera("Administrador - Borrar todo 1", MENU_ADMINISTRADOR, PROFUNDIDAD_1);

print "    <form action=\"borrar-todo-2.php\" method=\"$cfg[formMethod]\">\n";
print "      <p>Por favor, confirme que desea borrar todos los datos de la base de datos.</p>\n";
print "\n";
print "      <p>También puede incluir en la base de datos unos datos de prueba.</p>\n";
print "\n";
print "      <p><label><input type=\"checkbox\" name=\"demo\" value=\"Sí\"> Incluir datos de prueba</label></p>\n";
print "\n";
print "      <p>Haga clic en Sí para borrar todos los datos.</p>\n";
print "\n";
print "      <p>\n";
print "        <input type=\"submit\" name=\"borrar\" value=\"Sí\">\n";
print "        <input type=\"submit\" name=\"borrar\" value=\"No\">\n";
print "      </p>\n";
print "    </form>\n";

pie();
