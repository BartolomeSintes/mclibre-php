<?php
/**
 * @author Escriba aquí su nombre
 */

require_once "biblioteca.php";

$pdo = conectaDb();

cabecera("Borrar 1", MENU_VOLVER);

$consulta = "SELECT * FROM $cfg[dbPersonasTabla] ";

$resultado = $pdo->query($consulta);
if (!$resultado) {
    print "    <p class=\"aviso\">Error al seleccionar todos los registros. SQLSTATE[{$pdo->errorCode()}]: {$pdo->errorInfo()[2]}</p>\n";
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
    print "          </tr>\n";
    print "        </thead>\n";
    print "        <tbody>\n";
    foreach ($resultado as $valor) {
        print "          <tr>\n";
        print "            <td class=\"centrado\"><input type=\"checkbox\" name=\"id[$valor[id]]\"></td>\n";
        print "            <td>$valor[nombre]</td>\n";
        print "            <td>$valor[apellidos]</td>\n";
        print "          </tr>\n";
    }
    print "        </tbody>\n";
    print "      </table>\n";
    print "\n";
    print "      <p>\n";
    print "        <input type=\"submit\" value=\"Borrar registro\">\n";
    print "        <input type=\"reset\" value=\"Reiniciar formulario\">\n";
    print "      </p>\n";
    print "    </form>\n";
}
$pdo = null;

pie();
