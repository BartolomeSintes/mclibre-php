<?php
/**
 * @author    Bartolomé Sintes Marco - bartolome.sintes+mclibre@gmail.com
 * @license   http://www.gnu.org/licenses/agpl.txt AGPL 3 or later
 * @link      https://www.mclibre.org
 */

require_once "biblioteca.php";

$pdo = conectaDb();
cabecera("Listar", MENU_VOLVER);

$consulta  = "SELECT * FROM $cfg[dbAgendaTabla] ";
$resultado = $pdo->query($consulta);

if (!$resultado) {
    print "    <p class=\"aviso\">Error al seleccionar todos los registros / {$pdo->errorInfo()[2]}</p>\n";
} else {
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
    foreach ($resultado as $valor) {
        print "        <tr>\n";
        print "          <td>$valor[nombre]</td>\n";
        print "          <td>$valor[apellidos]</td>\n";
        print "        </tr>\n";
    }
    print "      </tbody>\n";
    print "    </table>\n";
}

$pdo = null;
pie();
