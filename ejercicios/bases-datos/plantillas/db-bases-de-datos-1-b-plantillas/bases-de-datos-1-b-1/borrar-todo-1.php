<?php
/**
 * @author Escriba aquí su nombre
 */

require_once "biblioteca.php";

cabecera("Borrar todo 1", MENU_VOLVER);

print "    <form action=\"borrar-todo-2.php\" method=\"$cfg[formMethod]\">\n";
print "      <p>¿Está seguro?</p>\n";
print "\n";
print "      <p>\n";
print "        <input type=\"submit\" value=\"Sí\" name=\"si\">\n";
print "        <input type=\"submit\" value=\"No\" name=\"no\">\n";
print "      </p>\n";
print "    </form>\n";

pie();
