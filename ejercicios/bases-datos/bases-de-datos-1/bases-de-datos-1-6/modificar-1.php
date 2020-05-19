<?php
/**
 * @author    Bartolomé Sintes Marco - bartolome.sintes+mclibre@gmail.com
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @link      https://www.mclibre.org
 */

require_once "biblioteca.php";

$db = conectaDb();
cabecera("Modificar 1", MENU_VOLVER);

$consulta = "SELECT * FROM $tablaAgenda";
$result   = $db->query($consulta);

print "    <form action=\"modificar-2.php\" method=\"" . FORM_METHOD . "\">\n";
print "      <p>Indique el registro que quiera modificar:</p>\n";
print "\n";
print "      <table class=\"conborde franjas\">\n";
print "        <thead>\n";
print "          <tr>\n";
print "            <th>Modificar</th>\n";
print "            <th>Nombre</th>\n";
print "            <th>Apellidos</th>\n";
print "          </tr>\n";
print "        </thead>\n";
print "        <tbody>\n";
foreach ($result as $valor) {
    print "          <tr>\n";
    print "            <td class=\"centrado\"><input type=\"radio\" name=\"id\" value=\"$valor[id]\"></td>\n";
    print "            <td>$valor[nombre]</td>\n";
    print "            <td>$valor[apellidos]</td>\n";
    print "          </tr>\n";
}
print "        </tbody>\n";
print "      </table>\n";
print "\n";
print "      <p>\n";
print "        <input type=\"submit\" value=\"Modificar registro\">\n";
print "        <input type=\"reset\" value=\"Reiniciar formulario\">\n";
print "      </p>\n";
print "    </form>\n";

$db = null;
pie();
