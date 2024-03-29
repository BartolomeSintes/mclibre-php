<?php
/**
 * @author    Bartolomé Sintes Marco - bartolome.sintes+mclibre@gmail.com
 * @license   https://www.gnu.org/licenses/agpl-3.0.txt AGPL 3 or later
 * @link      https://www.mclibre.org
 */

require_once "biblioteca.php";

$pdo = conectaDb();

cabecera("Borrar 1", MENU_VOLVER);

$consulta = "SELECT * FROM $cfg[tablaPersonas]";

$resultado = $pdo->query($consulta);
if (!$resultado) {
    print "    <p class=\"aviso\">Error en la consulta. SQLSTATE[{$pdo->errorCode()}]: {$pdo->errorInfo()[2]}</p>\n";
} else {
    print "    <form action=\"borrar-2.php\" method=\"$cfg[formMethod]\">\n";
    print "      <p>Marque los registros que quiera borrar:</p>\n";
    print "\n";
    print "      <table class=\"conborde franjas\">\n";
    print "        <thead>\n";
    print "          <tr>\n";
    print "            <th>Borrar</th>\n";
    print "            <th>Nombre</th>\n";
    print "            <th>Apellidos</th>\n";
    print "            <th>Teléfono</th>\n";
    print "          </tr>\n";
    print "        </thead>\n";
    foreach ($resultado as $registro) {
        print "        <tr>\n";
        print "          <td class=\"centrado\"><input type=\"checkbox\" name=\"id[$registro[id]]\"></td>\n";
        print "          <td>$registro[nombre]</td>\n";
        print "          <td>$registro[apellidos]</td>\n";
        print "          <td>$registro[telefono]</td>\n";
        print "        </tr>\n";
    }
    print "      </table>\n";
    print "\n";
    print "      <p>\n";
    print "        <input type=\"submit\" value=\"Borrar registro\">\n";
    print "        <input type=\"reset\" value=\"Reiniciar formulario\">\n";
    print "      </p>\n";
    print "    </form>\n";
}

pie();
