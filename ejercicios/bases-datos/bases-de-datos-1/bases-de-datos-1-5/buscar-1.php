<?php
/**
 * @author    Bartolomé Sintes Marco - bartolome.sintes+mclibre@gmail.com
 * @license   https://www.gnu.org/licenses/agpl-3.0.txt AGPL 3 or later
 * @link      https://www.mclibre.org
 */

require_once "biblioteca.php";

cabecera("Buscar 1", MENU_VOLVER);

print "    <form action=\"buscar-2.php\" method=\"$cfg[formMethod]\">\n";
print "      <p>Escriba el criterio de búsqueda (caracteres o números):</p>\n";
print "\n";
print "      <table>\n";
print "        <tr>\n";
print "          <td>Nombre:</td>\n";
print "          <td><input type=\"text\" name=\"nombre\" size=\"$cfg[formPersonasTamNombre]\" maxlength=\"$cfg[formPersonasMaxNombre]\" autofocus></td>\n";
print "        </tr>\n";
print "        <tr>\n";
print "          <td>Apellidos:</td>\n";
print "          <td><input type=\"text\" name=\"apellidos\" size=\"$cfg[formPersonasTamApellidos]\" maxlength=\"$cfg[formPersonasMaxApellidos]\"></td>\n";
print "        </tr>\n";
print "      </table>\n";
print "\n";
print "      <p>\n";
print "        <input type=\"submit\" value=\"Buscar\">\n";
print "        <input type=\"reset\" value=\"Reiniciar formulario\">\n";
print "      </p>\n";
print "    </form>\n";

pie();
