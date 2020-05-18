<?php
/**
 * @author    Bartolomé Sintes Marco - bartolome.sintes+mclibre@gmail.com
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @link      https://www.mclibre.org
 */

require_once "biblioteca.php";

cabecera("Añadir 1", MENU_VOLVER);

print "    <form action=\"insertar-2.php\" method=\"" . FORM_METHOD . "\">\n";
print "      <p>Escriba los datos del nuevo registro:</p>\n";
print "\n";
print "      <table>\n";
print "        <tbody>\n";
print "          <tr>\n";
print "            <td>Nombre:</td>\n";
print "            <td><input type=\"text\" name=\"nombre\" size=\"$tamAgendaNombre\" maxlength=\"$tamAgendaNombre\" autofocus></td>\n";
print "          </tr>\n";
print "          <tr>\n";
print "            <td>Apellidos:</td>\n";
print "            <td><input type=\"text\" name=\"apellidos\" size=\"$tamAgendaApellidos\" maxlength=\"$tamAgendaApellidos\"></td>\n";
print "          </tr>\n";
print "        </tbody>\n";
print "      </table>\n";
print "\n";
print "      <p>\n";
print "        <input type=\"submit\" value=\"Añadir\">\n";
print "        <input type=\"reset\" value=\"Reiniciar formulario\">\n";
print "      </p>\n";
print "    </form>\n";

pie();
