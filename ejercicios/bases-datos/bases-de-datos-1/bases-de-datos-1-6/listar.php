<?php
/**
 * @author    Bartolomé Sintes Marco - bartolome.sintes+mclibre@gmail.com
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @link      https://www.mclibre.org
 */

require_once "biblioteca.php";

$db = conectaDb();
cabecera("Listar", MENU_VOLVER);

$consulta = "SELECT * FROM $tablaAgenda";
$result   = $db->query($consulta);

print "    <p>Listado completo de registros:</p>\n";
print "\n";
print "    <table class=\"conborde franjas\">\n";
print "      <thead>\n";
print "        <tr>\n";
print "          <th>Nombre</th>\n";
print "          <th>Apellidos</th>\n";
print "        </tr>\n";
print "      </thead>\n";
print "      <tbody>\n";
foreach ($result as $valor) {
    print "        <tr>\n";
    print "          <td>$valor[nombre]</td>\n";
    print "          <td>$valor[apellidos]</td>\n";
    print "        </tr>\n";
}
print "      </tbody>\n";
print "    </table>\n";

$db = null;
pie();
