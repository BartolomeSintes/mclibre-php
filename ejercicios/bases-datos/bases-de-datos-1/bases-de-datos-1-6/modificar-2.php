<?php
/**
 * @author    Bartolomé Sintes Marco - bartolome.sintes+mclibre@gmail.com
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @link      https://www.mclibre.org
 */

require_once "biblioteca.php";

$db = conectaDb();
cabecera("Modificar 2", MENU_VOLVER);

$id = recoge("id");

$consulta = "SELECT * FROM $tablaAgenda
    WHERE id=:id";
$result = $db->prepare($consulta);
$result->execute([":id" => $id]);
$valor = $result->fetch();

print "    <form action=\"modificar-3.php\" method=\"" . FORM_METHOD . "\">\n";
print "      <p>Modifique los campos que desee:</p>\n";
print "\n";
print "      <table>\n";
print "        <tbody>\n";
print "          <tr>\n";
print "            <td>Nombre:</td>\n";
print "            <td><input type=\"text\" name=\"nombre\" size=\"$tamAgendaNombre\" maxlength=\"$tamAgendaNombre\" value=\"$valor[nombre]\" autofocus></td>\n";
print "          </tr>\n";
print "          <tr>\n";
print "            <td>Apellidos:</td>\n";
print "            <td><input type=\"text\" name=\"apellidos\" size=\"$tamAgendaApellidos\" maxlength=\"$tamAgendaApellidos\" value=\"$valor[apellidos]\"></td>\n";
print "          </tr>\n";
print "        </tbody>\n";
print "      </table>\n";
print "\n";
print "      <p>\n";
print "        <input type=\"hidden\" name=\"id\" value=\"$id\">\n";
print "        <input type=\"submit\" value=\"Actualizar\">\n";
print "        <input type=\"reset\" value=\"Reiniciar formulario\">\n";
print "      </p>\n";
print "    </form>\n";

$db = null;
pie();
